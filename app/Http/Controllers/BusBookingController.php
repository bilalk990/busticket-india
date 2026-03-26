<?php

namespace App\Http\Controllers;

use App\Models\BusSchedules;
use App\Models\BusBooking;
use App\Models\BusPassengers;
use App\Models\BusDocuments;
use App\Models\Notification;
use App\Models\BusSeatLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\Models\BusFare;
use App\Models\BusPoint;
use Illuminate\Support\Facades\Mail;
use App\Models\TicketResale;
use App\Services\TicketService;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use App\Models\Bid;
use App\Models\Discount;
use App\Models\BusAgency;
use App\Models\BusRoute;
use App\Models\BusBaggagePolicy;
use Illuminate\Support\Facades\Cache;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\MarkupFee;
use App\Helpers\CurrencyHelper;
use BaconQrCode\Renderer\Image\GdImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer;

class BusBookingController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function seatSelection($pickup, $dropoff, $scheduleId, $returnScheduleId = null)
    {
        // Decode URL-encoded parameters
        $pickup = urldecode($pickup);
        $dropoff = urldecode($dropoff);

        // Handle virtual schedule IDs (route_X) - from searchViaRoutes fallback
        if (str_starts_with($scheduleId, 'route_')) {
            $routeId = str_replace('route_', '', $scheduleId);
            return $this->seatSelectionFromRoute($pickup, $dropoff, $routeId);
        }

        // Find the corresponding point IDs for pickup and dropoff
        $pickupPoint = BusPoint::where('name', 'LIKE', "%$pickup%")->first();
        $dropoffPoint = BusPoint::where('name', 'LIKE', "%$dropoff%")->first();

        if (!$pickupPoint || !$dropoffPoint) {
            return back()->with('error', 'Invalid pickup or dropoff location.');
        }

        // Log pickup and dropoff points
        Log::info('Seat Selection - Pickup and Dropoff Points:', [
            'pickup_point' => $pickupPoint->name,
            'dropoff_point' => $dropoffPoint->name,
            'pickup_id' => $pickupPoint->id,
            'dropoff_id' => $dropoffPoint->id
        ]);

        // Fetch the main schedule
        $schedule = BusSchedules::with('bus')->findOrFail($scheduleId);

        // Get baggage policy for the agency
        $baggagePolicy = BusBaggagePolicy::where('agency_id', $schedule->bus->agency_id)
            ->active()
            ->first();

        // Retrieve the outbound fare from bus_fares using resolved point IDs
        $outboundFare = BusFare::where('pickup', $pickupPoint->id)
            ->where('dropoff', $dropoffPoint->id)
            ->where('route_id', $schedule->route_id)
            ->where('agency_id', $schedule->bus->agency_id)
            ->first();

        $outboundPrice = $outboundFare ? $outboundFare->amount : null;
        $outboundCurrency = $outboundFare ? $outboundFare->currency : null;

        // Fetch seat layout for the outbound schedule
        $seatLayout = null;
        if ($schedule->bus->layout_id) {
            $layoutData = BusSeatLayout::where('id', $schedule->bus->layout_id)
                ->value('layout_json');
            $layoutData = json_decode($layoutData, true);
            
            // Transform the layout into the format expected by the view
            if ($layoutData && isset($layoutData['seats'])) {
                $rows = [];
                $rowsCount = $layoutData['rows'] ?? 5;
                $columnsCount = $layoutData['columns'] ?? 4;
                
                // Group seats by row
                for ($r = 0; $r < $rowsCount; $r++) {
                    $rowSeats = [];
                    for ($c = 0; $c < $columnsCount; $c++) {
                        // Find seat at this position
                        $seat = collect($layoutData['seats'])->first(function($s) use ($r, $c) {
                            return $s['row'] == $r && $s['column'] == $c;
                        });
                        
                        if ($seat && $seat['available']) {
                            // Generate seat ID like A1, A2, B1, B2, etc.
                            $rowLetter = chr(65 + $r); // 65 = 'A'
                            $seatNumber = $c + 1;
                            $rowSeats[] = $rowLetter . $seatNumber;
                        } else {
                            $rowSeats[] = null; // Empty seat
                        }
                    }
                    $rows[] = ['row' => $r + 1, 'seats' => $rowSeats];
                }
                
                $seatLayout = ['rows' => $rows];
            }
        }
        
        // Fallback: If no layout, create a default one
        if (!$seatLayout) {
            $seatLayout = ['rows' => []];
        }

        // Get already booked seats for outbound schedule
        $bookedSeats = BusPassengers::where('schedule_id', $scheduleId)
            ->pluck('seat')
            ->toArray();

        // Process return schedule if provided
        $returnSchedule = null;
        $returnSeatLayout = [];
        $returnBookedSeats = [];
        $returnPrice = null;
        $returnCurrency = null;

        if ($returnScheduleId) {
            $returnSchedule = BusSchedules::with('bus')->findOrFail($returnScheduleId);

            // Find return trip points
            $returnPickupPoint = BusPoint::where('name', 'LIKE', "%$dropoff%")->first();
            $returnDropoffPoint = BusPoint::where('name', 'LIKE', "%$pickup%")->first();

            if ($returnPickupPoint && $returnDropoffPoint) {
                // Retrieve the return fare from bus_fares
                $returnFare = BusFare::where('pickup', $returnPickupPoint->id)
                    ->where('dropoff', $returnDropoffPoint->id)
                    ->where('route_id', $returnSchedule->route_id)
                    ->where('agency_id', $returnSchedule->bus->agency_id)
                    ->first();

                $returnPrice = $returnFare ? $returnFare->amount : null;
                $returnCurrency = $returnFare ? $returnFare->currency : null;
            }

            // Fetch seat layout for the return schedule
            if ($returnSchedule->bus->layout_id) {
                $returnLayoutData = BusSeatLayout::where('id', $returnSchedule->bus->layout_id)
                    ->value('layout_json');
                $returnLayoutData = json_decode($returnLayoutData, true);
                
                // Transform the layout into the format expected by the view
                if ($returnLayoutData && isset($returnLayoutData['seats'])) {
                    $returnRows = [];
                    $returnRowsCount = $returnLayoutData['rows'] ?? 5;
                    $returnColumnsCount = $returnLayoutData['columns'] ?? 4;
                    
                    // Group seats by row
                    for ($r = 0; $r < $returnRowsCount; $r++) {
                        $rowSeats = [];
                        for ($c = 0; $c < $returnColumnsCount; $c++) {
                            // Find seat at this position
                            $seat = collect($returnLayoutData['seats'])->first(function($s) use ($r, $c) {
                                return $s['row'] == $r && $s['column'] == $c;
                            });
                            
                            if ($seat && $seat['available']) {
                                // Generate seat ID like A1, A2, B1, B2, etc.
                                $rowLetter = chr(65 + $r); // 65 = 'A'
                                $seatNumber = $c + 1;
                                $rowSeats[] = $rowLetter . $seatNumber;
                            } else {
                                $rowSeats[] = null; // Empty seat
                            }
                        }
                        $returnRows[] = ['row' => $r + 1, 'seats' => $rowSeats];
                    }
                    
                    $returnSeatLayout = ['rows' => $returnRows];
                }
            }

            // Get already booked seats for the return schedule
            $returnBookedSeats = BusPassengers::where('schedule_id', $returnScheduleId)
                ->pluck('seat')
                ->toArray();
        }

        // Pass all variables to the view
        return view('bus.booking.seat_selection', compact(
            'schedule',
            'pickup',
            'dropoff',
            'seatLayout',
            'bookedSeats',
            'outboundPrice',
            'outboundCurrency',
            'returnSchedule',
            'returnSeatLayout',
            'returnBookedSeats',
            'returnPrice',
            'returnCurrency',
            'baggagePolicy'
        ));
    }





    public function passengerDetails(Request $request, $scheduleId)
    {
        // Validate the input - skip bus_schedules existence check for virtual route IDs
        $isVirtual = str_starts_with($scheduleId, 'route_');
        
        $validatedData = $request->validate([
            'seats_outbound' => 'required|string',
            'seats_return' => 'nullable|string',
            'return_schedule_id' => 'nullable|string',
            'outbound_price' => 'required|numeric',
            'return_price' => 'nullable|numeric',
            'currency' => 'required|string',
            'pickup' => 'required|string',
            'dropoff' => 'required|string',
            'baggage_fee' => 'nullable|numeric|min:0',
            'extra_bags_fee' => 'nullable|numeric|min:0',
            'overweight_fee' => 'nullable|numeric|min:0',
            'bags_per_passenger' => 'nullable|integer|min:0',
            'bag_weight' => 'nullable|numeric|min:0',
        ]);

        // Retrieve selected seats
        $outboundSeats = explode(',', $request->input('seats_outbound', ''));
        $returnSeats = $request->input('seats_return')
            ? explode(',', $request->input('seats_return', ''))
            : [];

        if (empty($outboundSeats)) {
            return redirect()->back()->with('error', 'You must select at least one seat for the outbound trip!');
        }

        // Handle virtual schedule IDs (route_X)
        if ($isVirtual) {
            $routeId = str_replace('route_', '', $scheduleId);
            $route = \App\Models\BusRoutes::with(['agency'])->find($routeId);
            if (!$route) {
                return redirect()->back()->with('error', 'Route not found.');
            }
            $fare = \App\Models\BusFare::where('route_id', $routeId)->first();
            
            // Create a virtual schedule object
            $schedule = (object)[
                'id' => $scheduleId,
                'route_id' => $routeId,
                'departure_time' => $fare ? $fare->departure_time : '08:00:00',
                'arrival_time' => $fare ? $fare->arrival_time : '16:00:00',
                'departure_date' => now()->addDay()->format('Y-m-d'),
                'status' => 'scheduled',
                'route' => $route,
                'bus' => (object)[
                    'id' => null,
                    'name' => 'Bus',
                    'agency_id' => $route->agency_id,
                    'agency' => (object)[
                        'id' => $route->agency_id,
                        'agency_name' => optional($route->agency)->agency_name ?? 'Bus Operator',
                        'agency_logo' => optional($route->agency)->agency_logo ?? null,
                    ],
                ],
            ];
            $agencyDocumentTypes = collect();
        } else {
            $schedule = BusSchedules::with(['route', 'bus.agency.documentTypes'])->findOrFail($scheduleId);
            $agencyDocumentTypes = $schedule->bus->agency->documentTypes()
                ->active()
                ->ordered()
                ->get();
        }

        $returnScheduleId = $request->input('return_schedule_id');
        $returnSchedule = null;

        // Get countries for dropdown
        $countries = \App\Models\Country::orderBy('country_name')->get();

        // Get authenticated user data for autofill
        $user = auth()->guard('customer')->user();
        $userData = null;
        if ($user) {
            $userData = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ];
        }

        $outboundPriceInput = $request->input('outbound_price');
        $returnPriceInput = $request->input('return_price', 0);
        $pickup = $request->input('pickup');
        $dropoff = $request->input('dropoff');

        // Get baggage fees
        $baggageFee = $request->input('baggage_fee', 0);
        $extraBagsFee = $request->input('extra_bags_fee', 0);
        $overweightFee = $request->input('overweight_fee', 0);
        $bagsPerPassenger = $request->input('bags_per_passenger', 0);
        $bagWeight = $request->input('bag_weight', 0);

         $outboundPrice = $outboundPriceInput * count($outboundSeats);
         $returnPrice = $returnPriceInput ? $returnPriceInput * count($returnSeats) : 0;

        $totalPrice = $outboundPrice + $returnPrice + $baggageFee;

        Log::info('Outbound Price: ' . $outboundPrice);
        Log::info('Return Price: ' . $returnPrice);
        Log::info('Total Price: ' . $totalPrice);
        Log::info('Pickup: ' . $pickup);
        Log::info('Dropoff: ' . $dropoff);
        $currency = $request->input('currency', '');
        Log::info('Currency: ' . $currency);

        // Fetch active admin markup (regardless of currency)
        $markup = MarkupFee::where('status', 'active')->first();
        $markupAmount = 0;
        $markupLabel = null;
        $markupType = null;
        $markupOriginalCurrency = null;
        $markupPerSeat = 0;
        $totalSeats = count($outboundSeats) + count($returnSeats);
        if ($markup && $totalSeats > 0) {
            $markupLabel = $markup->label;
            $markupType = $markup->type;
            $markupOriginalCurrency = $markup->currency;
            $exchangeRates = session('currency')['rates'] ?? [];
            if (strtolower($markup->type) === 'fixed') {
                $markupPerSeat = $markup->value;
                if ($markup->currency !== $currency) {
                    $markupPerSeat = CurrencyHelper::convertCurrency($markup->value, $markup->currency, $currency, $exchangeRates);
                }
                $markupAmount = $markupPerSeat * $totalSeats;
            } elseif (strtolower($markup->type) === 'percentage') {
                // For percentage, apply to total fare per seat, then sum
                $perSeatFare = 0;
                if ($totalSeats > 0) {
                    $perSeatFare = ($outboundPrice + $returnPrice) / $totalSeats;
                }
                $markupPerSeat = ($perSeatFare * $markup->value) / 100;
                $markupAmount = $markupPerSeat * $totalSeats;
            }
            $totalPrice += $markupAmount;
        }

        return view('bus.booking.passenger_details', [
            'schedule' => $schedule,
            'scheduleId' => $scheduleId,
            'returnSchedule' => $returnSchedule,
            'returnScheduleId' => $returnScheduleId,
            'outboundSeats' => $outboundSeats,
            'returnSeats' => $returnSeats,
            'outboundPrice' => $outboundPrice,
            'returnPrice' => $returnPrice,
            'totalPrice' => $totalPrice,
            'currency' => $currency,
            'pickup' => $pickup,
            'dropoff' => $dropoff,
            'agencyDocumentTypes' => $agencyDocumentTypes,
            'countries' => $countries,
            'userData' => $userData,
            'baggageFee' => $baggageFee,
            'extraBagsFee' => $extraBagsFee,
            'overweightFee' => $overweightFee,
            'bagsPerPassenger' => $bagsPerPassenger,
            'bagWeight' => $bagWeight,
            'markupAmount' => $markupAmount,
            'markupLabel' => $markupLabel,
            'markupType' => $markupType,
            'markupOriginalCurrency' => $markupOriginalCurrency,
            'markupPerSeat' => $markupPerSeat,
            'totalSeats' => $totalSeats,
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
            'total_price' => 'required|numeric',
            'schedule_id' => 'required|integer',
            'return_schedule_id' => 'nullable|integer',
            'agency_id' => 'required|integer',
            'route_id' => 'required|integer',
        ]);

        try {
            $couponCode = strtoupper(trim($request->coupon_code));
            $totalPrice = $request->total_price;
            $scheduleId = $request->schedule_id;
            $returnScheduleId = $request->return_schedule_id;
            $agencyId = $request->agency_id;
            $routeId = $request->route_id;

            // Find the discount coupon
            $discount = Discount::where('code', $couponCode)
                ->where('statut', 'yes') // Changed from 'active' to 'yes' to match database
                ->where('expire_at', '>', now())
                ->first();

            if (!$discount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired coupon code.'
                ], 400);
            }

            // Check if coupon is applicable for this booking
            $isApplicable = true;
            $errorMessage = '';

            // Check agency-specific coupons
            if ($discount->agency_id && $discount->agency_id != $agencyId) {
                $isApplicable = false;
                
                // Get agency names for better error message
                $couponAgency = BusAgency::find($discount->agency_id);
                $bookingAgency = BusAgency::find($agencyId);
                
                $couponAgencyName = $couponAgency ? $couponAgency->agency_name : 'Unknown Agency';
                $bookingAgencyName = $bookingAgency ? $bookingAgency->agency_name : 'Unknown Agency';
                
                $errorMessage = 'This coupon is not valid for this bus agency. (Coupon agency: ' . $couponAgencyName . ', Booking agency: ' . $bookingAgencyName . ')';
            }

            // Check route-specific coupons
            if ($discount->route_id && $discount->route_id != $routeId) {
                $isApplicable = false;
                
                // Get route names for better error message
                $couponRoute = BusRoute::find($discount->route_id);
                $bookingRoute = BusRoute::find($routeId);
                
                $couponRouteName = $couponRoute ? $couponRoute->origin . ' to ' . $couponRoute->destination : 'Unknown Route';
                $bookingRouteName = $bookingRoute ? $bookingRoute->origin . ' to ' . $bookingRoute->destination : 'Unknown Route';
                
                $errorMessage = 'This coupon is not valid for this route. (Coupon route: ' . $couponRouteName . ', Booking route: ' . $bookingRouteName . ')';
            }

            // Check usage limits
            if ($discount->max_users) {
                $usageCount = BusBooking::where('coupon_code', $couponCode)->count();
                if ($usageCount >= $discount->max_users) {
                    $isApplicable = false;
                    $errorMessage = 'This coupon has reached its maximum usage limit.';
                }
            }

            if (!$isApplicable) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 400);
            }

            // Calculate discount amount
            $discountAmount = 0;
            if (strtolower($discount->type) === 'percentage') {
                $discountAmount = ($totalPrice * $discount->discount) / 100;
            } else {
                $discountAmount = $discount->discount;
            }

            // Ensure discount doesn't exceed total price
            if ($discountAmount > $totalPrice) {
                $discountAmount = $totalPrice;
            }

            $finalPrice = $totalPrice - $discountAmount;

            return response()->json([
                'success' => true,
                'message' => 'Coupon applied successfully!',
                'data' => [
                    'coupon_code' => $couponCode,
                    'discount_type' => $discount->type,
                    'discount_value' => $discount->discount,
                    'discount_amount' => round($discountAmount, 2),
                    'original_price' => $totalPrice,
                    'final_price' => round($finalPrice, 2),
                    'description' => $discount->discription
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Coupon application error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while applying the coupon. Please try again.'
            ], 500);
        }
    }


    public function checkout(Request $request)
    {
        $validatedData = $request->validate([
            'contact_phone' => 'required|string',
            'contact_email' => 'required|email',
            'email_verified' => 'required|in:0,1',
            'schedule_id' => 'required|string',
            'return_schedule_id' => 'nullable|string',
            'outboundSeats' => 'required|string',
            'returnSeats' => 'nullable|string',
            'passengers' => 'required|array',
            'outboundPrice' => 'required|numeric',
            'returnPrice' => 'nullable|numeric',
            'totalPrice' => 'required|numeric',
            'currency' => 'required|string',
            'pickup' => 'required|string',
            'dropoff' => 'required|string',
            'coupon_code' => 'nullable|string',
            'discount_amount' => 'nullable|numeric|min:0',
            'final_price' => 'nullable|numeric|min:0',
            'baggage_fee' => 'nullable|numeric|min:0',
            'extra_bags_fee' => 'nullable|numeric|min:0',
            'overweight_fee' => 'nullable|numeric|min:0',
            'bags_per_passenger' => 'nullable|integer|min:0',
            'bag_weight' => 'nullable|numeric|min:0',
            'markupAmount' => 'nullable|numeric|min:0',
            'markupLabel' => 'nullable|string',
            'markupType' => 'nullable|string',
            'markupPerSeat' => 'nullable|numeric|min:0',
            'totalSeats' => 'nullable|integer|min:1',
        ]);
        Log::info('Checkout POST data', $validatedData);
        
        // Check if user is logged in
        $user = auth()->guard('customer')->user();
        $isUserLoggedIn = $user && $user->email === $validatedData['contact_email'];
        
        // Email verification check - only for non-logged-in users
        if (!$isUserLoggedIn) {
            $email = $validatedData['contact_email'];
            $emailVerified = \App\Models\OtpVerification::where('email', $email)
                ->where('type', 'email')
                ->whereNotNull('verified_at')
                ->where('expires_at', '>', now())
                ->exists();
                
            if (!$emailVerified) {
                return redirect()->back()->with('error', 'Email verification is required. Please verify your email address before proceeding.');
            }
        }
        
        // Validate passenger ages
        $minimumAge = config('app.bus_travel.minimum_age', 5); // Get from config, default to 5
        $today = now();
        
        foreach ($validatedData['passengers'] as $index => $passenger) {
            $birthDate = \Carbon\Carbon::parse($passenger['dob']);
            $age = $birthDate->diffInYears($today);
            
            if ($age < $minimumAge) {
                return redirect()->back()->with('error', "Passenger " . ($index + 1) . " must be at least {$minimumAge} years old to travel.");
            }
        }

        $token = uniqid();
        Log::info("Payment Token details: tx_ref: $token");

        // Log::info("Checkout method checking for seat details: $validatedData");

          // Start the session and store data
        Session::put('booking_data', $validatedData);
        Session::put('tx_ref', $token);
        Log::info('Session booking_data set', Session::get('booking_data'));

        $currency = $validatedData['currency'];

        return view('checkout.checkout', [
            'data' => $validatedData,
            'numberOfPassengers' => count(explode(',', $request->input('outboundSeats'))),
            'token' => $token,
            'currency' => $currency,


        ]);
    }

    /**
     * Handle test payment for MVP demo (bypasses actual payment gateway)
     * This is a temporary feature for client demo and should be removed after MVP
     */
    public function handleTestPayment(Request $request)
    {
        $tx_ref = $request->get('tx_ref');
        
        // Log test payment attempt
        Log::info("Test Payment initiated: tx_ref: $tx_ref");

        // Retrieve the session data
        $bookingreference = Session::get('tx_ref');
        $data = Session::get('booking_data');
        $scheduleId = $data['schedule_id'] ?? null;
        $returnScheduleId = $data['return_schedule_id'] ?? null;
        $pickup = $data['pickup'] ?? null;
        $dropoff = $data['dropoff'] ?? null;

        if ($tx_ref !== $bookingreference) {
            return redirect()->route('home')
                ->with('error', 'Session expired. Please start your booking again.');
        }

        try {
            // Parse selected seats
            $selectedSeats = explode(',', $data['outboundSeats']);
            $returnSeats = !empty($data['returnSeats']) ? explode(',', $data['returnSeats']) : [];
            $contactPhone = $data['contact_phone'] ?? null;
            $contactEmail = $data['contact_email'] ?? null;

            Log::info('Test Payment - Selected Outbound Seats: ' . implode(', ', $selectedSeats));
            Log::info('Test Payment - Selected Return Seats: ' . implode(', ', $returnSeats));

            // Check if seats are already booked
            $bookedSeats = BusPassengers::where('schedule_id', $scheduleId)
                ->whereIn('seat', $selectedSeats)
                ->pluck('seat')
                ->toArray();
            if (!empty($bookedSeats)) {
                return redirect()->route('home')
                    ->with('error', 'The following outbound seats are already booked: ' . implode(', ', $bookedSeats));
            }

            if ($returnScheduleId) {
                $bookedReturnSeats = BusPassengers::where('schedule_id', $returnScheduleId)
                    ->whereIn('seat', $returnSeats)
                    ->pluck('seat')
                    ->toArray();
                if (!empty($bookedReturnSeats)) {
                    return redirect()->route('home')
                        ->with('error', 'The following return seats are already booked: ' . implode(', ', $bookedReturnSeats));
                }
            }

            DB::beginTransaction();

            $outboundPrice  = $data['outboundPrice'];
            $totalOutboundAmount = $outboundPrice * count($selectedSeats);
            $returnPrice = $data['returnPrice'] ?? 0;
            $totalReturnAmount = $returnPrice * count($returnSeats);
            $totalAmount = $totalOutboundAmount + $totalReturnAmount;
            
            // Handle coupon data
            $couponCode = $data['coupon_code'] ?? null;
            $discountAmount = $data['discount_amount'] ?? 0;
            $finalPrice = $data['final_price'] ?? $totalAmount;
            
            // Get the schedule to get agency_id
            // Handle virtual route IDs (route_X) by creating a real schedule record
            if (str_starts_with($scheduleId, 'route_')) {
                $routeId = str_replace('route_', '', $scheduleId);
                $route = \App\Models\BusRoutes::with('agency')->find($routeId);
                $bus = \Illuminate\Support\Facades\DB::table('buses')->where('agency_id', $route->agency_id)->first();
                $fare = \App\Models\BusFare::where('route_id', $routeId)->first();
                
                // Create a real bus_schedules record
                $realSchedule = BusSchedules::create([
                    'route_id' => $routeId,
                    'bus_id' => $bus ? $bus->id : null,
                    'agency_id' => $route->agency_id,
                    'departure_date' => now()->addDay()->format('Y-m-d'),
                    'departure_time' => $fare ? $fare->departure_time : '08:00:00',
                    'arrival_time' => $fare ? $fare->arrival_time : '16:00:00',
                    'status' => 'scheduled',
                ]);
                $scheduleId = $realSchedule->id;
                $agencyId = $route->agency_id;
            } else {
                $schedule = BusSchedules::with('bus')->find($scheduleId);
                $agencyId = $schedule ? ($schedule->bus->agency_id ?? null) : null;
            }
            
            // Initialize passenger details array
            $passengerDetails = [];
            
            // Create booking with TEST PAYMENT status
            $booking = BusBooking::create([
                'user_id' => auth()->guard('customer')->id(),
                'bus_schedule_id' => $scheduleId,
                'agency_id' => $agencyId,
                'pickup' => $data['pickup'],
                'dropoff' => $data['dropoff'],
                'bookingreference' => $bookingreference,
                'contact_phone' => $data['contact_phone'],
                'contact_email' => $data['contact_email'],
                'total_amount' => $totalAmount,
                'currency' => session('currency')['code'] ?? 'ZMW',
                'coupon_code' => $couponCode,
                'discount_amount' => $discountAmount,
                'final_price' => $finalPrice,
                'status' => 'confirmed', // Instantly confirmed for test payment
                'markup_fee' => $data['markupAmount'] ?? 0,
            ]);
            
            Log::info('Test Payment - Booking created with ID: ' . $booking->id);

            // Create passengers for outbound trip
            foreach ($data['passengers'] as $index => $passengerData) {
                if (!isset($selectedSeats[$index])) {
                    throw new \Exception('Outbound seat data mismatch');
                }
                $seat = $selectedSeats[$index];
                $passenger = BusPassengers::create([
                    'booking_id' => $booking->id,
                    'schedule_id' => $scheduleId,
                    'seat' => $seat,
                    'title' => $passengerData['title'],
                    'given_name' => $passengerData['given_name'],
                    'family_name' => $passengerData['family_name'],
                    'phone' => $passengerData['phone'],
                    'email' => $passengerData['email'],
                    'dob' => $passengerData['dob'],
                    'gender' => $passengerData['gender'],
                    'seat_price' => $outboundPrice,
                ]);

                // Handle identity documents
                if (isset($passengerData['identity_documents'])) {
                    foreach ($passengerData['identity_documents'] as $docTypeId => $documentData) {
                        if (!empty($documentData['type']) && !empty($documentData['unique_identifier'])) {
                            BusDocuments::create([
                                'passenger_id' => $passenger->id,
                                'type' => $documentData['type'],
                                'unique_identifier' => $documentData['unique_identifier'],
                                'issuing_country_code' => $documentData['issuing_country_code'] ?? '',
                                'expires_on' => $documentData['expires_on'] ?? null,
                            ]);
                        }
                    }
                } elseif (isset($passengerData['identity_document'])) {
                    $documentData = $passengerData['identity_document'];
                    BusDocuments::create([
                        'passenger_id' => $passenger->id,
                        'type' => $documentData['type'],
                        'unique_identifier' => $documentData['unique_identifier'],
                        'issuing_country_code' => $documentData['issuing_country_code'],
                        'expires_on' => $documentData['expires_on'],
                    ]);
                }
                
                $passengerDetails[] = [
                    'name' => "{$passengerData['given_name']} {$passengerData['family_name']}",
                    'seat' => $seat,
                    'price' => $outboundPrice,
                ];
            }

            // Create passengers for return trip if exists
            if ($returnScheduleId) {
                foreach ($data['passengers'] as $index => $passengerData) {
                    if (!isset($returnSeats[$index])) {
                        throw new \Exception('Return seat data mismatch');
                    }
                    $seat = $returnSeats[$index];
                    $passenger = BusPassengers::create([
                        'booking_id' => $booking->id,
                        'schedule_id' => $returnScheduleId,
                        'seat' => $seat,
                        'title' => $passengerData['title'],
                        'given_name' => $passengerData['given_name'],
                        'family_name' => $passengerData['family_name'],
                        'phone' => $passengerData['phone'],
                        'email' => $passengerData['email'],
                        'dob' => $passengerData['dob'],
                        'gender' => $passengerData['gender'],
                        'seat_price' => $returnPrice,
                    ]);

                    // Handle identity documents for return journey
                    if (isset($passengerData['identity_documents'])) {
                        foreach ($passengerData['identity_documents'] as $docTypeId => $documentData) {
                            if (!empty($documentData['type']) && !empty($documentData['unique_identifier'])) {
                                BusDocuments::create([
                                    'passenger_id' => $passenger->id,
                                    'type' => $documentData['type'],
                                    'unique_identifier' => $documentData['unique_identifier'],
                                    'issuing_country_code' => $documentData['issuing_country_code'] ?? '',
                                    'expires_on' => $documentData['expires_on'] ?? null,
                                ]);
                            }
                        }
                    } elseif (isset($passengerData['identity_document'])) {
                        $documentData = $passengerData['identity_document'];
                        BusDocuments::create([
                            'passenger_id' => $passenger->id,
                            'type' => $documentData['type'],
                            'unique_identifier' => $documentData['unique_identifier'],
                            'issuing_country_code' => $documentData['issuing_country_code'],
                            'expires_on' => $documentData['expires_on'],
                        ]);
                    }

                    $passengerDetails[] = [
                        'name' => "{$passengerData['given_name']} {$passengerData['family_name']}",
                        'seat' => $seat,
                        'price' => $returnPrice,
                    ];
                }
            }
            
            // Create notification
            Notification::create([
                'user_id' => auth()->id() ?? null,
                'type' => 'bus_booking',
                'title' => 'Booking Confirmed (Test Payment)',
                'message' => "Your booking ({$bookingreference}) from {$data['pickup']} to {$data['dropoff']} has been confirmed.",
                'data' => ['schedule_id' => $scheduleId, 'booking_reference' => $bookingreference ?? null],
            ]);

            // Load schedule relationship for email
            $booking->load(['schedule.bus.agency']);
            
            // Send booking confirmation email (wrap in try-catch so email failure doesn't break booking)
            try {
                $qrPng = base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(160)->generate($booking->bookingreference));
                Mail::send('emails.booking-details', [
                    'booking' => $booking,
                    'passengerDetails' => $passengerDetails,
                    'qrPng' => $qrPng,
                ], function ($message) use ($contactEmail, $bookingreference) {
                    $message->to($contactEmail)
                        ->subject("Booking Confirmation - Reference: {$bookingreference}");
                });

                $passengers = BusPassengers::where('booking_id', $booking->id)
                    ->get(['given_name', 'family_name', 'seat'])
                    ->toArray();
                $booking->notify(new \App\Notifications\BookingConfirmationEmail($booking, $passengers));
            } catch (\Exception $mailEx) {
                Log::warning('Test Payment - Email/QR failed (non-critical): ' . $mailEx->getMessage());
            }

            Log::info('Test Payment - All operations completed successfully, committing transaction...');
            DB::commit();
            Log::info('Test Payment - Transaction committed successfully.');
            Session::forget(['tx_ref', 'booking_data']);
            
            // Redirect to dashboard with success message
            return redirect()->route('dashboard')
                ->with('success', '🎉 Booking Confirmed! Reference: ' . $bookingreference);
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Test Payment error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $data ?? [],
                'scheduleId' => $scheduleId,
                'returnScheduleId' => $returnScheduleId
            ]);
            return redirect()->route('home')
                ->with('error', 'There was an issue processing your test booking: ' . $e->getMessage());
        }
    }

    public function handlePaymentCallback(Request $request)
    {
        $tx_ref = $request->get('tx_ref');
        $status = $request->get('status');
        $transaction_id = $request->get('transaction_id');

        // Retrieve the session data
        $bookingreference = Session::get('tx_ref');
        // Log the variables to the console
        Log::info("Payment callback details: tx_ref: $tx_ref, status: $status, transaction_id: $transaction_id, expected_tx_ref: $bookingreference");

        $data = Session::get('booking_data');
        $scheduleId = $data['schedule_id'] ?? null;
        $returnScheduleId = $data['return_schedule_id'] ?? null;
        $pickup = $data['pickup'] ?? null;
        $dropoff = $data['dropoff'] ?? null;
        
        // Retrieve pickup and dropoff points from session
        // $pickupPointName = Session::get('pickup_point_name');
        // $dropoffPointName = Session::get('dropoff_point_name');

        // Log pickup and dropoff points from session
        Log::info('Payment Callback - Pickup and Dropoff Points:', [
            'pickup' => $pickup,
            'dropoff' => $dropoff,
        ]);

        if ($tx_ref !== $bookingreference) {
            $scheduleId = Session::get('booking_data.schedule_id');
            $returnScheduleId = Session::get('booking_data.return_schedule_id');
            $pickup = Session::get('booking_data.pickup');
            $dropoff = Session::get('booking_data.dropoff');
            return redirect()->route('booking.seatSelection', [
                'scheduleId' => $scheduleId,
                'returnScheduleId' => $returnScheduleId,
                'pickup' => $pickup,
                'dropoff' => $dropoff
            ])->with('error', 'Transaction reference mismatch.');
        }

        if ($status === 'successful') {
            try {
                // Verify the transaction with Flutterwave's API (optional for extra security)
                // $response = Http::withToken(config('services.flutterwave.secret_key'))
                //     ->get("https://api.flutterwave.com/v3/transactions/{$transaction_id}/verify");

                // if ($response->status() !== 200 || $response->json('status') !== 'success') {
                //     throw new \Exception('Transaction verification failed.');
                // }

                // Retrieve booking details from session
                //   $data = Session::get('booking_data');
                //   $scheduleId = $data['schedule_id'] ?? null;
                //   $returnScheduleId = $data['return_schedule_id'] ?? null;
                // Other data, for example, outboundSeats and passengers, will also be parsed accordingly
                // $schedule = BusSchedules::with('bus')->findOrFail($scheduleId);
                // $returnScheduleId = $request->input('return_schedule_id');

                // Parse selected seats
                $selectedSeats = explode(',', $data['outboundSeats']);
                $returnSeats = !empty($data['returnSeats']) ? explode(',', $data['returnSeats']) : [];
                $contactPhone = $data['contact_phone'] ?? null;
                $contactEmail = $data['contact_email'] ?? null;

                Log::info('Selected Outbound Seats: ' . implode(', ', $selectedSeats));
                Log::info('Selected Return Seats: ' . implode(', ', $returnSeats));

                $bookedSeats = BusPassengers::where('schedule_id', $scheduleId)
                    ->whereIn('seat', $selectedSeats)
                    ->pluck('seat')
                    ->toArray();
                if (!empty($bookedSeats)) {
                    return redirect()->route('booking.seatSelection', $scheduleId)
                        ->with('error', 'The following outbound seats are already booked: ' . implode(', ', $bookedSeats));
                }

                if ($returnScheduleId) {
                    $bookedReturnSeats = BusPassengers::where('schedule_id', $returnScheduleId)
                        ->whereIn('seat', $returnSeats)
                        ->pluck('seat')
                        ->toArray();
                    if (!empty($bookedReturnSeats)) {
                        return redirect()->route('booking.seatSelection', [$scheduleId, $returnScheduleId])
                            ->with('error', 'The following return seats are already booked: ' . implode(', ', $bookedReturnSeats));
                    }
                }

                DB::beginTransaction();

                $outboundPrice  = $data['outboundPrice'];
                $totalOutboundAmount = $outboundPrice * count($selectedSeats);
                $returnPrice = $data['returnPrice'] ?? 0;

                $totalReturnAmount = $returnPrice * count($returnSeats);

                $totalAmount = $totalOutboundAmount + $totalReturnAmount;
                
                // Handle coupon data
                $couponCode = $data['coupon_code'] ?? null;
                $discountAmount = $data['discount_amount'] ?? 0;
                $finalPrice = $data['final_price'] ?? $totalAmount;
                
                // Get the schedule to get agency_id
                $schedule = BusSchedules::with('bus')->find($scheduleId);
                $agencyId = $schedule->bus->agency_id ?? null;
                
                // Initialize passenger details array
                $passengerDetails = [];
                
                // $bookingreference = uniqid();
                $booking = BusBooking::create([
                    'user_id' => auth()->guard('customer')->id(),
                    'bus_schedule_id' => $scheduleId,
                    'agency_id' => $agencyId,
                    'pickup' => $data['pickup'],
                    'dropoff' => $data['dropoff'],
                    'bookingreference' => $bookingreference,
                    'contact_phone' => $data['contact_phone'],
                    'contact_email' => $data['contact_email'],
                    'total_amount' => $totalAmount,
                    'currency' => session('currency')['code'] ?? 'ZMW',
                    'coupon_code' => $couponCode,
                    'discount_amount' => $discountAmount,
                    'final_price' => $finalPrice,
                    'status' => 'confirmed',
                    'markup_fee' => $data['markupAmount'] ?? 0,
                ]);
                Log::info('Booking created with ID: ' . $booking->id);
                Log::info('Booking details:', [
                    'booking_id' => $booking->id,
                    'booking_reference' => $booking->bookingreference,
                    'contact_email' => $booking->contact_email,
                    'total_amount' => $booking->total_amount,
                    'status' => $booking->status
                ]);
                Log::info('BusBooking created', $booking->toArray());

                foreach ($data['passengers'] as $index => $passengerData) {
                    if (!isset($selectedSeats[$index])) {
                        throw new \Exception('Outbound seat data mismatch');
                    }
                    $seat = $selectedSeats[$index];
                    $passenger = BusPassengers::create([
                        'booking_id' => $booking->id,
                        'schedule_id' => $scheduleId,
                        'seat' => $seat,
                        'title' => $passengerData['title'],
                        'given_name' => $passengerData['given_name'],
                        'family_name' => $passengerData['family_name'],
                        'phone' => $passengerData['phone'],
                        'email' => $passengerData['email'],
                        'dob' => $passengerData['dob'],
                        'gender' => $passengerData['gender'],
                        'seat_price' => $outboundPrice,
                    ]);


                    // Handle identity documents - support both old and new structure
                    if (isset($passengerData['identity_documents'])) {
                        // New structure with agency-specific documents
                        foreach ($passengerData['identity_documents'] as $docTypeId => $documentData) {
                            if (!empty($documentData['type']) && !empty($documentData['unique_identifier'])) {
                                BusDocuments::create([
                                    'passenger_id' => $passenger->id,
                                    'type' => $documentData['type'],
                                    'unique_identifier' => $documentData['unique_identifier'],
                                    'issuing_country_code' => $documentData['issuing_country_code'] ?? '',
                                    'expires_on' => $documentData['expires_on'] ?? null,
                                ]);
                                Log::info('Agency document created for Passenger ID: ' . $passenger->id . ', Type: ' . $documentData['type']);
                            }
                        }
                    } elseif (isset($passengerData['identity_document'])) {
                        // Old structure with single document
                        $documentData = $passengerData['identity_document'];
                        BusDocuments::create([
                            'passenger_id' => $passenger->id,
                            'type' => $documentData['type'],
                            'unique_identifier' => $documentData['unique_identifier'],
                            'issuing_country_code' => $documentData['issuing_country_code'],
                            'expires_on' => $documentData['expires_on'],
                        ]);
                        Log::info('Identity document created for Passenger ID: ' . $passenger->id);
                    }
                    $passengerDetails[] = [
                        'name' => "{$passengerData['given_name']} {$passengerData['family_name']}",
                        'seat' => $seat,
                        'price' => $outboundPrice,
                    ];
                }

                if ($returnScheduleId) {
                    foreach ($data['passengers'] as $index => $passengerData) {
                        if (!isset($returnSeats[$index])) {
                            throw new \Exception('Return seat data mismatch');
                        }
                        $seat = $returnSeats[$index];
                        $passenger = BusPassengers::create([
                            'booking_id' => $booking->id,
                            'schedule_id' => $returnScheduleId,
                            'seat' => $seat,
                            'title' => $passengerData['title'],
                            'given_name' => $passengerData['given_name'],
                            'family_name' => $passengerData['family_name'],
                            'phone' => $passengerData['phone'],
                            'email' => $passengerData['email'],
                            'dob' => $passengerData['dob'],
                            'gender' => $passengerData['gender'],
                            'seat_price' => $returnPrice,
                        ]);

                        // Handle identity documents for return journey - support both old and new structure
                        if (isset($passengerData['identity_documents'])) {
                            // New structure with agency-specific documents
                            foreach ($passengerData['identity_documents'] as $docTypeId => $documentData) {
                                if (!empty($documentData['type']) && !empty($documentData['unique_identifier'])) {
                                    BusDocuments::create([
                                        'passenger_id' => $passenger->id,
                                        'type' => $documentData['type'],
                                        'unique_identifier' => $documentData['unique_identifier'],
                                        'issuing_country_code' => $documentData['issuing_country_code'] ?? '',
                                        'expires_on' => $documentData['expires_on'] ?? null,
                                    ]);
                                    Log::info('Agency document created for return Passenger ID: ' . $passenger->id . ', Type: ' . $documentData['type']);
                                }
                            }
                        } elseif (isset($passengerData['identity_document'])) {
                            // Old structure with single document
                            $documentData = $passengerData['identity_document'];
                            BusDocuments::create([
                                'passenger_id' => $passenger->id,
                                'type' => $documentData['type'],
                                'unique_identifier' => $documentData['unique_identifier'],
                                'issuing_country_code' => $documentData['issuing_country_code'],
                                'expires_on' => $documentData['expires_on'],
                            ]);
                            Log::info('Identity document created for return Passenger ID: ' . $passenger->id);
                        }

                        $passengerDetails[] = [
                            'name' => "{$passengerData['given_name']} {$passengerData['family_name']}",
                            'seat' => $seat,
                            'price' => $returnPrice,
                        ];
                    }
                }
                Notification::create([
                    'user_id' => auth()->id() ?? null,
                    'type' => 'bus_booking',
                    'title' => 'Booking Confirmed',
                    'message' => "Your booking ({$bookingreference}) from {$data['pickup']} to {$data['dropoff']} has been confirmed.",
                    'data' => ['schedule_id' => $scheduleId, 'booking_reference' => $bookingreference ?? null],
                ]);

                // Load schedule relationship for email
                $booking->load(['schedule.bus.agency']);
                
                // Send booking confirmation email (non-critical, wrapped in try-catch)
                try {
                    $qrPng = base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(160)->generate($booking->bookingreference));
                    Mail::send('emails.booking-details', [
                        'booking' => $booking,
                        'passengerDetails' => $passengerDetails,
                        'qrPng' => $qrPng,
                    ], function ($message) use ($contactEmail, $bookingreference) {
                        $message->to($contactEmail)
                            ->subject("Booking Confirmation - Reference: {$bookingreference}");
                    });

                    $passengers = BusPassengers::where('booking_id', $booking->id)
                        ->get(['given_name', 'family_name', 'seat'])
                        ->toArray();
                    $booking->notify(new \App\Notifications\BookingConfirmationEmail($booking, $passengers));
                } catch (\Exception $mailEx) {
                    Log::warning('Payment callback - Email/QR failed (non-critical): ' . $mailEx->getMessage());
                }

                Log::info('All operations completed successfully, committing transaction...');
                DB::commit();
                Log::info('Transaction committed successfully.');
                Session::forget(['tx_ref', 'tx_ref']);
                // return redirect()->route('booking.success')->with('success', 'Payment successful and booking completed!');
                if ($returnScheduleId) {
                    return redirect()->route('booking.seatSelection', [
                        'pickup' => $data['pickup'],
                        'dropoff' => $data['dropoff'],
                        'scheduleId' => $scheduleId,
                        'returnScheduleId' => $returnScheduleId
                    ])
                        ->with('success', 'Booking successfully completed!');
                }

                return redirect()->route('booking.seatSelection', [
                    'pickup' => $data['pickup'],
                    'dropoff' => $data['dropoff'],
                    'scheduleId' => $scheduleId
                ])
                    ->with('success', 'Booking successfully completed!');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Payment callback error: ' . $e->getMessage(), [
                    'trace' => $e->getTraceAsString(),
                    'data' => $data,
                    'scheduleId' => $scheduleId,
                    'returnScheduleId' => $returnScheduleId
                ]);
                return redirect()->route('booking.seatSelection', [
                    'pickup' => $data['pickup'],
                    'dropoff' => $data['dropoff'],
                    'scheduleId' => $scheduleId,
                    'returnScheduleId' => $returnScheduleId
                ])->with('error', 'There was an issue processing your booking. Please try again.');
            }
        } elseif ($status === 'cancelled') {
            // return redirect()->route('booking.seatSelection')->with('error', 'Payment was cancelled.');
            return redirect()->route('booking.passengerDetails', ['scheduleId' => $scheduleId])
                    ->with('error', 'There was an issue processing your booking. Please try again.');
        } else {
            // return redirect()->route('booking.seatSelection')->with('error', 'Payment failed. Please try again.');
            return redirect()->route('booking.passengerDetails', ['scheduleId' => $scheduleId])
                    ->with('error', 'There was an issue processing your booking. Please try again.');
        }
    }




    public function myBookings()
    {
        $email = Auth::user()->email;
        
        // Get upcoming bookings (confirmed and not past departure date)
        $upcomingBookings = BusBooking::with(['schedule', 'passengers', 'rating', 'schedule.bus.agency'])
            ->where('contact_email', $email)
            ->where('status', 'confirmed')
            ->whereHas('schedule', function($query) {
                $query->where('departure_date', '>=', now()->format('Y-m-d'));
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Get past bookings (completed or past departure date)
        $pastBookings = BusBooking::with(['schedule', 'passengers', 'rating', 'schedule.bus.agency'])
            ->where('contact_email', $email)
            ->where(function($query) {
                $query->where('status', 'completed')
                      ->orWhereHas('schedule', function($q) {
                          $q->where('departure_date', '<', now()->format('Y-m-d'));
                      });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Get canceled bookings
        $canceledBookings = BusBooking::with(['schedule', 'passengers', 'rating', 'schedule.bus.agency'])
            ->where('contact_email', $email)
            ->where('status', 'cancelled')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get bookings listed for resale
        $resaleBookings = BusBooking::with(['schedule', 'passengers', 'resale', 'rating', 'schedule.bus.agency'])
            ->where('contact_email', $email)
            ->whereHas('resale', function($query) {
                $query->whereIn('status', ['active', 'sold']);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Prepare booking data for JavaScript
        $bookingDataArray = [];
        
        foreach($upcomingBookings as $booking) {
            $bookingDataArray[$booking->id] = [
                'id' => $booking->id,
                'bookingRef' => $booking->bookingreference,
                'agencyName' => $booking->schedule->bus->agency->agency_name ?? 'N/A',
                'agencyLogo' => $booking->schedule->bus->agency->agency_logo ?? '',
                'from' => $booking->pickup_name ?? 'N/A',
                'to' => $booking->dropoff_name ?? 'N/A',
                'date' => $booking->schedule->departure_date ?? 'N/A',
                'time' => $booking->schedule->departure_time ?? 'N/A',
                'contactName' => 'N/A',
                'contactEmail' => $booking->contact_email ?? 'N/A',
                'contactPhone' => $booking->contact_phone ?? 'N/A',
                'totalAmount' => $booking->total_amount ?? 0,
                'busNumber' => $booking->schedule->bus->bus_number ?? 'N/A',
                'serviceFee' => 0,
                'taxes' => 0,
                'qrCode' => $booking->qr_code ?? ''
            ];
        }
        
        foreach($pastBookings as $booking) {
            $bookingDataArray[$booking->id] = [
                'id' => $booking->id,
                'bookingRef' => $booking->bookingreference,
                'agencyName' => $booking->schedule->bus->agency->agency_name ?? 'N/A',
                'agencyLogo' => $booking->schedule->bus->agency->agency_logo ?? '',
                'from' => $booking->pickup_name ?? 'N/A',
                'to' => $booking->dropoff_name ?? 'N/A',
                'date' => $booking->schedule->departure_date ?? 'N/A',
                'time' => $booking->schedule->departure_time ?? 'N/A',
                'contactName' => 'N/A',
                'contactEmail' => $booking->contact_email ?? 'N/A',
                'contactPhone' => $booking->contact_phone ?? 'N/A',
                'totalAmount' => $booking->total_amount ?? 0,
                'busNumber' => $booking->schedule->bus->bus_number ?? 'N/A',
                'serviceFee' => 0,
                'taxes' => 0,
                'qrCode' => $booking->qr_code ?? ''
            ];
        }
        
        foreach($canceledBookings as $booking) {
            $bookingDataArray[$booking->id] = [
                'id' => $booking->id,
                'bookingRef' => $booking->bookingreference,
                'agencyName' => $booking->schedule->bus->agency->agency_name ?? 'N/A',
                'agencyLogo' => $booking->schedule->bus->agency->agency_logo ?? '',
                'from' => $booking->pickup_name ?? 'N/A',
                'to' => $booking->dropoff_name ?? 'N/A',
                'date' => $booking->schedule->departure_date ?? 'N/A',
                'time' => $booking->schedule->departure_time ?? 'N/A',
                'contactName' => 'N/A',
                'contactEmail' => $booking->contact_email ?? 'N/A',
                'contactPhone' => $booking->contact_phone ?? 'N/A',
                'totalAmount' => $booking->total_amount ?? 0,
                'busNumber' => $booking->schedule->bus->bus_number ?? 'N/A',
                'serviceFee' => 0,
                'taxes' => 0,
                'qrCode' => $booking->qr_code ?? ''
            ];
        }
        
        foreach($resaleBookings as $booking) {
            $bookingDataArray[$booking->id] = [
                'id' => $booking->id,
                'bookingRef' => $booking->bookingreference,
                'agencyName' => $booking->schedule->bus->agency->agency_name ?? 'N/A',
                'agencyLogo' => $booking->schedule->bus->agency->agency_logo ?? '',
                'from' => $booking->pickup_name ?? 'N/A',
                'to' => $booking->dropoff_name ?? 'N/A',
                'date' => $booking->schedule->departure_date ?? 'N/A',
                'time' => $booking->schedule->departure_time ?? 'N/A',
                'contactName' => 'N/A',
                'contactEmail' => $booking->contact_email ?? 'N/A',
                'contactPhone' => $booking->contact_phone ?? 'N/A',
                'totalAmount' => $booking->total_amount ?? 0,
                'busNumber' => $booking->schedule->bus->bus_number ?? 'N/A',
                'serviceFee' => 0,
                'taxes' => 0,
                'qrCode' => $booking->qr_code ?? ''
            ];
        }

        return view('account.bookings', compact('upcomingBookings', 'pastBookings', 'canceledBookings', 'resaleBookings', 'bookingDataArray'));
    }


    public function trackBooking(){
        $title ="Track your bookings";

        return view('bookings.retrieve_booking.index', compact('title'));
    }


    public function showRetrieveForm()
    {
        return view('bookings.retrieve_booking.index', [
            'bookingDetails' => null,
            'error' => null
        ]);
    }

    public function retrieveBooking(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'bookingReference' => 'required|string',
            'emailAddress' => 'required|email',
        ]);

        // Retrieve inputs
        $bookingReference = $validated['bookingReference'];
        $emailAddress = $validated['emailAddress'];

        // Fetch booking details with relationships
        $booking = BusBooking::with(['schedule', 'passengers'])
            ->where('bookingreference', $bookingReference)
            ->where('contact_email', $emailAddress)
            ->first();

        if (!$booking) {
            return view('bookings.retrieve_booking.index', [
                'bookingDetails' => null,
                'error' => 'No booking found for the provided details.'
            ]);
        }

        // Format booking details for display
        $bookingDetails = [
            'bookingReference' => $booking->bookingreference,
            'contactPhone' => $booking->contact_phone,
            'contactEmail' => $booking->contact_email,
            'totalAmount' => $booking->total_amount,
            'status' => $booking->status,
            'pickupPoint' => $booking->pickupPoint ? $booking->pickupPoint->name : 'N/A',
            'dropoffPoint' => $booking->dropoffPoint ? $booking->dropoffPoint->name : 'N/A',
            'departureDate' => $booking->schedule ? $booking->schedule->departure_date : 'N/A',
            'departureTime' => $booking->schedule ? $booking->schedule->departure_time : 'N/A',
            'passengers' => $booking->passengers->map(function ($passenger) {
                return [
                    'name' => "{$passenger->given_name} {$passenger->family_name}",
                    'seat' => $passenger->seat,
                    'phone' => $passenger->phone,
                    'email' => $passenger->email,
                    'seatPrice' => $passenger->seat_price,
                ];
            })->toArray(),
        ];

        return view('bookings.retrieve_booking.index', [
            'bookingDetails' => $bookingDetails,
            'error' => null
        ]);
    }

    public function dashboard()
    {
        $userEmail = Auth::user()->email;

        // Forget stale cache so data is always fresh
        try {
            Cache::forget('user_dashboard_' . $userEmail);
        } catch (\Exception $e) {
            \Log::warning('Cache forget failed: ' . $e->getMessage());
        }

        // Cache user dashboard data for 5 minutes
        try {
            $dashboardData = Cache::remember('user_dashboard_' . $userEmail, 300, function () use ($userEmail) {
                // Get total bookings
                $totalBookings = BusBooking::where('contact_email', $userEmail)->count();

            // Get upcoming bookings (confirmed and not past departure date)
            $upcomingBookings = BusBooking::with([
                'schedule.bus.agency:id,agency_name,agency_logo',
                'passengers:id,schedule_id,seat',
                'rating:id,booking_id,rating'
            ])
            ->select('id', 'bookingreference', 'contact_email', 'contact_phone', 
                    'total_amount', 'currency', 'qr_code', 'status', 'pickup', 'dropoff', 'bus_schedule_id')
            ->where('contact_email', $userEmail)
            ->where('status', 'confirmed')
            ->whereHas('schedule', function($query) {
                $query->where('departure_date', '>=', now()->format('Y-m-d'));
            })
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

            // Get upcoming trips count for card
            $upcomingTrips = $upcomingBookings->count();

            // Get completed trips
            $completedTrips = BusBooking::where('contact_email', $userEmail)
                ->where(function($query) {
                    $query->where('status', 'completed')
                        ->orWhereHas('schedule', function($q) {
                            $q->where('departure_date', '<', now()->format('Y-m-d'));
                        });
                })
                ->count();

            // Get canceled trips
            $canceledTrips = BusBooking::where('contact_email', $userEmail)
                ->where('status', 'cancelled')
                ->count();

            // Get total spent
            $totalSpent = BusBooking::where('contact_email', $userEmail)
                ->where('status', '!=', 'cancelled')
                ->sum('total_amount');

            // Get recent bookings with detailed route information
            $recentBookings = BusBooking::with([
                'schedule.bus.agency:id,agency_name,agency_logo',
                'passengers:id,schedule_id,seat',
                'rating:id,booking_id,rating'
            ])
            ->select('id', 'bookingreference', 'contact_email', 'contact_phone', 
                    'total_amount', 'currency', 'qr_code', 'status', 'pickup', 'dropoff', 'bus_schedule_id')
            ->where('contact_email', $userEmail)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get()
            ->map(function ($booking) {
                \Log::info('Booking Points:', [
                    'booking_id' => $booking->id,
                    'pickup_id' => $booking->pickup,
                    'dropoff_id' => $booking->dropoff,
                    'pickup_point' => $booking->pickup ?? 'N/A',
                    'dropoff_point' => $booking->dropoff ?? 'N/A'
                ]);

                return (object)[
                    'bookingreference' => $booking->bookingreference,
                    'origin' => $booking->pickup ?? 'N/A',
                    'destination' => $booking->dropoff ?? 'N/A',
                    'date' => $booking->schedule->departure_date ?? 'N/A',
                    'status' => ucfirst($booking->status),
                    'amount' => $booking->total_amount,
                    'currency' => $booking->currency ?? 'ZMW',
                    'departure_time' => $booking->schedule->departure_time ?? 'N/A',
                    'arrival_time' => $booking->schedule->arrival_time ?? 'N/A',
                    'agency_name' => $booking->schedule->bus->agency->agency_name ?? 'N/A',
                    'agency_logo' => $booking->schedule->bus->agency->agency_logo ?? null
                ];
            });

            // Get ticket resale activities
            $userResales = TicketResale::with(['booking.schedule.bus.agency:id,agency_name', 'bids'])
                ->select('id', 'user_id', 'booking_id', 'asking_price', 'status', 'created_at')
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            $userBids = Bid::with(['ticketResale.booking.schedule.bus.agency:id,agency_name', 'ticketResale.user'])
                ->select('id', 'user_id', 'ticket_resale_id', 'amount', 'status', 'created_at')
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            return [
                'totalBookings' => $totalBookings,
                'upcomingBookings' => $upcomingBookings,
                'upcomingTrips' => $upcomingTrips,
                'completedTrips' => $completedTrips,
                'canceledTrips' => $canceledTrips,
                'totalSpent' => $totalSpent,
                'recentBookings' => $recentBookings,
                'userResales' => $userResales,
                'userBids' => $userBids
            ];
        });
        } catch (\Exception $e) {
            \Log::warning('Cache failed for user dashboard: ' . $e->getMessage());
            // Fallback: fetch data directly without cache
            $dashboardData = [
                'totalBookings' => BusBooking::where('contact_email', $userEmail)->count(),
                'upcomingTrips' => 0,
                'completedTrips' => 0,
                'canceledTrips' => 0,
                'totalSpent' => 0,
                'recentBookings' => collect([]),
                'userResales' => collect([]),
                'userBids' => collect([])
            ];
        }

        return view('account.dashboard', $dashboardData);
    }

    public function getBookingsByEmail($email)
    {
        $bookings = BusBooking::with(['schedule.route', 'passengers'])
            ->where('contact_email', $email)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($booking) {
                return [
                    'booking_reference' => $booking->bookingreference,
                    'status' => $booking->status,
                    'total_amount' => $booking->total_amount,
                    'contact_phone' => $booking->contact_phone,
                    'contact_email' => $booking->contact_email,
                    'route' => $booking->schedule ? [
                        'origin' => $booking->pickup,
                        'destination' => $booking->dropoff,
                        'departure_date' => $booking->schedule->departure_date,
                        'departure_time' => $booking->schedule->departure_time,
                    ] : null,
                    'passengers' => $booking->passengers->map(function ($passenger) {
                        return [
                            'name' => "{$passenger->given_name} {$passenger->family_name}",
                            'seat' => $passenger->seat,
                            'email' => $passenger->email,
                            'phone' => $passenger->phone,
                            'dob' => $passenger->dob,
                            'gender' => $passenger->gender,
                            'seat_price' => $passenger->seat_price,
                        ];
                    }),
                    'created_at' => $booking->created_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    public function getTicketHistory($email)
    {
        try {
            // Debug: Log the exact email we're searching for
            \Log::info("Searching for bookings with email: " . $email);
            
            // Get the full history with relationships
            $bookings = BusBooking::with([
                'schedule' => function($query) {
                    $query->with(['route', 'bus.agency']);
                },
                'passengers' => function($query) {
                    $query->orderBy('seat', 'asc');
                },
                'resale' // Add resale relationship
            ])
            ->where('contact_email', $email)
            ->orderBy('created_at', 'desc')
            ->get();

            \Log::info("Found " . $bookings->count() . " bookings for email: " . $email);

            $formattedBookings = $bookings->map(function ($booking) {
                $schedule = $booking->schedule;
                $route = $schedule ? $schedule->route : null;
                $bus = $schedule ? $schedule->bus : null;
                $agency = $bus ? $bus->agency : null;

                return [
                    'booking_reference' => $booking->bookingreference,
                    'status' => $booking->status,
                    'total_amount' => $booking->total_amount,
                    'contact_phone' => $booking->contact_phone,
                    'contact_email' => $booking->contact_email,
                    'route' => $route ? [
                        'origin' => $route->pickup_point,
                        'destination' => $route->dropoff_point,
                        'departure_date' => $schedule->departure_date,
                        'departure_time' => $schedule->departure_time,
                        'agency_name' => $agency ? $agency->agency_name : 'N/A',
                    ] : null,
                    'passengers' => $booking->passengers->map(function ($passenger) {
                        return [
                            'name' => "{$passenger->given_name} {$passenger->family_name}",
                            'seat' => $passenger->seat,
                            'email' => $passenger->email,
                            'phone' => $passenger->phone,
                            'dob' => $passenger->dob,
                            'gender' => $passenger->gender,
                            'seat_price' => $passenger->seat_price,
                        ];
                    }),
                    'created_at' => $booking->created_at,
                    'is_past' => $schedule ? 
                        strtotime($schedule->departure_date) < strtotime(now()->format('Y-m-d')) : 
                        false,
                    'can_resell' => $schedule && 
                        strtotime($schedule->departure_date) > strtotime(now()->format('Y-m-d')) && 
                        $booking->status === 'confirmed' && 
                        !$booking->resale,
                    'resale_info' => $booking->resale ? [
                        'asking_price' => $booking->resale->asking_price,
                        'status' => $booking->resale->status,
                        'expires_at' => $booking->resale->expires_at,
                    ] : null,
                    'debug_info' => [
                        'schedule_id' => $booking->bus_schedule_id,
                        'has_schedule' => $schedule ? 'yes' : 'no',
                        'has_route' => $route ? 'yes' : 'no',
                        'has_bus' => $bus ? 'yes' : 'no',
                        'has_agency' => $agency ? 'yes' : 'no'
                    ]
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedBookings,
                'debug_info' => [
                    'total_bookings' => $bookings->count(),
                    'email_searched' => $email,
                    'first_booking_reference' => $bookings->first()?->bookingreference ?? 'No bookings found',
                    'booking_ids' => $bookings->pluck('id')->toArray()
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error("Error in getTicketHistory: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while fetching the ticket history',
                'debug_info' => [
                    'error_message' => $e->getMessage(),
                    'error_trace' => $e->getTraceAsString()
                ]
            ], 500);
        }
    }

    // Add a debug method to check the database directly
    public function debugBookings($email)
    {
        // Get all bookings without any conditions first
        $allBookings = BusBooking::select('id', 'bookingreference', 'contact_email', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        // Then get bookings matching the email
        $matchingBookings = BusBooking::where('contact_email', 'LIKE', '%' . $email . '%')
            ->select('id', 'bookingreference', 'contact_email', 'created_at')
            ->get();
            
        return response()->json([
            'debug_info' => [
                'searched_email' => $email,
                'total_bookings_in_system' => BusBooking::count(),
                'recent_bookings' => $allBookings,
                'matching_bookings' => $matchingBookings,
                'all_possible_emails' => BusBooking::distinct()->pluck('contact_email')->toArray()
            ]
        ]);
    }

    public function putTicketForResale(Request $request, BusBooking $booking)
    {
        // Check if the booking belongs to the authenticated user
        if ($booking->contact_email !== Auth::user()->email) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if the booking is already up for resale
        if ($booking->resale) {
            return response()->json(['error' => 'This ticket is already listed for resale'], 400);
        }

        // Validate the request
        $validated = $request->validate([
            'asking_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'expires_at' => 'nullable|date|after:today'
        ]);

        // Create the resale listing
        $resale = TicketResale::create([
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'asking_price' => $validated['asking_price'],
            'description' => $validated['description'] ?? null,
            'status' => 'active',
            'expires_at' => $validated['expires_at'] ?? null
        ]);

        return response()->json([
            'message' => 'Ticket listed for resale successfully',
            'resale' => $resale
        ]);
    }

    public function show(BusBooking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for modifying a booking.
     *
     * @param  \App\Models\BusBooking  $booking
     * @return \Illuminate\Http\Response
     */
    public function showModificationForm(BusBooking $booking)
    {
        // Check if the booking belongs to the authenticated user
        if ($booking->contact_email !== Auth::user()->email) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Check if the booking can be modified (24 hours before departure)
        if (strtotime($booking->schedule->departure_date) <= strtotime(now()->addHours(24))) {
            return redirect()->route('dashboard')->with('error', 'This booking cannot be modified as it is less than 24 hours before departure.');
        }

        // Get the pickup and dropoff points
        $pickupPoint = $booking->pickupPoint;
        $dropoffPoint = $booking->dropoffPoint;

        // Check if pickup and dropoff points exist
        if (!$pickupPoint || !$dropoffPoint) {
            \Log::error('Missing pickup or dropoff point for booking modification', [
                'booking_id' => $booking->id,
                'pickup_point' => $pickupPoint ? $pickupPoint->id : 'null',
                'dropoff_point' => $dropoffPoint ? $dropoffPoint->id : 'null',
                'pickup_column' => $booking->pickup,
                'dropoff_column' => $booking->dropoff
            ]);
            return redirect()->route('dashboard')->with('error', 'Unable to modify this booking due to missing pickup or dropoff information.');
        }

        // Get the current agency ID
        $currentAgencyId = $booking->schedule->bus->agency_id;

        // Debug information
        \Log::info('Modification Form Debug:', [
            'booking_id' => $booking->id,
            'pickup_point' => $pickupPoint->name ?? 'N/A',
            'dropoff_point' => $dropoffPoint->name ?? 'N/A',
            'current_schedule_id' => $booking->schedule_id,
            'current_route_id' => $booking->schedule->route_id ?? 'N/A',
            'pickup_point_id' => $pickupPoint->id ?? 'N/A',
            'dropoff_point_id' => $dropoffPoint->id ?? 'N/A',
            'agency_id' => $currentAgencyId
        ]);

        // Get all fares for this pickup and dropoff combination
        $matchingFares = BusFare::where('pickup', $pickupPoint->id)
            ->where('dropoff', $dropoffPoint->id)
            ->where('agency_id', $currentAgencyId) // Only get fares for the same agency
            ->get();

        \Log::info('Matching Fares Query:', [
            'query' => [
                'pickup' => $pickupPoint->id,
                'dropoff' => $dropoffPoint->id,
                'agency_id' => $currentAgencyId
            ],
            'count' => $matchingFares->count(),
            'fares' => $matchingFares->toArray()
        ]);

        // Get all available schedules for these points from the same agency
        $availableSchedules = BusSchedules::with(['bus.agency', 'bus.layout', 'route', 'fare'])
            ->whereHas('route', function($query) use ($pickupPoint, $dropoffPoint) {
                $query->where('origin', 'like', '%' . $pickupPoint->name . '%')
                      ->where('destination', 'like', '%' . $dropoffPoint->name . '%');
            })
            ->whereHas('bus', function($query) use ($currentAgencyId) {
                $query->where('agency_id', $currentAgencyId); // Only get schedules from the same agency
            })
            ->where('departure_date', '>=', now()->format('Y-m-d'))
            ->where('departure_date', '<=', now()->addDays(30)->format('Y-m-d'))
            ->where('id', '!=', $booking->schedule_id)
            ->where('status', 'scheduled');

        \Log::info('Available Schedules Query:', [
            'query' => [
                'pickup' => $pickupPoint->name,
                'dropoff' => $dropoffPoint->name,
                'agency_id' => $currentAgencyId,
                'date_range' => [
                    'from' => now()->format('Y-m-d'),
                    'to' => now()->addDays(30)->format('Y-m-d')
                ],
                'exclude_schedule_id' => $booking->schedule_id
            ],
            'sql' => $availableSchedules->toSql(),
            'bindings' => $availableSchedules->getBindings()
        ]);

        $availableSchedules = $availableSchedules->get();

        \Log::info('Available Schedules Results:', [
            'count' => $availableSchedules->count(),
            'schedules' => $availableSchedules->toArray()
        ]);

        $availableSchedules = $availableSchedules->map(function ($schedule) use ($matchingFares, $pickupPoint, $dropoffPoint) {
            // Find the matching fare for this schedule's route and agency
            $fare = $matchingFares->first(function ($f) use ($schedule) {
                return $f->route_id == $schedule->route_id;
            });

            if (!$fare) {
                \Log::info('No matching fare found for schedule:', [
                    'schedule_id' => $schedule->id,
                    'route_id' => $schedule->route_id,
                    'agency_id' => $schedule->bus->agency_id,
                    'schedule_details' => $schedule->toArray()
                ]);
                return null;
            }

            // Calculate seats left
            $totalSeats = $schedule->bus->layout->total_seats ?? 0;
            $bookedSeats = BusPassengers::where('schedule_id', $schedule->id)->count();
            $seatsLeft = max($totalSeats - $bookedSeats, 0);

            return [
                'id' => $schedule->id,
                'departure_date' => $schedule->departure_date,
                'departure_time' => $fare->departure_time,
                'arrival_time' => $fare->arrival_time,
                'fare' => $fare->amount,
                'currency' => $fare->currency,
                'pickup' => $pickupPoint->name,
                'dropoff' => $dropoffPoint->name,
                'bus' => $schedule->bus,
                'route' => $schedule->route,
                'seats_left' => $seatsLeft
            ];
        })
        ->filter() // Remove any null entries
        ->sortBy('departure_date')
        ->sortBy('departure_time')
        ->values();

        \Log::info('Final Available Schedules:', [
            'count' => $availableSchedules->count(),
            'schedules' => $availableSchedules->toArray()
        ]);

        return view('bookings.modify', compact('booking', 'availableSchedules'));
    }

    /**
     * Handle the booking modification request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusBooking  $booking
     * @return \Illuminate\Http\Response
     */
    public function modifyBooking(Request $request, BusBooking $booking)
    {
        try {
            // Check if the booking belongs to the authenticated user
            if ($booking->contact_email !== Auth::user()->email) {
                \Log::error('Unauthorized booking modification attempt', [
                    'booking_id' => $booking->id,
                    'user_email' => Auth::user()->email,
                    'booking_email' => $booking->contact_email
                ]);
                return response()->json(['error' => 'Unauthorized access.'], 403);
            }

            // Validate the request
            $validated = $request->validate([
                'new_schedule_id' => 'required|exists:bus_schedules,id',
                'reason' => 'required|string|max:255',
                'comment' => 'nullable|string|max:1000'
            ]);

            \Log::info('Starting booking modification process', [
                'booking_id' => $booking->id,
                'new_schedule_id' => $validated['new_schedule_id'],
                'current_schedule_id' => $booking->schedule_id
            ]);

            // Check if the booking can be modified
            if (strtotime($booking->schedule->departure_date) <= strtotime(now()->addHours(24))) {
                \Log::warning('Booking modification attempted within 24 hours of departure', [
                    'booking_id' => $booking->id,
                    'departure_date' => $booking->schedule->departure_date
                ]);
                return response()->json(['error' => 'This booking cannot be modified as it is less than 24 hours before departure.'], 422);
            }

            // Get the new schedule
            $newSchedule = BusSchedules::with(['bus', 'route'])->findOrFail($validated['new_schedule_id']);

            // Verify the new schedule is from the same agency
            if ($newSchedule->bus->agency_id !== $booking->schedule->bus->agency_id) {
                return response()->json(['error' => 'You can only modify to schedules from the same bus company.'], 422);
            }

            \Log::info('New schedule details', [
                'new_schedule_id' => $newSchedule->id,
                'route_id' => $newSchedule->route_id,
                'bus_id' => $newSchedule->bus_id,
                'total_seats' => $newSchedule->bus->total_seats ?? 'N/A'
            ]);

            // Check if the new schedule has enough seats
            $bookedSeats = BusPassengers::where('schedule_id', $newSchedule->id)
                ->pluck('seat')
                ->toArray();
            
            $totalSeats = $newSchedule->bus->total_seats ?? 0;
            $availableSeats = array_diff(range(1, $totalSeats), $bookedSeats);
            
            \Log::info('Seat availability check', [
                'total_seats' => $totalSeats,
                'booked_seats' => count($bookedSeats),
                'available_seats' => count($availableSeats),
                'required_seats' => $booking->passengers->count()
            ]);

            if (count($availableSeats) < $booking->passengers->count()) {
                \Log::warning('Insufficient seats available for modification', [
                    'booking_id' => $booking->id,
                    'available_seats' => count($availableSeats),
                    'required_seats' => $booking->passengers->count()
                ]);
                return response()->json(['error' => 'Not enough seats available on the selected schedule.'], 422);
            }

            DB::beginTransaction();
            try {
                // Update the booking with the new schedule
                $booking->update([
                    'bus_schedule_id' => $newSchedule->id,
                    'status' => 'confirmed',
                ]);

                \Log::info('Booking updated with new schedule', [
                    'booking_id' => $booking->id,
                    'new_schedule_id' => $newSchedule->id,
                    'status' => 'confirmed'
                ]);

                // Update passenger seats
                $newSeats = array_slice($availableSeats, 0, $booking->passengers->count());
                foreach ($booking->passengers as $index => $passenger) {
                    $passenger->update([
                        'schedule_id' => $newSchedule->id,
                        'seat' => $newSeats[$index],
                    ]);
                }

                \Log::info('Passenger seats updated', [
                    'booking_id' => $booking->id,
                    'passenger_count' => $booking->passengers->count(),
                    'new_seats' => $newSeats
                ]);

                // Create a modification record
                DB::table('booking_modifications')->insert([
                    'booking_id' => $booking->id,
                    'old_schedule_id' => $booking->bus_schedule_id,
                    'new_schedule_id' => $newSchedule->id,
                    'reason' => $validated['reason'],
                    'comment' => $validated['comment'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                \Log::info('Modification record created', [
                    'booking_id' => $booking->id,
                    'old_schedule_id' => $booking->bus_schedule_id,
                    'new_schedule_id' => $newSchedule->id
                ]);

                DB::commit();

                // Send email notification
                try {
                    Mail::send('emails.booking-modified', [
                        'booking' => $booking,
                        'oldSchedule' => $booking->schedule,
                        'newSchedule' => $newSchedule,
                        'reason' => $validated['reason']
                    ], function ($message) use ($booking) {
                        $message->to($booking->contact_email)
                            ->subject("Booking Modified - Reference: {$booking->bookingreference}");
                    });
                } catch (\Exception $e) {
                    \Log::error('Failed to send modification email', [
                        'booking_id' => $booking->id,
                        'error' => $e->getMessage()
                    ]);
                }

                return response()->json([
                    'message' => 'Booking modified successfully',
                    'redirect' => route('bookings.show', $booking->id)
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Error during booking modification transaction', [
                    'booking_id' => $booking->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return response()->json(['error' => 'An error occurred while modifying the booking: ' . $e->getMessage()], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Error in modifyBooking method', [
                'booking_id' => $booking->id ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'An error occurred while modifying the booking: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Handle the booking cancellation request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusBooking  $booking
     * @return \Illuminate\Http\Response
     */
    public function cancelBooking(Request $request, BusBooking $booking)
    {
        // Check if the booking belongs to the authenticated user
        if ($booking->contact_email !== Auth::user()->email) {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        // Validate the request
        $validated = $request->validate([
            'reason' => 'required|string|max:255',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if the booking can be cancelled
        $departureTime = strtotime($booking->schedule->departure_date . ' ' . $booking->schedule->departure_time);
        $currentTime = strtotime(now());
        $hoursUntilDeparture = ($departureTime - $currentTime) / 3600;

        if ($hoursUntilDeparture < 12) {
            return response()->json(['error' => 'This booking cannot be cancelled as it is less than 12 hours before departure.'], 422);
        }

        DB::beginTransaction();
        try {
            // Calculate refund amount based on cancellation policy
            $refundAmount = 0;
            if ($hoursUntilDeparture >= 24) {
                $refundAmount = $booking->total_amount * 0.9; // 90% refund (minus 10% processing fee)
            } else {
                $refundAmount = $booking->total_amount * 0.5; // 50% refund
            }

            // Update booking status
            $booking->update([
                'status' => 'cancelled',
                'refund_amount' => $refundAmount,
            ]);

            // Create cancellation record
            DB::table('booking_cancellations')->insert([
                'booking_id' => $booking->id,
                'reason' => $validated['reason'],
                'comment' => $validated['comment'],
                'refund_amount' => $refundAmount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // If there's a refund, create a refund record
            if ($refundAmount > 0) {
                DB::table('refunds')->insert([
                    'booking_id' => $booking->id,
                    'amount' => $refundAmount,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Booking cancelled successfully',
                'refund_amount' => $refundAmount,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while cancelling the booking.'], 500);
        }
    }

    public function downloadTicket(BusBooking $booking)
    {
        // Check if user is authorized to download this ticket
        if ($booking->contact_email !== Auth::user()->email) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Get or create ticket
        $ticket = $booking->ticket ?? $this->ticketService->generateTicket($booking);

        // Generate PDF
        $pdf = $this->ticketService->generateTicketPdf($ticket);

        // Return PDF download
        return $pdf->download('ticket-' . $ticket->ticket_number . '.pdf');
    }

    /**
     * Handle seat selection for virtual routes (when bus_schedules is empty)
     */
    private function seatSelectionFromRoute($pickup, $dropoff, $routeId)
    {
        try {
            $route = \App\Models\BusRoutes::with('agency')->find($routeId);

            if (!$route) {
                return back()->with('error', 'Route not found.');
            }

            $bus = \Illuminate\Support\Facades\DB::table('buses')
                ->where('agency_id', $route->agency_id)
                ->first();

            $fare = \App\Models\BusFare::where('route_id', $routeId)->first();
            $amount = (float)($fare ? $fare->amount : ($route->adult_price ?? 10));
            $currency = $fare ? ($fare->currency ?? 'USD') : 'USD';
            $depTime = $fare ? ($fare->departure_time ?? '08:00:00') : '08:00:00';
            $arrTime = $fare ? ($fare->arrival_time ?? '16:00:00') : '16:00:00';
            $capacity = $bus ? ($bus->capacity ?? 40) : 40;

            // Build seat rows (4 columns)
            $rows = [];
            $seatNum = 1;
            for ($r = 0; $r < ceil($capacity / 4); $r++) {
                $rowSeats = [];
                $rowLetter = chr(65 + $r);
                for ($c = 1; $c <= 4 && $seatNum <= $capacity; $c++) {
                    $rowSeats[] = $rowLetter . $c;
                    $seatNum++;
                }
                $rows[] = ['row' => $r + 1, 'seats' => $rowSeats];
            }

            // Build a proper agency object
            $agency = $route->agency;
            $agencyData = (object)[
                'id' => $route->agency_id,
                'agency_name' => optional($agency)->agency_name ?? 'Bus Operator',
                'agency_logo' => optional($agency)->agency_logo ?? null,
            ];

            $busData = (object)[
                'id' => $bus ? $bus->id : null,
                'name' => $bus ? ($bus->name ?? 'Bus') : 'Bus',
                'agency_id' => $route->agency_id,
                'agency' => $agencyData,
                'layout' => (object)['total_seats' => $capacity],
            ];

            $scheduleData = (object)[
                'id' => 'route_' . $routeId,
                'route_id' => $routeId,
                'departure_time' => $depTime,
                'arrival_time' => $arrTime,
                'departure_date' => now()->addDay()->format('Y-m-d'),
                'status' => 'scheduled',
                'bus' => $busData,
                'route' => $route,
            ];

            return view('bus.booking.seat_selection', [
                'schedule' => $scheduleData,
                'returnSchedule' => null,
                'pickup' => $pickup,
                'dropoff' => $dropoff,
                'outboundPrice' => $amount,
                'outboundCurrency' => $currency,
                'returnPrice' => null,
                'returnCurrency' => null,
                'seatLayout' => ['rows' => $rows],
                'returnSeatLayout' => null,
                'bookedSeats' => [],
                'returnBookedSeats' => [],
                'baggagePolicy' => null,
                'discountCodes' => collect(),
            ]);
        } catch (\Exception $e) {
            \Log::error('seatSelectionFromRoute error: ' . $e->getMessage() . ' | ' . $e->getTraceAsString());
            return back()->with('error', 'Unable to load seat selection. Please try again.');
        }
    }
}
