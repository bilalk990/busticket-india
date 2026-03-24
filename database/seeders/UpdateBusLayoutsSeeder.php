<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateBusLayoutsSeeder extends Seeder
{
    public function run()
    {
        // Get all buses that don't have a layout_id
        $busesWithoutLayout = DB::table('buses')
            ->whereNull('layout_id')
            ->get();

        if ($busesWithoutLayout->isEmpty()) {
            $this->command->info('All buses already have layout_id values.');
            return;
        }

        // Get available layouts
        $layouts = DB::table('bus_seat_layouts')->get();
        
        if ($layouts->isEmpty()) {
            $this->command->info('No layouts found. Please run BusSeatLayoutSeeder first.');
            return;
        }

        $updatedCount = 0;
        
        foreach ($busesWithoutLayout as $bus) {
            // Find a layout that belongs to the same agency
            $matchingLayout = $layouts->where('agency_id', $bus->agency_id)->first();
            
            // If no matching layout found, use the first available layout
            if (!$matchingLayout) {
                $matchingLayout = $layouts->first();
            }
            
            // Update the bus with the layout_id
            DB::table('buses')
                ->where('id', $bus->id)
                ->update(['layout_id' => $matchingLayout->id]);
                
            $updatedCount++;
        }
        
        $this->command->info("Updated {$updatedCount} buses with layout_id values.");
    }
} 