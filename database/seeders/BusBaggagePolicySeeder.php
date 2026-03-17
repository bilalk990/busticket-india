<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusBaggagePolicy;
use App\Models\BusAgencies;

class BusBaggagePolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all agencies
        $agencies = BusAgencies::all();

        foreach ($agencies as $agency) {
            BusBaggagePolicy::create([
                'agency_id' => $agency->id,
                'max_bags_per_passenger' => 2,
                'max_weight_per_bag' => 20.00,
                'max_total_weight' => 40.00,
                'free_baggage_allowance' => 1,
                'extra_bag_fee' => 10.00,
                'overweight_fee_per_kg' => 5.00,
                'allowed_bag_types' => json_encode(['suitcase', 'backpack', 'duffel', 'handbag']),
                'restricted_items' => json_encode([
                    'Flammable liquids',
                    'Explosives',
                    'Weapons',
                    'Illegal substances',
                    'Perishable food items'
                ]),
                'policy_description' => 'Each passenger is allowed one free bag up to 20kg. Additional bags and overweight items will incur extra fees. Please ensure all items comply with our restricted items list.',
                'is_active' => true,
            ]);
        }
    }
} 