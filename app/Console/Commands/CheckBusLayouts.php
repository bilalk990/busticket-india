<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckBusLayouts extends Command
{
    protected $signature = 'bus:check-layouts';
    protected $description = 'Check the current state of bus layouts in the database';

    public function handle()
    {
        $this->info('Checking bus layouts in the database...');
        
        // Check seat layouts table
        $seatLayouts = DB::table('bus_seat_layouts')->get();
        $this->info("Found {$seatLayouts->count()} seat layouts:");
        foreach ($seatLayouts as $layout) {
            $this->line("  - ID: {$layout->id}, Name: {$layout->name}, Type: {$layout->layout_type}, Seats: {$layout->total_seats}");
        }
        
        // Check buses table
        $buses = DB::table('buses')->get();
        $this->info("\nFound {$buses->count()} buses:");
        
        $busesWithLayout = $buses->whereNotNull('layout_id');
        $busesWithoutLayout = $buses->whereNull('layout_id');
        
        $this->info("  - Buses with layout_id: {$busesWithLayout->count()}");
        $this->info("  - Buses without layout_id: {$busesWithoutLayout->count()}");
        
        if ($busesWithoutLayout->count() > 0) {
            $this->warn("\nBuses without layout_id:");
            foreach ($busesWithoutLayout as $bus) {
                $this->line("  - ID: {$bus->id}, Name: {$bus->name}, Agency: {$bus->agency_id}");
            }
        }
        
        // Check bus schedules
        $schedules = DB::table('bus_schedules')->get();
        $this->info("\nFound {$schedules->count()} bus schedules");
        
        // Check if schedules have buses with layouts
        $schedulesWithLayout = 0;
        foreach ($schedules as $schedule) {
            $bus = $buses->where('id', $schedule->bus_id)->first();
            if ($bus && $bus->layout_id) {
                $schedulesWithLayout++;
            }
        }
        
        $this->info("  - Schedules with buses that have layouts: {$schedulesWithLayout}");
        $this->info("  - Schedules with buses that don't have layouts: " . ($schedules->count() - $schedulesWithLayout));
        
        return 0;
    }
} 