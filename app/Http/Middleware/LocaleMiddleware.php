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
            // Cache IP-based locale detection for 24 hours
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
                            // 'de' => 'de',
                            // 'es' => 'es',
                            // 'sa' => 'ar',
                            // 'za' => 'af',
                            // 'id' => 'id',
                            // 'bd' => 'bn',
                            // 'bg' => 'bg',
                            // 'cn' => 'zh',
                            // 'cz' => 'cs',
                            // 'dk' => 'da',
                            // 'fi' => 'fi',
                            // 'in' => 'hi',
                            // 'hr' => 'hr',
                            // 'hu' => 'hu',
                            // 'it' => 'it',
                            // 'jp' => 'ja',
                            // 'kr' => 'ko',
                            // 'my' => 'ms',
                            // 'nl' => 'nl',
                            // 'no' => 'no',
                            // 'pl' => 'pl',
                            // 'pt' => 'pt-pt',
                            // 'ro' => 'ro',
                            // 'tz' => 'sw',
                            // 'se' => 'sv',
                            // 'tr' => 'tr',
                            // 'vn' => 'vi',
                        ];

                        return $localeMap[$countryCode] ?? config('app.locale');
                    } else {
                        return config('app.locale');
                    }
                } catch (\Exception $e) {
                    // Log the error for debugging but don't break the application
                    \Log::warning('Failed to detect locale from IP API: ' . $e->getMessage());
                    return config('app.locale');
                }
            });
        }


        App::setLocale($locale);

        return $next($request);
    }
}
