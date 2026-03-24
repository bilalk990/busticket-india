<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BusSchedules;

$trip = BusSchedules::find(43);
if ($trip) {
    $trip->update(['departure_date' => '2026-03-24']);
    echo "SUCCESS: Trip 43 updated to 2026-03-24\n";
} else {
    echo "ERROR: Trip 43 not found\n";
}
