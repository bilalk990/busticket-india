<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
class TranslationHelper
{
    public static function translate($text, $targetLocale)
    {
        $cacheKey = md5($text . $targetLocale);

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($text, $targetLocale) {
            // Call Google Translate API
            $client = new Client();
            $apiKey = env('AIzaSyDPBs_Z8eAh5pdgl5LJ_OUOzVfy2p-DxH0AIzaSyDPBs_Z8eAh5pdgl5LJ_OUOzVfy2p-DxH0');
            $response = $client->post('https://translation.googleapis.com/language/translate/v2', [
                'query' => [
                    'key' => $apiKey,
                    'q' => $text,
                    'target' => $targetLocale,
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            return $body['data']['translations'][0]['translatedText'] ?? $text;
        });
    }
}

