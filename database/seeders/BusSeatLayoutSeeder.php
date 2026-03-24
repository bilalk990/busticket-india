<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusSeatLayoutSeeder extends Seeder
{
    public function run()
    {
        // Get existing agencies
        $agencies = DB::table('bus_agencies')->pluck('id')->toArray();
        
        if (empty($agencies)) {
            $this->command->info('No agencies found. Please create agencies first.');
            return;
        }

        $sampleLayouts = [
            [
                'agency_id' => $agencies[0],
                'name' => 'Standard 2x2',
                'layout_type' => '2x2',
                'total_seats' => 44,
                'layout_json' => json_encode([
                    'rows' => [
                        ['row' => 1, 'seats' => [1, 2, null, 3, 4]],
                        ['row' => 2, 'seats' => [5, 6, null, 7, 8]],
                        ['row' => 3, 'seats' => [9, 10, null, 11, 12]],
                        ['row' => 4, 'seats' => [13, 14, null, 15, 16]],
                        ['row' => 5, 'seats' => [17, 18, null, 19, 20]],
                        ['row' => 6, 'seats' => [21, 22, null, 23, 24]],
                        ['row' => 7, 'seats' => [25, 26, null, 27, 28]],
                        ['row' => 8, 'seats' => [29, 30, null, 31, 32]],
                        ['row' => 9, 'seats' => [33, 34, null, 35, 36]],
                        ['row' => 10, 'seats' => [37, 38, null, 39, 40]],
                        ['row' => 11, 'seats' => [41, 42, null, 43, 44]],
                    ]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => $agencies[0],
                'name' => 'Luxury 2x1',
                'layout_type' => '2x1',
                'total_seats' => 30,
                'layout_json' => json_encode([
                    'rows' => [
                        ['row' => 1, 'seats' => [1, 2, null, 3]],
                        ['row' => 2, 'seats' => [4, 5, null, 6]],
                        ['row' => 3, 'seats' => [7, 8, null, 9]],
                        ['row' => 4, 'seats' => [10, 11, null, 12]],
                        ['row' => 5, 'seats' => [13, 14, null, 15]],
                        ['row' => 6, 'seats' => [16, 17, null, 18]],
                        ['row' => 7, 'seats' => [19, 20, null, 21]],
                        ['row' => 8, 'seats' => [22, 23, null, 24]],
                        ['row' => 9, 'seats' => [25, 26, null, 27]],
                        ['row' => 10, 'seats' => [28, 29, null, 30]],
                    ]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => $agencies[0],
                'name' => 'Economy 3x2',
                'layout_type' => '3x2',
                'total_seats' => 54,
                'layout_json' => json_encode([
                    'rows' => [
                        ['row' => 1, 'seats' => [1, 2, 3, null, 4, 5, 6]],
                        ['row' => 2, 'seats' => [7, 8, 9, null, 10, 11, 12]],
                        ['row' => 3, 'seats' => [13, 14, 15, null, 16, 17, 18]],
                        ['row' => 4, 'seats' => [19, 20, 21, null, 22, 23, 24]],
                        ['row' => 5, 'seats' => [25, 26, 27, null, 28, 29, 30]],
                        ['row' => 6, 'seats' => [31, 32, 33, null, 34, 35, 36]],
                        ['row' => 7, 'seats' => [37, 38, 39, null, 40, 41, 42]],
                        ['row' => 8, 'seats' => [43, 44, 45, null, 46, 47, 48]],
                        ['row' => 9, 'seats' => [49, 50, 51, null, 52, 53, 54]],
                    ]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Add more layouts for other agencies if they exist
        if (count($agencies) > 1) {
            $sampleLayouts[] = [
                'agency_id' => $agencies[1],
                'name' => 'Premium 2x2',
                'layout_type' => '2x2',
                'total_seats' => 40,
                'layout_json' => json_encode([
                    'rows' => [
                        ['row' => 1, 'seats' => [1, 2, null, 3, 4]],
                        ['row' => 2, 'seats' => [5, 6, null, 7, 8]],
                        ['row' => 3, 'seats' => [9, 10, null, 11, 12]],
                        ['row' => 4, 'seats' => [13, 14, null, 15, 16]],
                        ['row' => 5, 'seats' => [17, 18, null, 19, 20]],
                        ['row' => 6, 'seats' => [21, 22, null, 23, 24]],
                        ['row' => 7, 'seats' => [25, 26, null, 27, 28]],
                        ['row' => 8, 'seats' => [29, 30, null, 31, 32]],
                        ['row' => 9, 'seats' => [33, 34, null, 35, 36]],
                        ['row' => 10, 'seats' => [37, 38, null, 39, 40]],
                    ]
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('bus_seat_layouts')->insert($sampleLayouts);
        
        $this->command->info('Bus seat layouts seeded successfully!');
    }
} 