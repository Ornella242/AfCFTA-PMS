<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Phase;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $phases = [
            ['name' => 'tor', 'label' => 'Terms of References'],
            ['name' => 'procurement', 'label' => 'Procurement'],
            ['name' => 'implementation', 'label' => 'Implementation'],
        ];

        foreach ($phases as $phase) {
            Phase::updateOrCreate(['name' => $phase['name']], $phase);
        }

    }
}
