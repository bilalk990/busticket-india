<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

// Manual cache clear route (for Railway deployment)
Route::get('/clear-all-cache', function () {
    try {
        // Clear application cache
        Cache::flush();
        
        // Clear specific caches
        Cache::forget('agencies_with_routes');
        Cache::forget('bus_fares_home');
        Cache::forget('top_routes_home');
        Cache::forget('discount_codes_home');
        Cache::forget('total_routes_count');
        Cache::forget('total_bookings_count');
        Cache::forget('total_buses_count');
        
        // Clear Laravel caches
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        
        return response()->json([
            'success' => true,
            'message' => 'All caches cleared successfully! Deleted companies will no longer appear on homepage.',
            'cleared' => [
                'application_cache' => true,
                'agencies_cache' => true,
                'routes_cache' => true,
                'config_cache' => true,
                'view_cache' => true
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error clearing cache: ' . $e->getMessage()
        ], 500);
    }
});
