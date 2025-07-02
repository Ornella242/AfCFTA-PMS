<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Phase;
use App\Models\Subphase;

class PartnerProcurementSubphaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $procurementPhase = Phase::where('name', 'procurement')->first();

        if ($procurementPhase) {
            Subphase::updateOrCreate(
                ['name' => 'partner_procurement'],
                [
                    'label' => 'Partner Procurement',
                    'phase_id' => $procurementPhase->id,
                    'type' => 'partner',
                    'default_percentage' => 100,
                ]
            );
        }
    }
}
