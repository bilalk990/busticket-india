<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\BusSchedules;
use App\Models\BusFare;
use App\Models\BusPoint;
use Carbon\Carbon;
use App\Models\BusPassengers;
use App\Models\Rating;
use Illuminate\Support\Facades\Cache;

class BusSearchController extends Controller
{
    public function searchBus()
    {
        return view('bus.search.bus');
    }


    // public function results(Request $request)
    // {
    // $request->validate([
    //     'origin' => 'required',
    //     'destination' => 'required',
    //     'travel_date' => 'required|date',
    //     'return_date' => 'nullable|date|after_or_equal:travel_date',
    // ]);

    // Log::info('Bus search request data:', $request->all());

    // $originPoint = BusPoint::where('name', $request->origin)->first();
    // $destinationPoint = BusPoint::where('name', $request->destination)->first();

    // if (!$originPoint || !$destinationPoint) {
    //     return view('bus.search.results', [
    //         'schedules' => collect(),
    //         'returnSchedules' => collect(),
    //         'originLat' => $request->origin_lat,
    //         'originLng' => $request->origin_lng,
    //         'destinationLat' => $request->destination_lat,
    //         'destinationLng' => $request->destination_lng
    //     ]);
    // }

    // $matchingFares = BusFare::where('pickup', $originPoint->id)
    //     ->where('dropoff', $destinationPoint->id)
    //     ->get();

    // $selectedCurrency = session('currency')['code'] ?? 'ZMW';
    // $exchangeRates = session('currency')['rates'] ?? [];

    // $schedules = BusSchedules::with(['bus.agency', 'route'])
    //     ->whereIn('route_id', $matchingFares->pluck('route_id'))
    //     ->where('departure_date', $request->travel_date)
    //     ->get()
    //     ->filter(function ($schedule) use ($matchingFares, $request) {
    //         // Apply filters dynamically
    //         $match = $matchingFares->contains('route_id', $schedule->route_id);

    //         if ($request->has('min_price') && $request->has('max_price')) {
    //             $fare = $matchingFares->firstWhere('route_id', $schedule->route_id);
    //             if ($fare) {
    //                 $match = $match && $fare->amount >= $request->min_price && $fare->amount <= $request->max_price;
    //             }
    //         }

    //         if ($request->has('bus_agency')) {
    //             $match = $match && in_array($schedule->bus->agency->id, $request->bus_agency);
    //         }

    //         if ($request->has('departure_time')) {
    //             $departureTime = Carbon::parse($schedule->departure_time)->format('H:i');
    //             $match = $match && $departureTime >= $request->departure_time;
    //         }

    //         return $match;
    //     })
    //     ->map(function ($schedule) use ($matchingFares, $originPoint, $destinationPoint, $selectedCurrency, $exchangeRates) {
    //         $departureTime = Carbon::parse($schedule->departure_time);
    //         $arrivalTime = Carbon::parse($schedule->arrival_time);
    //         $schedule->duration = $arrivalTime->diff($departureTime)->format('%H:%I');

    //         $fare = $matchingFares->firstWhere('route_id', $schedule->route_id);
    //         $schedule->fare = $fare ? $fare->amount : null;
    //         $schedule->currency = $fare ? $fare->currency : null;
    //         $schedule->pickup = $originPoint->name;
    //         $schedule->dropoff = $destinationPoint->name;

    //         // Currency conversion
    //         $originalCurrency = $schedule->currency;
    //         $originalFare = $schedule->fare;
    //         $conversionRate = $exchangeRates[$originalCurrency] ?? 1;
    //         $toSelectedCurrencyRate = $exchangeRates[$selectedCurrency] ?? 1;
    //         $schedule->convertedFare = ($originalFare / $conversionRate) * $toSelectedCurrencyRate;
    //         $schedule->selectedCurrency = $selectedCurrency;

    //         return $schedule;
    //     });

    // return view('bus.search.results', [
    //     'schedules' => $schedules,
    //     'originLat' => $request->origin_lat,
    //     'originLng' => $request->origin_lng,
    //     'destinationLat' => $request->destination_lat,
    //     'destinationLng' => $request->destination_lng,
    // ]);
    // }




