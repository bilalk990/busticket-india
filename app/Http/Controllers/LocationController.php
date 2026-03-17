<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function searchLocations(Request $request)
    {
        $query = $request->input('query');
        $url = env('DUFFEL_BASE_URL_LOCATIONS') . 'air/airports';

        Log::info('Search query: ' . $query);

        // Correct API request with "q" instead of "term"
        $response = Http::withToken(env('DUFFEL_API_TOKEN'))
            ->withHeaders([
                'Duffel-Version' => env('DUFFEL_API_VERSION'),
                'Accept' => 'application/json',
            ])
            ->get($url, [
                'query' => $query,
                'limit' => 5,
            ]);

        // Log the response for debugging
        if ($response->successful()) {
            $data = $response->json();
            Log::info('Duffel API Response: ' . json_encode($data));

            // Process and return relevant data
            $suggestions = array_map(function ($location) {
                return [
                    'name' => $location['name'] ?? '',
                    'city' => $location['city_name'] ?? '',
                    'code' => $location['iata_code'] ?? '',
                ];

            }, $data['data']);

            return response()->json(['suggestions' => $suggestions], 200);
        } else {
            Log::error('Duffel API Error: ' . $response->body());
            return response()->json(['error' => 'Failed to fetch airports'], $response->status());
        }
    }
}
