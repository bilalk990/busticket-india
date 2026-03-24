<?php

/**
 * Cache clearing script for FastBuss
 * Run this after adding new companies or routes to ensure they appear on the website
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

echo "🧹 Clearing FastBuss Cache...\n\n";

// Clear all cache
echo "1. Clearing application cache...\n";
Artisan::call('cache:clear');
echo "   ✅ Application cache cleared\n\n";

// Clear config cache
echo "2. Clearing config cache...\n";
Artisan::call('config:clear');
echo "   ✅ Config cache cleared\n\n";

// Clear route cache
echo "3. Clearing route cache...\n";
Artisan::call('route:clear');
echo "   ✅ Route cache cleared\n\n";

// Clear view cache
echo "4. Clearing view cache...\n";
Artisan::call('view:clear');
echo "   ✅ View cache cleared\n\n";

// Clear specific homepage caches
echo "5. Clearing specific homepage caches...\n";
$cacheKeys = [
    'agencies_with_routes',
    'bus_fares_home',
    'top_routes_home',
    'discount_codes_home',
    'total_routes_count',
    'total_bookings_count',
    'total_buses_count'
];

foreach ($cacheKeys as $key) {
    Cache::forget($key);
    echo "   ✅ Cleared: {$key}\n";
}

echo "\n✨ All caches cleared successfully!\n";
echo "🔄 Refresh your website to see the changes.\n";
