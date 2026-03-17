<?php

namespace App\Http\Controllers;

use App\Models\TicketResale;
use App\Models\Bid;
use App\Models\BusBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\TicketSoldNotification;
use App\Notifications\TicketPurchasedNotification;
use App\Models\BusPassengers;
use App\Models\BusDocuments;

class TicketResaleController extends Controller
{
    public function index()
    {
        $resales = TicketResale::with(['booking', 'user'])
            ->where('status', 'active')
            ->latest()
            ->paginate(10);

        return view('ticket-resales.index', compact('resales'));
    }

    public function create(Request $request)
    {
        $bookings = BusBooking::where('contact_email', Auth::user()->email)
            ->where('status', 'confirmed')
            ->whereDoesntHave('resale', function($query) {
                $query->where('status', 'active');
            })
            ->with(['schedule', 'passengers'])
            ->get();

        $selectedBooking = null;
        if ($request->has('booking_id')) {
            $selectedBooking = $bookings->firstWhere('id', $request->booking_id);
        }
            
        return view('ticket-resales.create', compact('bookings', 'selectedBooking'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bus_bookings,id',
            'asking_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'expires_at' => 'nullable|date|after:today'
        ]);

        $booking = \App\Models\BusBooking::findOrFail($validated['booking_id']);
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'active';
        $validated['currency'] = $booking->currency ?? 'ZMW';

        TicketResale::create($validated);

        return redirect()->route('ticket-resales.index')
            ->with('success', 'Ticket listed for resale successfully!');
    }

    public function show(TicketResale $ticketResale)
    {
        $ticketResale->load(['booking', 'user', 'bids.user']);
        return view('ticket-resales.show', compact('ticketResale'));
    }

