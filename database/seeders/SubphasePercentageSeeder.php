<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subphase;

class SubphasePercentageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $percentages = [
            'preparation' => 20,
            'availability_of_funds' => 20,
            'validation' => 20,
            'sg_approval' => 20,
            'procurement_request' => 20,
            'tender_doc' => 10,
            'advert' => 30,
            'evaluation_negociation' => 40,
            'award' => 10,
            'team_set' => 10,
            'work_plan' => 20,
            'development' => 30,   
            'control_validation' => 20,
            'training' => 10,
            'in_service' => 10,
        ];

        foreach ($percentages as $name => $percentage) {
            Subphase::where('name', $name)->update(['default_percentage' => $percentage]);
        }

        $this->command->info('Subphase default percentages have been updated.');
    }
}

