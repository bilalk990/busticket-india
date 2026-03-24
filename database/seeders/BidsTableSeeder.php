<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('bids')->insert([
            [
                'user_id' => 1,
                'ticket_resale_id' => 1,
                'amount' => 39.00,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'ticket_resale_id' => 2,
                'amount' => 36.00,
                'status' => 'accepted',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'ticket_resale_id' => 1,
                'amount' => 40.00,
                'status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 