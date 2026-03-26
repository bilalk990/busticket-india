<?php
// Temporary debug route - remove after use
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$db = config('database.connections.mysql.database');
$host = config('database.connections.mysql.host');
$agencies = DB::table('bus_agencies')->select('id','agency_name')->get();
$fares = DB::table('bus_fares')->count();
$points = DB::table('bus_points')->count();

echo json_encode([
    'db' => $db,
    'host' => $host,
    'agencies' => $agencies,
    'fares_count' => $fares,
    'points_count' => $points,
]);
