<?php

namespace App\Http\Controllers;
use App\Models\BusAgencies;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\BusFare;
use App\Models\BusPoint;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Cache agencies with routes count for 1 hour
        $agencies = Cache::remember('agencies_with_routes', 3600, function () {
            return BusAgencies::select('id', 'agency_name', 'agency_logo')
                ->withCount('routes')
                ->get();
        });

        // Cache bus fares for 30 minutes with limited results
        $busFares = Cache::remember('bus_fares_home', 1800, function () {
            return BusFare::with(['pickupPoint', 'dropoffPoint'])
                ->select('id', 'pickup', 'dropoff', 'amount', 'currency', 'departure_time', 'arrival_time')
                ->limit(20)
                ->get();
        });

        // Cache top routes for 30 minutes
        $topRoutes = Cache::remember('top_routes_home', 1800, function () {
            return BusFare::with(['pickupPoint', 'dropoffPoint'])
                ->select('id', 'pickup', 'dropoff', 'amount', 'currency', 'departure_time', 'arrival_time')
                ->limit(30)
                ->get()
                ->map(function ($fare) {
                    return (object)[
                        'pickup_name' => $fare->pickupPoint->name ?? 'Unknown',
                        'dropoff_name' => $fare->dropoffPoint->name ?? 'Unknown',
                        'pickup_latitude' => $fare->pickupPoint->latitude ?? null,
                        'pickup_longitude' => $fare->pickupPoint->longitude ?? null,
                        'dropoff_latitude' => $fare->dropoffPoint->latitude ?? null,
                        'dropoff_longitude' => $fare->dropoffPoint->longitude ?? null,
                    ];
                });
        });

        // Group topRoutes by pickup_name for the view
        $groupedRoutes = $topRoutes->groupBy('pickup_name');

        // Cache discount codes for 15 minutes
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

        // Debug information
        \Log::info('Discount codes found: ' . $discountCodes->count());
        if ($discountCodes->count() > 0) {
            \Log::info('First discount code: ' . $discountCodes->first()->code);
        }

        return view('home', compact('agencies', 'busFares', 'topRoutes', 'discountCodes', 'groupedRoutes'));
    }

    public function show($id)
    {
        $agency = Cache::remember('agency_' . $id, 1800, function () use ($id) {
            return BusAgencies::with(['routes', 'schedules.route', 'bus_fares'])
                ->findOrFail($id);
        });
        return view('bus_agencies.show', compact('agency'));
    }
}
