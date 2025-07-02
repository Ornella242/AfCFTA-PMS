<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Phase;
use App\Models\Subphase;

class SubphaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subphases = [
        'tor' => [
            ['name' => 'preparation', 'label' => 'Preparation'],
            ['name' => 'availability_of_funds', 'label' => 'Availability of funds'],
            ['name' => 'validation', 'label' => 'Validation'],
            ['name' => 'sg_approval', 'label' => 'SG Approval'],
            ['name' => 'procurement_request', 'label' => 'Procurement Request'],
        ],
        'procurement' => [
            ['name' => 'tender_doc', 'label' => 'Tender Document'],
            ['name' => 'advert', 'label' => 'Advertisement'],
            ['name' => 'evaluation_negociation', 'label' => 'Evaluation & Negotiation'],
            ['name' => 'award', 'label' => 'Award'],
        ],
        'implementation' => [
            ['name' => 'team_set', 'label' => 'Team Set'],
            ['name' => 'work_plan', 'label' => 'Work Plan'],
            ['name' => 'development', 'label' => 'Development'],
            ['name' => 'control_validation', 'label' => 'Control & Validation'],
            ['name' => 'training', 'label' => 'Training'],
            ['name' => 'in_service', 'label' => 'Service'],
        ],
    ];

    foreach ($subphases as $phaseName => $subs) {
        $phase = Phase::where('name', $phaseName)->first();
        if ($phase) {
            foreach ($subs as $sub) {
                Subphase::updateOrCreate([
                    'phase_id' => $phase->id,
                    'name' => $sub['name']
                ], [
                    'label' => $sub['label']
                ]);
            }
        }
    }
    }
}
