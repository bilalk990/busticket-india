<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BusSchedules;

echo "--- ALL BUS SCHEDULES ---\n";
$trips = BusSchedules::orderBy('departure_date', 'desc')->limit(20)->get();
foreach ($trips as $t) {
    echo "ID: {$t->id} | Route: {$t->route_id} | Date: {$t->departure_date} | Time: {$t->departure_time} | Status: {$t->status}\n";
}
