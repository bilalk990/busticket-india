<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AgencyDocumentType;
use App\Models\BusAgencies;

class AgencyDocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all existing agencies
        $agencies = BusAgencies::all();

        if ($agencies->isEmpty()) {
            $this->command->info('No agencies found. Please create agencies first.');
            return;
        }

        // Sample document types for different agencies
        $documentTypes = [
            [
                'document_name' => 'passport',
                'display_name' => 'Passport',
                'description' => 'Valid passport with at least 6 months validity',
                'is_required' => true,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'document_name' => 'national_id',
                'display_name' => 'National ID Card',
                'description' => 'Government-issued national identification card',
                'is_required' => true,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'document_name' => 'drivers_license',
                'display_name' => 'Driver\'s License',
                'description' => 'Valid driver\'s license as secondary identification',
                'is_required' => false,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'document_name' => 'birth_certificate',
                'display_name' => 'Birth Certificate',
                'description' => 'Original or certified copy of birth certificate',
                'is_required' => false,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'document_name' => 'visa',
                'display_name' => 'Visa',
                'description' => 'Valid visa for international travel (if applicable)',
                'is_required' => false,
                'is_active' => true,
                'sort_order' => 5
            ]
        ];

        // Assign document types to agencies
        foreach ($agencies as $agency) {
            // Assign all document types to each agency for testing
            foreach ($documentTypes as $docType) {
                AgencyDocumentType::create([
                    'agency_id' => $agency->id,
                    'document_name' => $docType['document_name'],
                    'display_name' => $docType['display_name'],
                    'description' => $docType['description'],
                    'is_required' => $docType['is_required'],
                    'is_active' => $docType['is_active'],
                    'sort_order' => $docType['sort_order']
                ]);
            }
        }

        $this->command->info('Agency document types seeded successfully!');
    }
}
