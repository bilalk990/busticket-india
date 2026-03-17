<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\BusFare;
use App\Models\BusPoint;
use App\Models\BusSchedules;
use Carbon\Carbon;
use App\Models\BusAgencies;

class BusController extends Controller
{

    public function Buses()
    {
        $title = "Buses, Search and Compare";

        $agencies = BusAgencies::withCount('routes')->get();

        $routesName = BusFare::with('agency')
            ->join('bus_points as p1', 'bus_fares.pickup', '=', 'p1.id')
            ->join('bus_points as p2', 'bus_fares.dropoff', '=', 'p2.id')
            ->select(
                'bus_fares.*',
                'p1.name as pickup_name',
                'p2.name as dropoff_name'
            )
            ->get()
            ->map(function ($fare) {
                // Calculate duration
                $departure = Carbon::parse($fare->departure_time);
                $arrival = Carbon::parse($fare->arrival_time);
                $fare->duration = $departure->diff($arrival)->format('%Hh %Im'); // Format as "Xh Ym"
                return $fare;
            });

            $busRoutes = BusFare::with('agency')
            ->join('bus_points as p1', 'bus_fares.pickup', '=', 'p1.id')
            ->join('bus_points as p2', 'bus_fares.dropoff', '=', 'p2.id')
            ->select(
                'bus_fares.*',
                'p1.name as pickup_name',
                'p2.name as dropoff_name'
            )
            ->get()
            ->map(function ($fare) {
                // Calculate duration
                $departure = Carbon::parse($fare->departure_time);
                $arrival = Carbon::parse($fare->arrival_time);
                $fare->duration = $departure->diff($arrival)->format('%Hh %Im'); // Format as "Xh Ym"
                return $fare;
            });

            $busRoutesTimes = BusFare::with('agency')
            ->join('bus_points as p1', 'bus_fares.pickup', '=', 'p1.id')
            ->join('bus_points as p2', 'bus_fares.dropoff', '=', 'p2.id')
            ->select(
                'bus_fares.*',
                'p1.name as pickup_name',
                'p2.name as dropoff_name'
            )
            ->get()
            ->map(function ($fare) {
                // Calculate duration
                $departure = Carbon::parse($fare->departure_time);
                $arrival = Carbon::parse($fare->arrival_time);
                $fare->duration = $departure->diff($arrival)->format('%Hh %Im'); // Format as "Xh Ym"
                return $fare;
            });

                $busRoutess = BusFare::with('agency')
            ->join('bus_points as p1', 'bus_fares.pickup', '=', 'p1.id')
            ->join('bus_points as p2', 'bus_fares.dropoff', '=', 'p2.id')
            ->select(
                'bus_fares.*',
                'p1.name as pickup_name',
                'p1.image as pickup_image',
                'p2.name as dropoff_name',
                'p2.image as dropoff_image'
            )
            ->get()
            ->map(function ($fare) {
                // Calculate duration
                $departure = Carbon::parse($fare->departure_time);
                $arrival = Carbon::parse($fare->arrival_time);
                $fare->duration = $departure->diff($arrival)->format('%Hh %Im'); // Format as "Xh Ym"
                return $fare;
        });

    // Group routes by their starting city
    $groupedRoutes = $busRoutess->groupBy('pickup_name');

        return view('bus.search.bus',
         compact(
             'title',
         'agencies',
         'routesName',
         'busRoutes',
         'groupedRoutes',
         'busRoutesTimes'
        ));
    }
    // public function Buses()
    // {
    //     $title = "Buses, Search and Compare";

    //     $agencies = BusAgencies::withCount('routes')->get();

    //     $busFares = BusFare::with('agency')
    //         ->join('bus_points as p1', 'bus_fares.pickup', '=', 'p1.id')
    //         ->join('bus_points as p2', 'bus_fares.dropoff', '=', 'p2.id')
    //         ->select(
    //             'bus_fares.*',
    //             'p1.name as pickup_name',
    //             'p2.name as dropoff_name'
    //         )
    //         ->get()
    //         ->map(function ($fare) {
    //             // Calculate duration
    //             $departure = Carbon::parse($fare->departure_time);
    //             $arrival = Carbon::parse($fare->arrival_time);
    //             $fare->duration = $departure->diff($arrival)->format('%Hh %Im'); // Format as "Xh Ym"
    //             return $fare;
    //         });

    //     return view('bus.search.bus', compact('title', 'agencies', 'busFares'));
    // }





