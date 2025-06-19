<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Partner::create(['name' => 'AfDB']);
         Partner::create(['name' => 'AUC']);
         Partner::create(['name' => 'BIASHARA']); 
         Partner::create(['name' => 'EU-TAF']); 
         Partner::create(['name' => 'MS-1']); 
         Partner::create(['name' => 'MS-2']); 
         Partner::create(['name' => 'MS-3']); 
         Partner::create(['name' => 'MS-4']);
         Partner::create(['name' => 'MS-5']);
    }
}