    public function placeBid(Request $request, TicketResale $ticketResale)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'message' => 'nullable|string',
            'converted_amount' => 'nullable|numeric|min:0'
        ]);

        if ($ticketResale->status !== 'active') {
            return back()->with('error', 'This ticket is no longer available for bidding.');
        }

        // Get the original currency of the ticket resale
        $originalCurrency = $ticketResale->currency ?? 'ZMW';
        $selectedCurrency = session('currency')['code'] ?? 'ZMW';
        
        // Use converted amount if available (from JavaScript), otherwise convert manually
        $bidAmount = $validated['converted_amount'] ?? $validated['amount'];
        
        if (!$validated['converted_amount'] && $selectedCurrency !== $originalCurrency) {
            $rates = session('currency')['rates'] ?? [];
            if (isset($rates[$selectedCurrency]) && isset($rates[$originalCurrency])) {
                $conversionRate = $rates[$originalCurrency] / $rates[$selectedCurrency];
                $bidAmount = $validated['amount'] * $conversionRate;
            }
        }

        // Validate against the asking price in the original currency
        if ($bidAmount <= $ticketResale->asking_price) {
            return back()->with('error', 'Bid amount must be higher than the asking price.');
        }

        Bid::create([
            'user_id' => Auth::id(),
            'ticket_resale_id' => $ticketResale->id,
            'amount' => $bidAmount,
            'currency' => $originalCurrency,
            'message' => $validated['message'] ?? '',
            'status' => 'pending'
        ]);

        return back()->with('success', 'Bid placed successfully!');
    }

    public function acceptBid(TicketResale $ticketResale, Bid $bid)
    {
        \Log::info('acceptBid called', [
            'ticketResale_id' => $ticketResale->id,
            'bid_id' => $bid->id,
            'user_id' => Auth::id(),
        ]);
        if ($ticketResale->user_id !== Auth::id()) {
            \Log::warning('Unauthorized action', ['ticketResale_user_id' => $ticketResale->user_id, 'auth_id' => Auth::id()]);
            return back()->with('error', 'Unauthorized action.');
        }

        if ($bid->ticket_resale_id !== $ticketResale->id) {
            \Log::warning('Invalid bid', ['bid_ticket_resale_id' => $bid->ticket_resale_id, 'ticketResale_id' => $ticketResale->id]);
            return back()->with('error', 'Invalid bid.');
        }

        DB::beginTransaction();
        try {
            \Log::info('Rejecting other bids...');
            $ticketResale->bids()->where('id', '!=', $bid->id)->update(['status' => 'rejected']);

            \Log::info('Accepting selected bid...');
            $bid->update(['status' => 'accepted']);

            \Log::info('Setting resale status to pending_payment...');
            $ticketResale->update(['status' => 'pending_payment']);

            DB::commit();
            \Log::info('Bid accepted, waiting for payment.');
            return back()->with('success', 'Bid accepted! Waiting for payment from the buyer.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Exception in acceptBid', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Failed to accept bid. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function rejectBid(Bid $bid)
    {
        \Log::info('rejectBid called', [
            'bid_id' => $bid->id,
            'user_id' => Auth::id(),
        ]);

        // Check if the user is the owner of the ticket resale
        if ($bid->ticketResale->user_id !== Auth::id()) {
            \Log::warning('Unauthorized action', ['ticketResale_user_id' => $bid->ticketResale->user_id, 'auth_id' => Auth::id()]);
            return back()->with('error', 'Unauthorized action.');
        }

        // Check if the bid is still pending
        if ($bid->status !== 'pending') {
            \Log::warning('Bid is not pending', ['bid_status' => $bid->status]);
            return back()->with('error', 'This bid cannot be rejected as it is not in pending status.');
        }

        try {
            $bid->update(['status' => 'rejected']);
            \Log::info('Bid rejected successfully');
            return back()->with('success', 'Bid rejected successfully.');
        } catch (\Exception $e) {
            \Log::error('Exception in rejectBid', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Failed to reject bid. Please try again.');
        }
    }

    public function myListings()
    {
        $resales = TicketResale::with(['booking', 'bids.user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('ticket-resales.my-listings', compact('resales'));
    }

    public function myBids()
    {
        $bids = Bid::with(['ticketResale.booking', 'ticketResale.user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('ticket-resales.my-bids', compact('bids'));
    }

    public function activities()
    {
        // Get user's ticket listings
        $userResales = TicketResale::with(['booking.schedule.bus.agency', 'bids'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Get user's bids
        $userBids = Bid::with(['ticketResale.booking.schedule.bus.agency', 'ticketResale.user'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Get resale statistics
        $activeListings = TicketResale::where('user_id', Auth::id())
            ->where('status', 'active')
            ->count();

        $totalBids = Bid::where('user_id', Auth::id())->count();
        $acceptedBids = Bid::where('user_id', Auth::id())
            ->where('status', 'accepted')
            ->count();

        $soldListings = TicketResale::where('user_id', Auth::id())
            ->where('status', 'sold')
            ->count();

        $totalEarnings = TicketResale::where('ticket_resales.user_id', Auth::id())
            ->where('ticket_resales.status', 'sold')
            ->join('bids', 'ticket_resales.id', '=', 'bids.ticket_resale_id')
            ->where('bids.status', 'accepted')
            ->sum('bids.amount');

        return view('account.activities', compact(
            'userResales',
            'userBids',
            'activeListings',
            'totalBids',
            'acceptedBids',
            'soldListings',
            'totalEarnings'
        ));
    }

    public function showPaymentForm(TicketResale $ticketResale)
    {
        $bid = $ticketResale->bids()->where('status', 'accepted')->first();
        if (!$bid || Auth::id() !== $bid->user_id || $ticketResale->status !== 'pending_payment') {
            abort(403, 'Unauthorized or invalid payment attempt.');
        }
        $token = uniqid('resale_', true);
        session(['resale_payment_token' => $token, 'resale_id' => $ticketResale->id]);
        return view('checkout.resale', [
            'ticketResale' => $ticketResale,
            'bid' => $bid,
            'token' => $token,
            'currency' => $bid->currency ?? 'ZMW',
        ]);
    }

    public function showPassengerDetailsForm(TicketResale $ticketResale)
    {
        \Log::info('showPassengerDetailsForm called', [
            'ticketResale_id' => $ticketResale->id,
            'ticketResale_status' => $ticketResale->status,
            'auth_user_id' => Auth::id(),
            'ticketResale_user_id' => $ticketResale->user_id
        ]);

        $bid = $ticketResale->bids()->where('status', 'accepted')->first();
        
        \Log::info('Bid check', [
            'bid_exists' => $bid ? true : false,
            'bid_id' => $bid ? $bid->id : null,
            'bid_user_id' => $bid ? $bid->user_id : null,
            'bid_status' => $bid ? $bid->status : null
        ]);

        // Handle different statuses appropriately
        if ($ticketResale->status === 'sold') {
            return redirect()->route('ticket-resales.show', $ticketResale)
                ->with('info', 'This ticket has already been sold and payment completed. You can view the ticket details here.');
        }

        if ($ticketResale->status === 'active') {
            return redirect()->route('ticket-resales.show', $ticketResale)
                ->with('info', 'No bid has been accepted yet. The ticket is still available for bidding.');
        }

        if ($ticketResale->status === 'expired') {
            return redirect()->route('ticket-resales.show', $ticketResale)
                ->with('info', 'This ticket resale has expired and is no longer available.');
        }

        if (!$bid) {
            \Log::warning('No accepted bid found for ticket resale', ['ticketResale_id' => $ticketResale->id]);
            return redirect()->route('ticket-resales.show', $ticketResale)
                ->with('error', 'No accepted bid found for this ticket resale.');
        }

        if (Auth::id() !== $bid->user_id) {
            \Log::warning('User not authorized - not the bidder', [
                'auth_user_id' => Auth::id(),
                'bid_user_id' => $bid->user_id
            ]);
            return redirect()->route('ticket-resales.show', $ticketResale)
                ->with('error', 'You are not authorized to access this payment form. Only the winning bidder can proceed.');
        }

        if ($ticketResale->status !== 'pending_payment') {
            \Log::warning('Ticket resale status is not pending_payment', [
                'ticketResale_id' => $ticketResale->id,
                'current_status' => $ticketResale->status,
                'expected_status' => 'pending_payment'
            ]);
            return redirect()->route('ticket-resales.show', $ticketResale)
                ->with('error', 'This ticket resale is not in the correct status for payment. Current status: ' . $ticketResale->status);
        }

        $booking = $ticketResale->booking;
        $numPassengers = $booking->passengers()->count();
        $seats = $booking->passengers()->pluck('seat')->toArray();
        
        // Get agency document types for the booking's agency
        $agencyDocumentTypes = $booking->schedule->bus->agency->documentTypes()
            ->active()
            ->ordered()
            ->get();
            
        // Get countries for dropdown
        $countries = \App\Models\Country::orderBy('country_name')->get();
            
        return view('checkout.resale_passenger_details', [
            'ticketResale' => $ticketResale,
            'bid' => $bid,
            'numPassengers' => $numPassengers,
            'seats' => $seats,
            'booking' => $booking,
            'agencyDocumentTypes' => $agencyDocumentTypes,
            'countries' => $countries,
        ]);
    }

    public function savePassengerDetails(Request $request, TicketResale $ticketResale)
    {
        $validated = $request->validate([
            'passengers' => 'required|array',
            'passengers.*.given_name' => 'required|string',
            'passengers.*.family_name' => 'required|string',
            'passengers.*.email' => 'required|email',
            'passengers.*.phone' => 'required|string',
            'passengers.*.dob' => 'required|date',
            'passengers.*.gender' => 'required|in:male,female',
            'passengers.*.title' => 'required|in:mr,mrs,miss',
            'passengers.*.seat' => 'nullable|string',
            // Support both old and new document structure
            'passengers.*.identity_document.type' => 'nullable|string',
            'passengers.*.identity_document.unique_identifier' => 'nullable|string',
            'passengers.*.identity_document.issuing_country_code' => 'nullable|string',
            'passengers.*.identity_document.expires_on' => 'nullable|date',
            'passengers.*.identity_documents.*.type' => 'nullable|string',
            'passengers.*.identity_documents.*.unique_identifier' => 'nullable|string',
            'passengers.*.identity_documents.*.issuing_country_code' => 'nullable|string',
            'passengers.*.identity_documents.*.expires_on' => 'nullable|date',
        ]);
        session(['resale_passenger_details' => $validated['passengers']]);
        return redirect()->route('ticket-resales.pay', $ticketResale);
    }

    public function handlePaymentCallback(Request $request)
    {
        $status = $request->get('status');
        $tx_ref = $request->get('tx_ref');
        $resaleId = session('resale_id');
        $ticketResale = TicketResale::findOrFail($resaleId);
        $bid = $ticketResale->bids()->where('status', 'accepted')->first();
        $passengerDetails = session('resale_passenger_details', []);

        if ($status === 'successful' && $bid) {
            \DB::transaction(function () use ($ticketResale, $bid, $passengerDetails) {
                $ticketResale->update(['status' => 'sold']);
                $booking = $ticketResale->booking;
                $booking->update([
                    'contact_email' => $bid->user->email,
                    'contact_phone' => $bid->user->phone ?? $booking->contact_phone,
                    'status' => 'resold'
                ]);
                // Update or create passengers and their identity documents
                foreach ($passengerDetails as $index => $pdata) {
                    $passenger = $booking->passengers[$index] ?? new BusPassengers();
                    $passenger->booking_id = $booking->id;
                    $passenger->seat = $pdata['seat'] ?? null;
                    $passenger->given_name = $pdata['given_name'];
                    $passenger->family_name = $pdata['family_name'];
                    $passenger->email = $pdata['email'];
                    $passenger->phone = $pdata['phone'];
                    $passenger->dob = $pdata['dob'];
                    $passenger->gender = $pdata['gender'];
                    $passenger->title = $pdata['title'];
                    $passenger->save();
                    // Handle identity documents - support both old and new structure
                    if (isset($pdata['identity_documents'])) {
                        // New structure with agency-specific documents
                        foreach ($pdata['identity_documents'] as $docTypeId => $documentData) {
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
                    } elseif (isset($pdata['identity_document'])) {
                        // Old structure with single document
                        $doc = $passenger->identityDocuments()->first() ?? new BusDocuments();
                        $doc->passenger_id = $passenger->id;
                        $doc->type = $pdata['identity_document']['type'];
                        $doc->unique_identifier = $pdata['identity_document']['unique_identifier'];
                        $doc->issuing_country_code = $pdata['identity_document']['issuing_country_code'];
                        $doc->expires_on = $pdata['identity_document']['expires_on'];
                        $doc->save();
                    }
                }
                $ticket = $booking->tickets()->first();
                if ($ticket) {
                    \DB::table('ticket_transactions')->insert([
                        'ticket_id' => $ticket->id,
                        'seller_id' => $ticketResale->user_id,
                        'buyer_id' => $bid->user_id,
                        'amount' => $bid->amount,
                        'status' => 'completed',
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            });
            session()->forget(['resale_passenger_details', 'resale_id', 'resale_payment_token']);
            return redirect()->route('ticket-resales.show', $ticketResale)->with('success', 'Payment successful! Ticket transferred.');
        } else {
            return redirect()->route('ticket-resales.show', $ticketResale)->with('error', 'Payment failed or cancelled.');
        }
    }
} 