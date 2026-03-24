<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AirportController extends Controller
{

    public function fetchAirports()
    {

        $apiKey = env('AVIATIONSTACK_API_KEY');

        $response = Http::get("http://api.aviationstack.com/v1/airports", [
            'access_key' => $apiKey,
        ]);


        Log::info('AviationStack API response:', ['response' => $response->body()]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Unable to fetch airport data'], 500);
        }
    }



}
