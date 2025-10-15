<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create(['name' => 'HR']);
        Unit::create(['name' => 'IT']);
        Unit::create(['name' => 'Medical']);
        Unit::create(['name' => 'Stores']);
        Unit::create(['name' => 'Procurement & Travel']);
        Unit::create(['name' => 'Facilities & Transport']);
        Unit::create(['name' => 'Office of the Director']);
        Unit::create(['name' => 'Office of the HoD']);
    }
}
