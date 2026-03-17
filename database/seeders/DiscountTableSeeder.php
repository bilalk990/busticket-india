<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountTableSeeder extends Seeder
{
    public function run()
    {
        // Get some existing agencies and routes for realistic data
        $agencies = DB::table('bus_agencies')->pluck('id')->toArray();
        $routes = DB::table('bus_routes')->pluck('id')->toArray();
        
        $sampleData = [
            [
                'code' => 'SAVE20',
                'discount' => '20',
                'type' => 'percentage',
                'discription' => 'Get 20% off on all bus bookings',
                'coupon_type' => 'general',
                'agency_id' => null,
                'route_id' => null,
                'max_users' => 100,
                'expire_at' => now()->addDays(30),
                'statut' => 'active',
                'creer' => now(),
                'modifier' => now(),
            ],
            [
                'code' => 'WELCOME10',
                'discount' => '10',
                'type' => 'percentage',
                'discription' => 'Welcome discount for new customers',
                'coupon_type' => 'welcome',
                'agency_id' => null,
                'route_id' => null,
                'max_users' => 50,
                'expire_at' => now()->addDays(15),
                'statut' => 'active',
                'creer' => now(),
                'modifier' => now(),
            ],
            [
                'code' => 'FLASH25',
                'discount' => '25',
                'type' => 'percentage',
                'discription' => 'Flash sale - 25% off for limited time',
                'coupon_type' => 'flash',
                'agency_id' => null,
                'route_id' => null,
                'max_users' => 25,
                'expire_at' => now()->addDays(7),
                'statut' => 'active',
                'creer' => now(),
                'modifier' => now(),
            ],
            [
                'code' => 'FIXED50',
                'discount' => '50',
                'type' => 'fixed',
                'discription' => 'Fixed $50 discount on bookings over $200',
                'coupon_type' => 'fixed',
                'agency_id' => null,
                'route_id' => null,
                'max_users' => 75,
                'expire_at' => now()->addDays(45),
                'statut' => 'active',
                'creer' => now(),
                'modifier' => now(),
            ],
        ];

        // Add agency-specific discounts if agencies exist
        if (!empty($agencies)) {
            $sampleData[] = [
                'code' => 'AGENCY15',
                'discount' => '15',
                'type' => 'percentage',
                'discription' => 'Special agency discount',
                'coupon_type' => 'agency',
                'agency_id' => $agencies[0],
                'route_id' => null,
                'max_users' => 30,
                'expire_at' => now()->addDays(20),
                'statut' => 'active',
                'creer' => now(),
                'modifier' => now(),
            ];
        }

        // Add route-specific discounts if routes exist
        if (!empty($routes)) {
            $sampleData[] = [
                'code' => 'ROUTE30',
                'discount' => '30',
                'type' => 'percentage',
                'discription' => 'Special route discount',
                'coupon_type' => 'route',
                'agency_id' => null,
                'route_id' => $routes[0],
                'max_users' => 40,
                'expire_at' => now()->addDays(25),
                'statut' => 'active',
                'creer' => now(),
                'modifier' => now(),
            ];
        }

        DB::table('discount')->insert($sampleData);
    }
} 