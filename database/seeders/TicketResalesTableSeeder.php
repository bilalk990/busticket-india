<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketResalesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ticket_resales')->insert([
            [
                'booking_id' => 1,
                'user_id' => 1,
                'status' => 'active',
                'price' => 40.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'user_id' => 2,
                'status' => 'active',
                'price' => 35.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 3,
                'user_id' => 1,
                'status' => 'sold',
                'price' => 38.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 