    public function results(Request $request)
    {
        $request->validate([
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'travel_date' => 'required|date|after_or_equal:today',
            'return_date' => 'nullable|date|after:travel_date',
            'travel_type' => 'nullable|in:oneway,roundtrip',
        ]);

        // Set default travel type if not provided
        $travelType = $request->input('travel_type', 'oneway');
        
        // Additional validation
        $errors = [];
        
        // Check if origin and destination are the same
        if (strtolower(trim($request->origin)) === strtolower(trim($request->destination))) {
            $errors['destination'] = 'Origin and destination cannot be the same.';
        }
        
        // If travel type is roundtrip, require return date
        if ($travelType === 'roundtrip' && !$request->filled('return_date')) {
            $errors['return_date'] = 'Return date is required for round trip.';
        }
        
        // If travel type is oneway, clear return date
        if ($travelType === 'oneway' && $request->filled('return_date')) {
            $request->merge(['return_date' => null]);
        }
        
        // If there are validation errors, return with errors
        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        Log::info('Bus search request data:', $request->all());

        // Find the corresponding point IDs for origin and destination
        // Use LIKE matching since Google Places may return "City, Region, Country" format
        $originName = trim(explode(',', $request->origin)[0]);
        $destinationName = trim(explode(',', $request->destination)[0]);

        // Try exact match first, then LIKE match
        $originPoint = BusPoint::where('name', $request->origin)->first();
        if (!$originPoint) {
            $originPoint = BusPoint::where('name', 'LIKE', "%{$originName}%")->first();
        }
        
        $destinationPoint = BusPoint::where('name', $request->destination)->first();
        if (!$destinationPoint) {
            $destinationPoint = BusPoint::where('name', 'LIKE', "%{$destinationName}%")->first();
        }
        
        // Debug logging
        Log::info('Search Debug:', [
            'origin_input' => $request->origin,
            'destination_input' => $request->destination,
            'origin_name_extracted' => $originName,
            'destination_name_extracted' => $destinationName,
            'origin_point_found' => $originPoint ? $originPoint->id : null,
            'destination_point_found' => $destinationPoint ? $destinationPoint->id : null
        ]);

        if (!$originPoint || !$destinationPoint) {
            return view('bus.search.results', [
                'schedules' => collect(),
                'returnSchedules' => collect(),
                'filters' => [
                    'price_range' => ['min' => 0, 'max' => 0],
                    'bus_types' => [],
                    'seat_layouts' => [],
                    'departure_times' => [
                        'morning' => 0,
                        'afternoon' => 0,
                        'evening' => 0,
                        'night' => 0
                    ],
                    'amenities' => [],
                    'agencies' => []
                ],
                'originLat' => $request->origin_lat,
                'originLng' => $request->origin_lng,
                'destinationLat' => $request->destination_lat,
                'destinationLng' => $request->destination_lng,
                'travel_type' => $travelType,
                'recommended_price' => null,
                'recommended_duration' => null,
                'cheapest_price' => null,
                'fastest_duration' => null,
                'min_price' => null,
                'max_price' => null,
                'bus_types' => collect(),
                'departure_times' => collect(),
                'amenities' => collect(),
                'seat_types' => collect(),
                'vendors' => collect(),
            ]);
        }

        // Get selected currency and exchange rates from session
        $selectedCurrency = session('currency')['code'] ?? 'ZMW';
        $exchangeRates = session('currency')['rates'] ?? [];

        // Debug information
        Log::info('Search Parameters:', [
            'origin' => $originPoint->id,
            'destination' => $destinationPoint->id,
            'travel_date' => $request->travel_date
        ]);

        // Debug: Disable cache for now
        $searchResults = (function () use ($originPoint, $destinationPoint, $request, $selectedCurrency, $exchangeRates, $travelType) {
            // First, get all matching fares for this route
            $matchingFares = BusFare::with(['pickupPoint', 'dropoffPoint'])
                ->select('id', 'route_id', 'agency_id', 'pickup', 'dropoff', 'amount', 'currency', 'departure_time', 'arrival_time')
                ->where('pickup', $originPoint->id)
                ->where('dropoff', $destinationPoint->id)
                ->get();

            Log::info('BusFare Query Results:', [
                'origin_point_id' => $originPoint->id,
                'destination_point_id' => $destinationPoint->id,
                'matching_fares_count' => $matchingFares->count(),
                'fares' => $matchingFares->toArray()
            ]);

            if ($matchingFares->isEmpty()) {
                return [
                    'schedules' => collect(),
                    'returnSchedules' => collect(),
                    'filters' => $this->getDefaultFilters(),
                    'originLat' => $request->origin_lat,
                    'originLng' => $request->origin_lng,
                    'destinationLat' => $request->destination_lat,
                    'destinationLng' => $request->destination_lng,
                    'travel_type' => $travelType,
                    'recommended_price' => null,
                    'recommended_duration' => null,
                    'cheapest_price' => null,
                    'fastest_duration' => null,
                    'min_price' => null,
                    'max_price' => null,
                    'bus_types' => collect(),
                    'departure_times' => collect(),
                    'amenities' => collect(),
                    'seat_types' => collect(),
                    'vendors' => collect(),
                ];
            }

            // Get schedules for the matching routes
            Log::info('Matching Fares Found:', [
                'count' => $matchingFares->count(),
                'route_ids' => $matchingFares->pluck('route_id')->toArray(),
                'agency_ids' => $matchingFares->pluck('agency_id')->toArray()
            ]);

            $schedules = BusSchedules::with([
                'bus.agency:id,agency_name,agency_logo',
                'bus.layout:id,name,layout_type,total_seats',
                'route:id,origin,destination'
            ])
            ->select('id', 'route_id', 'bus_id', 'departure_date', 'departure_time', 'arrival_time', 'status')
            ->whereIn('route_id', $matchingFares->pluck('route_id'))
            ->where('departure_date', $request->travel_date) // Changed back to exact match
            ->where('status', 'scheduled')
            ->get();

            Log::info('Schedules Found:', [
                'count' => $schedules->count(),
                'travel_date_requested' => $request->travel_date,
                'schedules' => $schedules->map(fn($s) => [
                    'id' => $s->id,
                    'route_id' => $s->route_id,
                    'departure_date' => $s->departure_date,
                    'status' => $s->status
                ])->toArray()
            ]);

            $schedules = $schedules->map(function ($schedule) use ($matchingFares, $originPoint, $destinationPoint, $selectedCurrency, $exchangeRates) {
                // Check if bus exists
                if (!$schedule->bus) {
                    Log::warning('Schedule has no bus:', ['schedule_id' => $schedule->id]);
                    return null;
                }

                // Check if agency exists
                if (!$schedule->bus->agency) {
                    Log::warning('Bus has no agency:', ['bus_id' => $schedule->bus_id]);
                    return null;
                }

                // Find the matching fare for this schedule's route and agency
                $fare = $matchingFares->first(function ($f) use ($schedule) {
                    return $f->route_id == $schedule->route_id && $f->agency_id == $schedule->bus->agency_id;
                });

                if (!$fare) {
                    Log::warning('No matching fare found:', [
                        'schedule_id' => $schedule->id,
                        'route_id' => $schedule->route_id,
                        'agency_id' => $schedule->bus->agency_id
                    ]);
                    return null;
                }

                $departureTime = Carbon::parse($fare->departure_time);
                $arrivalTime = Carbon::parse($fare->arrival_time);

                // Calculate seats left
                $totalSeats = $schedule->bus->layout->total_seats ?? 0;
                $bookedSeats = BusPassengers::where('schedule_id', $schedule->id)->count();
                $seatsLeft = max($totalSeats - $bookedSeats, 0);

                // Get average rating for this bus
                $ratings = Rating::whereHas('booking', function($query) use ($schedule) {
                    $query->where('bus_schedule_id', $schedule->id);
                })->get();
                
                $averageRating = $ratings->avg('rating') ?? 0;

                return [
                    'id' => $schedule->id,
                    'departure_time' => $schedule->departure_time,
                    'arrival_time' => $schedule->arrival_time,
                    'duration' => $arrivalTime->diff($departureTime)->format('%H:%I'),
                    'fare' => (float) $fare->amount,
                    'currency' => $fare->currency,
                    'pickup' => $originPoint->name,
                    'dropoff' => $destinationPoint->name,
                    'bus_type' => $schedule->bus->bus_type ?? 'Unknown',
                    'amenities' => $this->parseAmenities($schedule->bus->facilities ?? []),
                    'bus' => $schedule->bus ? $schedule->bus->toArray() : [],
                    'route' => $schedule->route,
                    'convertedFare' => $this->convertCurrency(
                        $fare->amount,
                        $fare->currency,
                        $selectedCurrency,
                        $exchangeRates
                    ),
                    'selectedCurrency' => $selectedCurrency,
                    'seats_left' => $seatsLeft,
                    'rating' => round($averageRating, 1),
                    'status' => $schedule->status
                ];
            })->filter(); // Remove any null entries

            // After mapping and filtering schedules, order by departure_time
            $schedules = $schedules->sortBy('departure_time')->values();

            // Fetch return journey schedules if applicable
            $returnSchedules = collect();
            
            if ($travelType === 'roundtrip' && $request->filled('return_date')) {
                // Get return journey schedules (reverse route)
                $returnMatchingFares = BusFare::with(['pickupPoint', 'dropoffPoint'])
                    ->select('id', 'route_id', 'agency_id', 'pickup', 'dropoff', 'amount', 'currency', 'departure_time', 'arrival_time')
                    ->where('pickup', $destinationPoint->id)
                    ->where('dropoff', $originPoint->id)
                    ->get();

                if (!$returnMatchingFares->isEmpty()) {
                    $returnSchedules = BusSchedules::with([
                        'bus.agency:id,agency_name,agency_logo',
                        'bus.layout:id,name,layout_type,total_seats',
                        'route:id,origin,destination'
                    ])
                    ->select('id', 'route_id', 'bus_id', 'departure_date', 'departure_time', 'arrival_time', 'status')
                    ->whereIn('route_id', $returnMatchingFares->pluck('route_id'))
                    ->where('departure_date', $request->return_date)
                    ->where('status', 'scheduled')
                    ->get();

                    $returnSchedules = $returnSchedules->map(function ($schedule) use ($returnMatchingFares, $destinationPoint, $originPoint, $selectedCurrency, $exchangeRates) {
                        // Find the matching fare for this schedule's route and agency
                        $fare = $returnMatchingFares->first(function ($f) use ($schedule) {
                            return $f->route_id == $schedule->route_id && $f->agency_id == $schedule->bus->agency_id;
                        });

                        if (!$fare) {
                            return null;
                        }

                        $departureTime = Carbon::parse($fare->departure_time);
                        $arrivalTime = Carbon::parse($fare->arrival_time);

                        // Calculate seats left
                        $totalSeats = $schedule->bus->layout->total_seats ?? 0;
                        $bookedSeats = BusPassengers::where('schedule_id', $schedule->id)->count();
                        $seatsLeft = max($totalSeats - $bookedSeats, 0);

                        // Get average rating for this bus
                        $ratings = Rating::whereHas('booking', function($query) use ($schedule) {
                            $query->where('bus_schedule_id', $schedule->id);
                        })->get();
                        
                        $averageRating = $ratings->avg('rating') ?? 0;

                        return [
                            'id' => $schedule->id,
                            'departure_time' => $schedule->departure_time,
                            'arrival_time' => $schedule->arrival_time,
                            'duration' => $arrivalTime->diff($departureTime)->format('%H:%I'),
                            'fare' => (float) $fare->amount,
                            'currency' => $fare->currency,
                            'pickup' => $destinationPoint->name,
                            'dropoff' => $originPoint->name,
                            'bus_type' => $schedule->bus->bus_type ?? 'Unknown',
                            'amenities' => $this->parseAmenities($schedule->bus->facilities ?? []),
                            'bus' => $schedule->bus ? $schedule->bus->toArray() : [],
                            'route' => $schedule->route,
                            'convertedFare' => $this->convertCurrency(
                                $fare->amount,
                                $fare->currency,
                                $selectedCurrency,
                                $exchangeRates
                            ),
                            'selectedCurrency' => $selectedCurrency,
                            'seats_left' => $seatsLeft,
                            'rating' => round($averageRating, 1),
                            'status' => $schedule->status
                        ];
                    })->filter(); // Remove any null entries

                    // After mapping and filtering schedules, order by departure_time
                    $returnSchedules = $returnSchedules->sortBy('departure_time')->values();
                }
            }

                    // Generate filters
        $filters = $this->generateFilters($schedules);

        return [
            'schedules' => $schedules,
            'returnSchedules' => $returnSchedules,
            'filters' => $filters,
                'originLat' => $request->origin_lat,
                'originLng' => $request->origin_lng,
                'destinationLat' => $request->destination_lat,
                'destinationLng' => $request->destination_lng,
                'travel_type' => $travelType,
                'recommended_price' => $schedules->whereNotNull('fare')->pluck('fare')->filter()->avg(),
                'recommended_duration' => null, // Duration is a string, cannot average
                'cheapest_price' => $schedules->whereNotNull('fare')->pluck('fare')->filter()->min(),
                'fastest_duration' => null, // Duration is a string, cannot min
                'min_price' => $schedules->whereNotNull('fare')->pluck('fare')->filter()->min(),
                'max_price' => $schedules->whereNotNull('fare')->pluck('fare')->filter()->max(),
                'bus_types' => $schedules->pluck('bus_type')->unique(),
                'departure_times' => $schedules->pluck('departure_time')->unique(),
                'amenities' => $schedules->pluck('amenities')->flatten()->unique(),
                'seat_types' => collect(),
                'vendors' => $schedules->pluck('bus.agency.agency_name')->unique(),
            ];
        })();

        return view('bus.search.results', $searchResults);
    }

