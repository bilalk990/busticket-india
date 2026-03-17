<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaxiController extends Controller
{
    public function index()
    {
        $title = "Cheap Rideshare Taxi";

        return view('taxi.index', compact('title'));
    }
}
