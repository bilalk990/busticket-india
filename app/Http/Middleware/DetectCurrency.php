<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;

class DetectCurrency
{
    protected $locationApi = 'http://ip-api.com/json/';
    protected $exchangeRateApi = 'https://v6.exchangerate-api.com/v6/a7f8f3c03f22a772849cc4e2/latest/';

    public function handle($request, Closure $next)
    {
        // Check if user has manually selected a currency (cookie exists)
        if ($request->hasCookie('user_selected_currency') && !session()->has('currency')) {
            $userSelectedCurrency = $request->cookie('user_selected_currency');
            
            // Get the most common currency from existing bookings as base currency
            $baseCurrency = \App\Models\BusBooking::selectRaw('currency, COUNT(*) as count')
                ->whereNotNull('currency')
                ->groupBy('currency')
                ->orderBy('count', 'desc')
                ->value('currency') ?? 'ZMW';
                
            $rateResponse = Http::timeout(5)->get($this->exchangeRateApi . $baseCurrency);
            
            if ($rateResponse->ok()) {
                $rates = $rateResponse->json()['conversion_rates'];
                
                session([
                    'currency' => [
                        'code' => $userSelectedCurrency,
                        'rates' => $rates
                    ]
                ]);
            }
        }
        // Only auto-detect currency if session doesn't exist AND user hasn't manually selected one
        elseif (!session()->has('currency') && !$request->hasCookie('user_selected_currency')) {
            try {
                $locationResponse = Http::timeout(5)->get($this->locationApi);
                $locationData = $locationResponse->json();

                if (isset($locationData['countryCode'])) {
                    $currencyCode = $this->mapCountryToCurrency($locationData['countryCode']);

                    // Get the most common currency from existing bookings as base currency
                    $baseCurrency = \App\Models\BusBooking::selectRaw('currency, COUNT(*) as count')
                        ->whereNotNull('currency')
                        ->groupBy('currency')
                        ->orderBy('count', 'desc')
                        ->value('currency') ?? 'ZMW';
                        
                    $rateResponse = Http::timeout(5)->get($this->exchangeRateApi . $baseCurrency);

                    if ($rateResponse->ok()) {
                        $rates = $rateResponse->json()['conversion_rates'];

                        session([
                            'currency' => [
                                'code' => $currencyCode,
                                'rates' => $rates
                            ]
                        ]);
                    } else {
                        // Fallback to default currency if exchange rate API fails
                        session([
                            'currency' => [
                                'code' => 'USD',
                                'rates' => ['USD' => 1]
                            ]
                        ]);
                    }
                } else {
                    // Fallback to default currency if location detection fails
                    session([
                        'currency' => [
                            'code' => 'USD',
                            'rates' => ['USD' => 1]
                        ]
                    ]);
                }
            } catch (\Exception $e) {
                // Log the error for debugging but don't break the application
                \Log::warning('Failed to detect currency: ' . $e->getMessage());
                
                // Set default currency when network is unavailable
                session([
                    'currency' => [
                        'code' => 'USD',
                        'rates' => ['USD' => 1]
                    ]
                ]);
            }
        }

        return $next($request);
    }
private function mapCountryToCurrency($countryCode)
{
 $map = [
    'US' => 'USD',
    'ZM' => 'ZMW',
    'GB' => 'GBP',
    'EU' => 'EUR',
    'KE' => 'KES',
    'NG' => 'NGN',
    'GH' => 'GHS',
    'UG' => 'UGX',
    'RW' => 'RWF',
    'TZ' => 'TZS',
    'MW' => 'MWK',
    'CH' => 'CHF',
    'PL' => 'PLN',
    'CZ' => 'CZK',
    'SE' => 'SEK',
    'CN' => 'CNY',
    'AU' => 'AUD',
    'CA' => 'CAD',
    'MX' => 'MXN',
    'DK' => 'DKK',
    'IN' => 'INR',
    'NO' => 'NOK',
    'BR' => 'BRL',
    'JP' => 'JPY',
    'RO' => 'RON',
    'KR' => 'KRW',
    'CO' => 'COP',
    'UA' => 'UAH',
    'HU' => 'HUF',
    'CL' => 'CLP',
    'BG' => 'BGN',
    'HR' => 'HRK',
    'CM' => 'XAF', // Cameroon
    'CF' => 'XAF', // Central African Republic
    'TD' => 'XAF', // Chad
    'CG' => 'XAF', // Republic of the Congo
    'GQ' => 'XAF', // Equatorial Guinea
    'GA' => 'XAF', // Gabon
];

    return $map[$countryCode] ?? 'USD';
}
}