    public function showBuses(Request $request, $pickup, $dropoff)
    {
        // Retrieve pickup and dropoff bus points
        $pickupPoint = BusPoint::where('name', 'LIKE', "%$pickup%")->first();
        $dropoffPoint = BusPoint::where('name', 'LIKE', "%$dropoff%")->first();

        if (!$pickupPoint || !$dropoffPoint) {
            return redirect()->back()->with('error', 'Invalid pickup or dropoff location.');
        }

        // Calculate distance (using your custom function)
        $originLat = $pickupPoint->latitude;
        $originLng = $pickupPoint->longitude;
        $destinationLat = $dropoffPoint->latitude;
        $destinationLng = $dropoffPoint->longitude;
        $distance = $this->haversineGreatCircleDistance($originLat, $originLng, $destinationLat, $destinationLng);

        $title = ucfirst($pickup) . " to " . ucfirst($dropoff) . " Buses";

        // Use selected date from query parameter or default to tomorrow
        $travel_date = $request->query('date')
            ? Carbon::parse($request->query('date'))->format('Y-m-d')
            : Carbon::tomorrow()->format('Y-m-d');

        $matchingFares = BusFare::where('pickup', $pickupPoint->id)
            ->where('dropoff', $dropoffPoint->id)
            ->get();

        $schedules = BusSchedules::with(['bus.agency', 'route'])
            ->whereIn('route_id', $matchingFares->pluck('route_id'))
            ->where('departure_date', $travel_date)
            ->get()
            ->filter(fn($schedule) => $matchingFares->contains('route_id', $schedule->route_id))
            ->map(function ($schedule) use ($matchingFares, $pickupPoint, $dropoffPoint) {

                $fare = $matchingFares->firstWhere('route_id', $schedule->route_id);
                $schedule->fare = $fare ? $fare->amount : null;
                $schedule->currency = $fare ? $fare->currency : null;
                $schedule->pickup = $pickupPoint->name;
                $schedule->dropoff = $dropoffPoint->name;
                $schedule->bus_type = $schedule->bus->type ?? 'Unknown';
                $schedule->amenities = $this->parseAmenities($schedule->bus->facilities ?? []);

                $departureTime = Carbon::parse($fare->departure_time);
                $arrivalTime = Carbon::parse($fare->arrival_time);
                $schedule->duration = $arrivalTime->diffInMinutes($departureTime);

                return $schedule;
            });

        // Get popular routes for the view
        $popularRoutes = BusFare::with('agency')
            ->join('bus_points as p1', 'bus_fares.pickup', '=', 'p1.id')
            ->join('bus_points as p2', 'bus_fares.dropoff', '=', 'p2.id')
            ->select(
                'bus_fares.*',
                'p1.name as origin',
                'p2.name as destination'
            )
            ->limit(6)
            ->get()
            ->map(function ($fare) {
                // Calculate duration
                $departure = Carbon::parse($fare->departure_time);
                $arrival = Carbon::parse($fare->arrival_time);
                $fare->duration = $departure->diff($arrival)->format('%Hh %Im');
                return $fare;
            });

        // If the request is AJAX, return only the partial schedules view.
        if ($request->ajax()) {
            return view('bus.partials.schedules', compact('schedules'))->render();
        }
        $fastestDuration = $schedules->pluck('duration')->filter()->min();
        $slowestDuration = $schedules->pluck('duration')->filter()->max();
        $averageDuration = $schedules->pluck('duration')->filter()->avg();
        return view('bus.buses', [
            'schedules'         => $schedules,
            'lowestFare'        => $schedules->whereNotNull('fare')->sortBy('fare')->first()->fare ?? null,
            'lowestFareCurrency'=> $schedules->whereNotNull('fare')->sortBy('fare')->first()->currency ?? null,
            'pickupPoint'       => $pickupPoint,
            'dropoffPoint'      => $dropoffPoint,
            'duration'          => $schedules->pluck('duration')->filter(),
            'title'             => $title,
            'distance'          => round($distance, 2) . ' km',
            'fastestJourney' => $fastestDuration !== null ? abs(intval($fastestDuration / 60)) . 'h' . ($fastestDuration % 60 > 0 ? ' ' . ($fastestDuration % 60) . 'm' : '') : null,
            'slowestJourney' => $slowestDuration !== null ? abs(intval($slowestDuration / 60)) . 'h' . ($slowestDuration % 60 > 0 ? ' ' . ($slowestDuration % 60) . 'm' : '') : null, 'averageJourney' => $averageDuration !== null ? abs(intval($averageDuration / 60)) . 'h' .($averageDuration % 60 > 0 ? ' ' . ($averageDuration % 60) . 'm' : '') : null,
            'firstBusDeparture' => $schedules->sortBy('departure_time')->first() ? Carbon::parse($schedules->sortBy('departure_time')->first()->departure_time)->format('H:i') : null,
            'lastBusDeparture'  => $schedules->sortByDesc('departure_time')->first() ? Carbon::parse($schedules->sortByDesc('departure_time')->first()->departure_time)->format('H:i') : null,
            'busCount'          => $schedules->count(),
            'cheapestTicketPrice'=> $schedules->whereNotNull('fare')->sortBy('fare')->first()->fare ?? null,
            'busProviders'      => $schedules->pluck('bus.agency.name')->unique()->values(),
            'fastestBus'        => $schedules->where('duration', $schedules->pluck('duration')->filter()->min())->first(),
            'slowestBus'        => $schedules->where('duration', $schedules->pluck('duration')->filter()->max())->first(),
            'travelDate'        => $travel_date,
            'pickup'            => $pickup,
            'dropoff'           => $dropoff,
            'popularRoutes'     => $popularRoutes,
        ]);
    }


    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo   = deg2rad($latitudeTo);
        $lonTo   = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
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



