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
        try {
            $baseCurrency = BusBooking::selectRaw('currency, COUNT(*) as count')
                ->whereNotNull('currency')
                ->groupBy('currency')
                ->orderBy('count', 'desc')
                ->value('currency') ?? 'ZMW';
                
            $rateResponse = Http::get('https://v6.exchangerate-api.com/v6/a7f8f3c03f22a772849cc4e2/latest/' . $baseCurrency);

            if ($rateResponse->ok()) {
                $rates = $rateResponse->json()['conversion_rates'];
            } else {
                throw new \Exception("API limit reached or failed");
            }
        } catch (\Exception $e) {
            // Fallback rates if API fails (approximate values)
            $rates = [
                'USD' => 1.0,
                'EUR' => 0.92,
                'GBP' => 0.79,
                'PKR' => 278.0,
                'CHF' => 0.90,
                'RSD' => 108.0,
                'ZMW' => 25.0
            ];
            
            // Adjust rates based on base currency if it's not USD
            if ($baseCurrency !== 'USD' && isset($rates[$baseCurrency])) {
                $baseRate = $rates[$baseCurrency];
                foreach ($rates as $code => $val) {
                    $rates[$code] = $val / $baseRate;
                }
            }
        }

        // Validate selected currency exists in rates
        if (!isset($rates[$currencyCode])) {
            // Add it if it's one of our known codes
            $fallbackOptions = ['USD' => 1.0, 'PKR' => 278.0, 'GBP' => 0.79];
            if (isset($fallbackOptions[$currencyCode])) {
                $rates[$currencyCode] = $fallbackOptions[$currencyCode];
            } else {
                return response()->json(['message' => 'Invalid currency'], 400);
            }
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

}
