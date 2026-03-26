<?php

namespace App\Http\Controllers;
use App\Models\BusAgency;
use App\Models\Discount;
use App\Models\BusRoute;
use App\Models\BusBooking;
use Illuminate\Http\Request;
use App\Models\BusFare;
use App\Models\BusPoint;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Cache agencies with routes count for 5 minutes (reduced from 1 hour) - only show active agencies
        try {
            $agencies = Cache::remember('agencies_with_routes', 60, function () {
                return BusAgency::where('is_active', true)
                    ->orWhereNull('is_active') // Include agencies where is_active is null (for backward compatibility)
                    ->withCount('routes')
                    ->get()
                    ->map(function ($agency) {
                        $logo = $agency->agency_logo;
                        if ($logo && !str_starts_with($logo, 'http')) {
                            $backendUrl = rtrim(env('BACKEND_URL', 'http://localhost:5000'), '/');
                            $logo = $backendUrl . '/uploads/' . $logo;
                        }
                        return (object)[
                            'id'           => $agency->id,
                            'agency_name'  => $agency->agency_name,
                            'agency_logo'  => $logo,
                            'routes_count' => $agency->routes_count,
                        ];
                    });
            });
        } catch (\Exception $e) {
            \Log::warning('Cache failed for agencies: ' . $e->getMessage());
            $agencies = BusAgency::where('is_active', true)
                ->orWhereNull('is_active')
                ->withCount('routes')
                ->get()
                ->map(function ($agency) {
                    $logo = $agency->agency_logo;
                    if ($logo && !str_starts_with($logo, 'http')) {
                        $backendUrl = rtrim(env('BACKEND_URL', 'http://localhost:5000'), '/');
                        $logo = $backendUrl . '/uploads/' . $logo;
                    }
                    return (object)[
                        'id'           => $agency->id,
                        'agency_name'  => $agency->agency_name,
                        'agency_logo'  => $logo,
                        'routes_count' => $agency->routes_count,
                    ];
                });
        }

        // Cache bus fares for 30 minutes with limited results
        try {
            $busFares = Cache::remember('bus_fares_home', 1800, function () {
                return BusFare::with(['pickupPoint', 'dropoffPoint'])
                    ->select('id', 'pickup', 'dropoff', 'amount', 'currency', 'departure_time', 'arrival_time')
                    ->limit(20)
                    ->get();
            });
        } catch (\Exception $e) {
            \Log::warning('Cache failed for bus fares: ' . $e->getMessage());
            $busFares = BusFare::with(['pickupPoint', 'dropoffPoint'])
                ->select('id', 'pickup', 'dropoff', 'amount', 'currency', 'departure_time', 'arrival_time')
                ->limit(20)
                ->get();
        }

        // Cache top routes - v5
        try {
            $topRoutes = Cache::remember('top_routes_home_v5', 300, function () {
                // Direct join query - bypasses ORM relationship issues
                $rows = \Illuminate\Support\Facades\DB::table('bus_fares as bf')
                    ->join('bus_points as bp1', 'bf.pickup', '=', 'bp1.id')
                    ->join('bus_points as bp2', 'bf.dropoff', '=', 'bp2.id')
                    ->select('bp1.name as pickup_name', 'bp2.name as dropoff_name',
                             'bp1.latitude as pickup_latitude', 'bp1.longitude as pickup_longitude',
                             'bp2.latitude as dropoff_latitude', 'bp2.longitude as dropoff_longitude')
                    ->limit(30)
                    ->get();
                return $rows->map(function ($row) {
                    return (object)[
                        'pickup_name'       => $row->pickup_name,
                        'dropoff_name'      => $row->dropoff_name,
                        'pickup_latitude'   => $row->pickup_latitude,
                        'pickup_longitude'  => $row->pickup_longitude,
                        'dropoff_latitude'  => $row->dropoff_latitude,
                        'dropoff_longitude' => $row->dropoff_longitude,
                    ];
                });
            });
        } catch (\Exception $e) {
            \Log::warning('Cache failed for top routes: ' . $e->getMessage());
            $topRoutes = collect();
        }

        // Group topRoutes by pickup_name for the view
        $groupedRoutes = $topRoutes->groupBy('pickup_name');

        // Cache discount codes for 15 minutes
        try {
            $discountCodes = Cache::remember('discount_codes_home', 900, function () {
                // Get discount codes - first try active ones, then any valid ones for testing
                $codes = Discount::active()
                    ->with(['agency:id,agency_name', 'route:id,origin,destination'])
                    ->select('id', 'code', 'discount', 'type', 'agency_id', 'route_id', 'expire_at')
                    ->orderBy('expire_at', 'asc')
                    ->limit(6)
                    ->get();

                // If no active codes, get any valid codes for testing
                if ($codes->count() == 0) {
                    $codes = Discount::valid()
                        ->with(['agency:id,agency_name', 'route:id,origin,destination'])
                        ->select('id', 'code', 'discount', 'type', 'agency_id', 'route_id', 'expire_at')
                        ->orderBy('expire_at', 'asc')
                        ->limit(6)
                        ->get();
                }

                // If still no codes, get any codes for testing
                if ($codes->count() == 0) {
                    $codes = Discount::with(['agency:id,agency_name', 'route:id,origin,destination'])
                        ->select('id', 'code', 'discount', 'type', 'agency_id', 'route_id', 'expire_at')
                        ->orderBy('expire_at', 'asc')
                        ->limit(6)
                        ->get();
                }

                return $codes;
            });
        } catch (\Exception $e) {
            \Log::warning('Cache failed for discount codes: ' . $e->getMessage());
            $discountCodes = Discount::active()
                ->with(['agency:id,agency_name', 'route:id,origin,destination'])
                ->select('id', 'code', 'discount', 'type', 'agency_id', 'route_id', 'expire_at')
                ->orderBy('expire_at', 'asc')
                ->limit(6)
                ->get();
        }

        // Cache total routes and bookings for 1 hour
        try {
            $totalRoutes = Cache::remember('total_routes_count', 3600, function () {
                return BusRoute::count();
            });
        } catch (\Exception $e) {
            \Log::warning('Cache failed for total routes: ' . $e->getMessage());
            $totalRoutes = BusRoute::count();
        }

        try {
            $totalBookings = Cache::remember('total_bookings_count', 3600, function () {
                return BusBooking::count();
            });
        } catch (\Exception $e) {
            \Log::warning('Cache failed for total bookings: ' . $e->getMessage());
            $totalBookings = BusBooking::count();
        }

        try {
            $totalBuses = Cache::remember('total_buses_count', 3600, function () {
                return \Illuminate\Support\Facades\DB::table('buses')->count();
            });
        } catch (\Exception $e) {
            \Log::warning('Cache failed for total buses: ' . $e->getMessage());
            $totalBuses = \Illuminate\Support\Facades\DB::table('buses')->count();
        }

        return view('home', compact('agencies', 'busFares', 'topRoutes', 'discountCodes', 'groupedRoutes', 'totalRoutes', 'totalBookings', 'totalBuses'));
    }

    public function show($id)
    {
        try {
            $agency = Cache::remember('agency_' . $id, 60, function () use ($id) {
                return BusAgency::with(['routes', 'schedules.route'])
                    ->findOrFail($id);
            });
        } catch (\Exception $e) {
            \Log::warning('Cache failed for agency: ' . $e->getMessage());
            $agency = BusAgency::with(['routes', 'schedules.route'])
                ->findOrFail($id);
        }

        $fares = BusFare::where('agency_id', $id)
            ->with(['route', 'pickupPoint', 'dropoffPoint'])
            ->get();

        $title = ucfirst($agency->agency_name);

        return view('agency.show', compact('agency', 'fares', 'title'));
    }
}