    private function getDefaultFilters()
    {
        return [
            'price_range' => ['min' => 0, 'max' => 0],
            'bus_types' => [],
            'seat_layouts' => [],
            'departure_times' => [
                'morning' => 0,
                'afternoon' => 0,
                'evening' => 0,
                'night' => 0
            ],
            'amenities' => [],
            'agencies' => []
        ];
    }

    private function generateFilters($schedules)
    {
        // Generate filters based on available schedules
        $prices = collect($schedules)->whereNotNull('fare')->pluck('fare')->filter(function($price) {
            return is_numeric($price);
        });
        $busTypes = collect($schedules)->pluck('bus_type')->unique();
        $amenities = collect($schedules)->pluck('amenities')->flatten()->unique();
        $agencies = collect($schedules)->pluck('bus.agency.agency_name')->unique();

        // Get unique seat layouts from schedules (array version)
        $seatLayouts = collect($schedules)
            ->pluck('bus.layout')
            ->filter(function($layout) {
                return is_array($layout) && isset($layout['id']);
            })
            ->unique('id')
            ->map(function($layout) {
                return [
                    'id' => $layout['id'],
                    'name' => $layout['name'],
                    'layout_type' => $layout['layout_type'],
                    'total_seats' => $layout['total_seats']
                ];
            })
            ->values()
            ->toArray();

        return [
            'price_range' => [
                'min' => $prices->min() ?? 0,
                'max' => $prices->max() ?? 0
            ],
            'bus_types' => $busTypes->toArray(),
            'seat_layouts' => $seatLayouts,
            'departure_times' => [
                'morning' => collect($schedules)->filter(function($s) {
                    $hour = (int) \Carbon\Carbon::parse($s['departure_time'])->format('H');
                    return $hour >= 6 && $hour < 12;
                })->count(),
                'afternoon' => collect($schedules)->filter(function($s) {
                    $hour = (int) \Carbon\Carbon::parse($s['departure_time'])->format('H');
                    return $hour >= 12 && $hour < 18;
                })->count(),
                'evening' => collect($schedules)->filter(function($s) {
                    $hour = (int) \Carbon\Carbon::parse($s['departure_time'])->format('H');
                    return $hour >= 18 && $hour < 22;
                })->count(),
                'night' => collect($schedules)->filter(function($s) {
                    $hour = (int) \Carbon\Carbon::parse($s['departure_time'])->format('H');
                    return $hour >= 22 || $hour < 6;
                })->count()
            ],
            'amenities' => $amenities->toArray(),
            'agencies' => $agencies->toArray()
        ];
    }

    /**
     * Convert currency using exchange rates
     */
    private function convertCurrency($amount, $fromCurrency, $toCurrency, $exchangeRates)
    {
        // Ensure amount is numeric
        if (!is_numeric($amount)) {
            return 0;
        }
        
        $conversionRate = $exchangeRates[$fromCurrency] ?? 1;
        $toSelectedCurrencyRate = $exchangeRates[$toCurrency] ?? 1;
        
        // Ensure rates are numeric
        if (!is_numeric($conversionRate) || !is_numeric($toSelectedCurrencyRate)) {
            return $amount;
        }
        
        return ($amount / $conversionRate) * $toSelectedCurrencyRate;
    }

    /**
     * Parse amenities from various formats to ensure it's always an array
     */
    private function parseAmenities($amenities)
    {
        // If it's already an array, return it
        if (is_array($amenities)) {
            return $amenities;
        }

        // If it's null or empty, return empty array
        if (empty($amenities)) {
            return [];
        }

        // If it's a string, try to decode JSON
        if (is_string($amenities)) {
            $decoded = json_decode($amenities, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
            
            // If JSON decode fails, split by comma and trim
            return array_map('trim', explode(',', $amenities));
        }

        // For any other type, return empty array
        return [];
    }
}
