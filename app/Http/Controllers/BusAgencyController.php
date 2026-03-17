<?php

namespace App\Http\Controllers;

use App\Models\BusAgencies;
use App\Models\BusFare;

class BusAgencyController extends Controller
{
    public function index()
    {
        $agencies = BusAgencies::withCount('routes')->get();

        return view('bus_agencies.index', compact('agencies'));
    }

    public function show($id)
    {
        $agency = BusAgencies::with(['routes', 'routes.fares', 'buses'])->findOrFail($id);

        $fares = BusFare::where('agency_id', $id)
            ->with(['route', 'pickupPoint', 'dropoffPoint'])
            ->get();

        $title = ucfirst($agency->agency_name);

        return view('agency.show', compact('agency', 'fares', 'title'));
    }

    public function partners()
    {
        $title = 'Become our Partner, Boost Your Ticket Sales with FastBuss';

        return view('partners_portal.index', compact('title'));
    }
}
