<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BusPoint;
use App\Models\BusFare;
use App\Models\BusSchedules;

$lahore = BusPoint::where('name', 'LIKE', '%Lahore%')->first();
$karachi = BusPoint::where('name', 'LIKE', '%Karachi%')->first();

if (!$lahore || !$karachi) {
    die("Error: Could not find Lahore or Karachi in BusPoints\n");
}

echo "Lahore ID: {$lahore->id} | Name: {$lahore->name}\n";
echo "Karachi ID: {$karachi->id} | Name: {$karachi->name}\n";

echo "\n--- FARES matching these points ---\n";
$fares = BusFare::where('pickup', $lahore->id)
                ->where('dropoff', $karachi->id)
                ->get();

if ($fares->isEmpty()) {
    echo "NO FARES FOUND for this pickup/dropoff combo!\n";
} else {
    foreach ($fares as $f) {
        echo "Fare ID: {$f->id} | Route ID: {$f->route_id} | Agency ID: {$f->agency_id} | Amount: {$f->amount}\n";
        
        echo "  --- SCHEDULES for Route {$f->route_id} ---\n";
        $trips = BusSchedules::where('route_id', $f->route_id)->get();
        if ($trips->isEmpty()) {
            echo "  NO TRIPS FOUND for this Route ID!\n";
        } else {
            foreach ($trips as $t) {
                echo "  Trip ID: {$t->id} | Date: {$t->departure_date} | Time: {$t->departure_time} | Status: {$t->status}\n";
            }
        }
    }
}
