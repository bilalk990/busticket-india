<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\BusBooking;

class CurrencyController extends Controller
{
    protected $apiUrl = 'https://v6.exchangerate-api.com/v6/a7f8f3c03f22a772849cc4e2/latest/ZMW'; // Replace YOUR_API_KEY

    public function setCurrency(Request $request)
    {
        $currencyCode = $request->currency;

        // Get the most common currency from existing bookings as base currency
        $baseCurrency = BusBooking::selectRaw('currency, COUNT(*) as count')
            ->whereNotNull('currency')
            ->groupBy('currency')
            ->orderBy('count', 'desc')
            ->value('currency') ?? 'ZMW';
            
        $rateResponse = Http::get('https://v6.exchangerate-api.com/v6/a7f8f3c03f22a772849cc4e2/latest/' . $baseCurrency);

        if ($rateResponse->ok()) {
            $rates = $rateResponse->json()['conversion_rates'];

            // Validate selected currency exists in rates
            if (!isset($rates[$currencyCode])) {
                return response()->json(['message' => 'Invalid currency'], 400);
            }

            // Update session
            session([
                'currency' => [
                    'code' => $currencyCode,
                    'rates' => $rates
                ]
            ]);

            // Set a cookie to remember user's currency preference
            $response = response()->json(['message' => 'Currency updated successfully!']);
            $response->cookie('user_selected_currency', $currencyCode, 60 * 24 * 365); // 1 year

            return $response;
        }

        return response()->json(['message' => 'Failed to fetch exchange rates'], 500);
    }

}
