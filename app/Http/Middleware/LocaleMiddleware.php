<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        $locales = array_keys(config('app.locales'));
        $locale = $request->get('locale');


        if ($locale && in_array($locale, $locales)) {
            session(['locale' => $locale]);
        } else {
            $locale = session('locale');
        }


        if (!$locale) {
            // Cache IP-based locale detection for 24 hours (skip if Redis not available)
            try {
                $locale = Cache::remember('user_locale_' . $request->ip(), 86400, function () {
                    try {
                        $response = Http::timeout(3)->get('http://ip-api.com/json');
                        $locationData = $response->json();

                        if ($response->successful() && isset($locationData['countryCode'])) {
                            $countryCode = strtolower($locationData['countryCode']);

                            $localeMap = [
                                'us' => 'en',
                                'gb' => 'en',
                                'ru' => 'ru',
                                'fr' => 'fr',
                                'xk' => 'sq',
                            ];

                            return $localeMap[$countryCode] ?? config('app.locale');
                        } else {
                            return config('app.locale');
                        }
                    } catch (\Exception $e) {
                        \Log::warning('Failed to detect locale from IP API: ' . $e->getMessage());
                        return config('app.locale');
                    }
                });
            } catch (\Exception $e) {
                // If cache fails (Redis not available), just use default locale
                \Log::debug('Cache not available in LocaleMiddleware: ' . $e->getMessage());
                $locale = config('app.locale');
            }
        }


        App::setLocale($locale);

        return $next($request);
    }
}