    // public function showBuses($pickup, $dropoff)
    // {
    //     $pickupPoint = BusPoint::where('name', 'LIKE', "%$pickup%")->first();
    //     $dropoffPoint = BusPoint::where('name', 'LIKE', "%$dropoff%")->first();

    //     if (!$pickupPoint || !$dropoffPoint) {
    //         return redirect()->back()->with('error', 'Invalid pickup or dropoff location.');
    //     }

    //     $originLat = $pickupPoint->latitude;
    //     $originLng = $pickupPoint->longitude;
    //     $destinationLat = $dropoffPoint->latitude;
    //     $destinationLng = $dropoffPoint->longitude;

    //     $distance = $this->haversineGreatCircleDistance($originLat, $originLng, $destinationLat, $destinationLng);

    //     $title = ucfirst($pickup) . " to " . ucfirst($dropoff) . " Buses";

    //     $travel_date = Carbon::tomorrow()->format('Y-m-d');

    //     $matchingFares = BusFare::where('pickup', $pickupPoint->id)
    //         ->where('dropoff', $dropoffPoint->id)
    //         ->get();

    //     $schedules = BusSchedules::with(['bus.agency', 'route'])
    //         ->whereIn('route_id', $matchingFares->pluck('route_id'))
    //         ->where('departure_date', $travel_date)
    //         ->get()
    //         ->filter(fn($schedule) => $matchingFares->contains('route_id', $schedule->route_id))
    //         ->map(function ($schedule) use ($matchingFares, $pickupPoint, $dropoffPoint) {
    //             $departureTime = Carbon::parse($schedule->departure_time);
    //             $arrivalTime = Carbon::parse($schedule->arrival_time);
    //             $schedule->duration = $arrivalTime->diffInMinutes($departureTime);

    //             $fare = $matchingFares->firstWhere('route_id', $schedule->route_id);
    //             $schedule->fare = $fare ? $fare->amount : null;
    //             $schedule->currency = $fare ? $fare->currency : null;
    //             $schedule->pickup = $pickupPoint->name;
    //             $schedule->dropoff = $dropoffPoint->name;
    //             $schedule->bus_type = $schedule->bus->type ?? 'Unknown';
    //             $schedule->amenities = $schedule->bus->amenities ?? [];

    //             return $schedule;
    //         });

    //     $busCount = $schedules->count();
    //     $durations = $schedules->pluck('duration')->filter();
    //     $cheapestFare = $schedules->whereNotNull('fare')->sortBy('fare')->first();
    //     $busProviders = $schedules->pluck('bus.agency.name')->unique()->values();
    //     $firstBus = $schedules->sortBy('departure_time')->first();
    //     $lastBus = $schedules->sortByDesc('departure_time')->first();
    //     $fastestJourney = $durations->min();
    //     $slowestJourney = $durations->max();
    //     $averageJourney = $durations->avg();
    //     $fastestBus = $schedules->where('duration', $fastestJourney)->first();
    //     $slowestBus = $schedules->where('duration', $slowestJourney)->first();

    //     return view('bus.buses', [
    //         'schedules' => $schedules,
    //         'lowestFare' => $cheapestFare ? $cheapestFare->fare : null,
    //         'lowestFareCurrency' => $cheapestFare ? $cheapestFare->currency : null,
    //         'pickupPoint' => $pickupPoint,
    //         'dropoffPoint' => $dropoffPoint,
    //         'duration' => $durations,
    //         'title' => $title,
    //         'distance' => round($distance, 2) . ' km', // Display distance in km
    //         'fastestJourney' => $fastestJourney ? gmdate("H\h i\m", $fastestJourney * 60) : null,
    //         'slowestJourney' => $slowestJourney ? gmdate("H\h i\m", $slowestJourney * 60) : null,
    //         'averageJourney' => $averageJourney ? gmdate("H\h i\m", $averageJourney * 60) : null,
    //         'firstBusDeparture' => $firstBus ? Carbon::parse($firstBus->departure_time)->format('H:i') : null,
    //         'lastBusDeparture' => $lastBus ? Carbon::parse($lastBus->departure_time)->format('H:i') : null,
    //         'busCount' => $busCount,
    //         'cheapestTicketPrice' => $cheapestFare ? $cheapestFare->fare : null,
    //         'busProviders' => $busProviders,
    //         'fastestBus' => $fastestBus,
    //         'slowestBus' => $slowestBus,
    //         'travelDate' => $travel_date,
    //     ]);
    // }



    // private function haversineGreatCircleDistance($lat1, $lng1, $lat2, $lng2, $earthRadius = 6371)
    // {

    //     $lat1 = deg2rad($lat1);
    //     $lng1 = deg2rad($lng1);
    //     $lat2 = deg2rad($lat2);
    //     $lng2 = deg2rad($lng2);


    //     $latDiff = $lat2 - $lat1;
    //     $lngDiff = $lng2 - $lng1;

    //     $a = sin($latDiff / 2) * sin($latDiff / 2) +
    //          cos($lat1) * cos($lat2) *
    //          sin($lngDiff / 2) * sin($lngDiff / 2);

    //     $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    //     return $earthRadius * $c;
    // }


}
