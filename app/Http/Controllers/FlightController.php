<?php

namespace App\Http\Controllers;
use App\Models\FlightBookings;
use App\Models\FlightContacts;
use App\Models\FlightPassengers;
use App\Models\FlightIdentityDocuments;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class FlightController extends Controller
{

    public function Flights(){
        return view('flights.flights', ['title' => 'Flights — Coming Soon']);
    }

    public function searchFlights(Request $request)
    {

        $passengers = json_decode($request->input('passengers'), true);
        $slices = [
            [
                'origin' => $request->input('origin', 'NYC'),
                'destination' => $request->input('destination', 'ATL'),
                'departure_date' => $request->input('departure_date', '2024-10-29'),
            ]
        ];


        if ($request->filled('return_date')) {
            $slices[] = [
                'origin' => $request->input('destination', 'ATL'),
                'destination' => $request->input('origin', 'NYC'),
                'departure_date' => $request->input('return_date', '2024-10-30'),
            ];
        }


        $response = Http::withToken(env('DUFFEL_API_TOKEN'))
            ->withHeaders([
                'Duffel-Version' => env('DUFFEL_API_VERSION'),
                'Accept' => 'application/json',
            ])
            ->post(env('DUFFEL_BASE_URL') . 'offer_requests', [
                'data' => [
                    'slices' => $slices,
                    'passengers' => $passengers,
                    'cabin_class' => $request->input('cabin_class', 'business')
                ]
            ]);

        $flightOffers = $response->json();

        $origin = null;
        $destination = null;
        if (isset($flightOffers['data']['offers'][0]['slices'][0]['segments'][0])) {
            $segment = $flightOffers['data']['offers'][0]['slices'][0]['segments'][0];
            $origin = [
                'latitude' => $segment['origin']['latitude'],
                'longitude' => $segment['origin']['longitude'],
                'name' => $segment['origin']['city_name'] ?? 'Origin'
            ];
            $destination = [
                'latitude' => $segment['destination']['latitude'],
                'longitude' => $segment['destination']['longitude'],
                'name' => $segment['destination']['city_name'] ?? 'Destination'
            ];
        }

        return view('flights.results', compact('flightOffers', 'origin', 'destination'));
    }

    public function selectFlight(Request $request, $offerId)
    {
        $response = Http::withToken(env('DUFFEL_API_TOKEN'))
            ->withHeaders([
                'Duffel-Version' => env('DUFFEL_API_VERSION'),
                'Accept' => 'application/json',
            ])
            ->get(env('DUFFEL_BASE_URL') . "offers/{$offerId}");

        $selectedOffer = $response->json();


        $flightDetails = [
            'total_amount' => $selectedOffer['data']['total_amount'],
            'base_amount' => $selectedOffer['data']['base_amount'],
            'tax_amount' => $selectedOffer['data']['tax_amount'],
            'slices' => $selectedOffer['data']['slices'],
            'currency' => $selectedOffer['data']['total_currency'],
        ];

        $passengers = $selectedOffer['data']['passengers'];

        session(['selected_offer_id' => $offerId, 'total_amount' => $flightDetails['total_amount'], 'currency' => $flightDetails['currency']]);

        return view('flights.passengerDetails', [
            'flightDetails' => $flightDetails,
            'passengers' => $passengers,
            'offerId' => $offerId,
            'currency' => $flightDetails['currency'],
        ]);
    }


    public function flightCheckout(Request $request)
    {
        $validatedData = $request->validate([
            'contact_phone' => 'required|string',
            'contact_email' => 'required|email',
            'currency' => 'required|string',
            'offer_id' => 'required',
            'passengers' => 'required|array',
            'amount' => 'required',

        ]);

        $selectedOfferId = session('selected_offer_id');
        // $totalCurrency = $request->input('currency');
        $totalAmount = session('total_amount');
        $passengers = $request->input('passengers');


        $token = uniqid();
        Log::info("Payment Token details: tx_ref: $token");

        // Log::info("Checkout method checking for seat details: $validatedData");

          // Start the session and store data
        Session::put('booking_data', $validatedData);

        Session::put('passengers', $passengers);
        Session::put('tx_ref', $token);

        $currency = $validatedData['currency'];

        return view('checkout.checkout_flight', [
            'data' => $validatedData,
            'numberOfPassengers' => count(explode(',', $request->input('outboundSeats'))),
            'token' => $token,
            'currency' => $currency,
            'passengers' => $passengers,
        ]);
    }


    public function handleFlightPaymentCallback(Request $request)
    {
        $selectedOfferId = Session::get('selected_offer_id');
        $totalCurrency = Session::get('currency');
        $totalAmount = Session::get('total_amount');
        $passengers = Session::get('passengers', []); // Default to an empty array if null
        $data = Session::get('booking_data');

        $tx_ref = $request->get('tx_ref');
        $status = $request->get('status');
        $transaction_id = $request->get('transaction_id');
        $bookingreference = Session::get('tx_ref');

        // Log details
        Log::info("Payment callback details", [
            'tx_ref' => $tx_ref,
            'status' => $status,
            'transaction_id' => $transaction_id,
            'expected_tx_ref' => $bookingreference
        ]);

        if ($tx_ref !== $bookingreference) {
            return redirect()->route('flights.passengerDetails')->with('error', 'Transaction reference mismatch.');
        }

        if ($status === 'successful') {
            Log::info('Passenger data received:', ['passengers' => $passengers]);

            if (empty($passengers)) {
                Log::error('No passenger data available in session.');
                return redirect()->back()->withErrors('No passenger data found. Please try again.');
            }

            $contactPhone = $data['contact_phone'] ?? null;
            $contactEmail = $data['contact_email'] ?? null;

            $formattedPassengers = array_map(function ($passenger) {
                return [
                    'phone_number' => $passenger['phone_number'],
                    'email' => $passenger['email'],
                    'born_on' => $passenger['born_on'],
                    'title' => $passenger['title'],
                    'gender' => $passenger['gender'],
                    'family_name' => $passenger['family_name'],
                    'given_name' => $passenger['given_name'],
                    'id' => $passenger['id'],
                    'infant_passenger_id' => $passenger['infant_passenger_id'] ?? null,
                    'identity_documents' => [
                        [
                            'unique_identifier' => $passenger['identity_documents']['unique_identifier'],
                            'type' => $passenger['identity_documents']['type'],
                            'issuing_country_code' => $passenger['identity_documents']['issuing_country_code'],
                            'expires_on' => $passenger['identity_documents']['expires_on']
                        ]
                    ],
                ];
            }, $passengers);

            $bookingData = [
                'data' => [
                    'selected_offers' => [$selectedOfferId],
                    'payments' => [
                        [
                            'type' => 'balance',
                            'currency' => $totalCurrency,
                            'amount' => $totalAmount ?? '0.00',
                        ]
                    ],
                    'passengers' => $formattedPassengers,
                ],
            ];

            $response = Http::withToken(env('DUFFEL_API_TOKEN'))
                ->withHeaders([
                    'Duffel-Version' => env('DUFFEL_API_VERSION'),
                    'Accept' => 'application/json',
                ])
                ->post(env('DUFFEL_BASE_URL') . 'orders', $bookingData);

            $booking = $response->json();
            Log::info('Duffel API booking response:', $booking);

            if (isset($booking['data'])) {
                $bookingData = $booking['data'];

                $storedBooking = FlightBookings::create([
                    'booking_id' => $bookingData['id'],
                    'offer_id' => $selectedOfferId,
                    'currency' => $bookingData['total_currency'] ?? 'unknown',
                    'total_amount' => $bookingData['total_amount'] ?? $totalAmount,
                    'tax_amount' => $bookingData['tax_amount'] ?? 0,
                    'base_amount' => $bookingData['base_amount'] ?? 0,
                    'booking_reference' => $bookingData['booking_reference'] ?? null
                ]);

                FlightContacts::create([
                    'booking_id' => $storedBooking->id,
                    'email' => $contactEmail,
                    'phone_number' => $contactPhone
                ]);

                foreach ($passengers as $passengerData) {
                    $storedPassenger = FlightPassengers::create([
                        'booking_id' => $storedBooking->id,
                        'passenger_id' => $passengerData['id'],
                        'phone_number' => $passengerData['phone_number'],
                        'email' => $passengerData['email'],
                        'born_on' => $passengerData['born_on'],
                        'title' => $passengerData['title'],
                        'gender' => $passengerData['gender'],
                        'family_name' => $passengerData['family_name'],
                        'given_name' => $passengerData['given_name'],
                        'infant_passenger_id' => $passengerData['infant_passenger_id'] ?? null
                    ]);

                    FlightIdentityDocuments::create([
                        'passenger_id' => $storedPassenger->id,
                        'unique_identifier' => $passengerData['identity_documents']['unique_identifier'],
                        'document_type' => $passengerData['identity_documents']['type'],
                        'issuing_country_code' => $passengerData['identity_documents']['issuing_country_code'],
                        'expires_on' => $passengerData['identity_documents']['expires_on']
                    ]);
                }

                Notification::create([
                    'type' => 'flight_booking',
                    'title' => 'New Flight Booking',
                    'message' => "A Flight booking was made",
                ]);

                // Forget session variables
                session()->forget(['selected_offer_id', 'total_currency', 'total_amount', 'passengers', 'currency']);

                return view('flights.booking_confirmation', ['booking' => $bookingData]);
            } else {
                Log::error('Booking data not available:', $booking);
                return view('flights.booking_confirmation', [
                    'booking' => null,
                    'api_response' => $booking
                ]);
            }
        } elseif ($status === 'cancelled') {
            return redirect()->route('flights.passengerDetails')->with('error', 'Payment was cancelled.');
        } else {
            return redirect()->route('flights.passengerDetails')->with('error', 'There was an issue processing your booking. Please try again.');
        }
    }


    public function bookFlight(Request $request)
    {
        $selectedOfferId = session('selected_offer_id');
        $totalCurrency = $request->input('currency');
        $totalAmount = session('total_amount');
        $passengers = $request->input('passengers');


        Log::info('Passenger data received:', ['passengers' => $passengers]);

        if (empty($passengers)) {
            Log::error('No passenger data available in request');
            return redirect()->back()->withErrors('No passenger data found. Please try again.');
        }


        $formattedPassengers = array_map(function ($passenger) {
            return [
                'phone_number' => $passenger['phone_number'],
                'email' => $passenger['email'],
                'born_on' => $passenger['born_on'],
                'title' => $passenger['title'],
                'gender' => $passenger['gender'],
                'family_name' => $passenger['family_name'],
                'given_name' => $passenger['given_name'],
                'id' => $passenger['id'],
                'infant_passenger_id' => $passenger['infant_passenger_id'] ?? null,
                'identity_documents' => [
                    [
                        'unique_identifier' => $passenger['identity_documents']['unique_identifier'],
                        'type' => $passenger['identity_documents']['type'],
                        'issuing_country_code' => $passenger['identity_documents']['issuing_country_code'],
                        'expires_on' => $passenger['identity_documents']['expires_on']
                    ]
                ],
            ];
        }, $passengers);


        $bookingData = [
            'data' => [
                'selected_offers' => [$selectedOfferId],
                'payments' => [
                    [
                        'type' => 'balance',
                        'currency' => $totalCurrency,
                        'amount' => $totalAmount ?? '0.00',
                    ]
                ],
                'passengers' => $formattedPassengers,
            ],
        ];

        $response = Http::withToken(env('DUFFEL_API_TOKEN'))
            ->withHeaders([
                'Duffel-Version' => env('DUFFEL_API_VERSION'),
                'Accept' => 'application/json',
            ])
            ->post(env('DUFFEL_BASE_URL') . 'orders', $bookingData);

        $booking = $response->json();
        Log::info('Duffel API booking response:', $booking);


        if (isset($booking['data'])) {
            $bookingData = $booking['data'];

            $storedBooking = FlightBookings::create([
                'booking_id' => $bookingData['id'],
                'offer_id' => $selectedOfferId,
                'currency' => $bookingData['total_currency'] ?? 'unknown',
                'total_amount' => $bookingData['total_amount'] ?? $totalAmount,
                'tax_amount' => $bookingData['tax_amount'] ?? 0,
                'base_amount' => $bookingData['base_amount'] ?? 0,
                'booking_reference' => $bookingData['booking_reference'] ?? null
            ]);


            FlightContacts::create([
                'booking_id' => $storedBooking->id,
                'email' => $request->input('contact_email'),
                'phone_number' => $request->input('contact_phone')
            ]);

            foreach ($passengers as $passengerData) {
                $storedPassenger = FlightPassengers::create([
                    'booking_id' => $storedBooking->id,
                    'passenger_id' => $passengerData['id'],
                    'phone_number' => $passengerData['phone_number'],
                    'email' => $passengerData['email'],
                    'born_on' => $passengerData['born_on'],
                    'title' => $passengerData['title'],
                    'gender' => $passengerData['gender'],
                    'family_name' => $passengerData['family_name'],
                    'given_name' => $passengerData['given_name'],
                    'infant_passenger_id' => $passengerData['infant_passenger_id'] ?? null
                ]);


                FlightIdentityDocuments::create([
                    'passenger_id' => $storedPassenger->id,
                    'unique_identifier' => $passengerData['identity_documents']['unique_identifier'],
                    'document_type' => $passengerData['identity_documents']['type'],
                    'issuing_country_code' => $passengerData['identity_documents']['issuing_country_code'],
                    'expires_on' => $passengerData['identity_documents']['expires_on']
                ]);
            }

            Notification::create([
                'type' => 'flight_booking',
                'title' => 'New Flight Booking',
                'message' => "A Flight booking was made",
            ]);

            session()->forget(['selected_offer_id', 'total_currency', 'total_amount', 'passengers']);

            return view('flights.booking_confirmation', ['booking' => $bookingData]);
        } else {
            Log::error('Booking data not available:', $booking);
            return view('flights.booking_confirmation', [
                'booking' => null,
                'api_response' => $booking
            ]);
        }
    }



    public function confirmBooking(Request $request)
    {

        $validatedData = $request->validate([
            'passengers' => 'required|array',
            'offer_id' => 'required|string',
            'currency' => 'required|string',
            'amount' => 'required|numeric',
        ]);


        $passengers = $validatedData['passengers'];
        $selectedOfferId = $validatedData['offer_id'];
        $totalCurrency = $validatedData['currency'];
        $totalAmount = $validatedData['amount'];

        return view('flights.confirmBooking', compact('passengers', 'selectedOfferId', 'totalCurrency', 'totalAmount'));
    }
}
