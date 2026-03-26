<?php

namespace App\Http\Controllers;

use App\Models\BusAgency;
use App\Models\BusFare;

class BusAgencyController extends Controller
{
    public function index()
    {
        $agencies = BusAgency::withCount('routes')->get();

        return view('bus_agencies.index', compact('agencies'));
    }

    public function show($id, $slug = null)
    {
        $agency = BusAgency::with(['routes', 'routes.fares', 'buses'])->findOrFail($id);

        $fares = BusFare::where('agency_id', $id)
            ->with(['route', 'pickupPoint', 'dropoffPoint'])
            ->get();

        // If no fares but routes exist, build virtual fares from routes
        if ($fares->isEmpty()) {
            $routes = \App\Models\BusRoutes::where('agency_id', $id)->get();
            $fares = $routes->map(function ($route) use ($id) {
                $fare = new BusFare();
                $fare->id = $route->id;
                $fare->agency_id = $id;
                $fare->route_id = $route->id;
                $fare->amount = $route->adult_price ?? 0;
                $fare->currency = 'USD';
                $fare->departure_time = '08:00:00';
                $fare->arrival_time = '16:00:00';
                $fare->setRelation('route', $route);
                return $fare;
            });
        }

        $title = ucfirst($agency->agency_name);

        return view('agency.show', compact('agency', 'fares', 'title'));
    }

    public function partners()
    {
        $title = 'Become our Partner, Boost Your Ticket Sales with FastBuss';

        return view('partners_portal.index', compact('title'));
    }
}
