<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Leopold-Auguste',
            'lastname' => 'NGOMO',
            'email' => 'ngomo.auguste@au-afcfta.org',
            'password' => Hash::make('Admin@123'), 
            'unit_id' => 1, 
            'role_id' => 1 
        ]);
        User::create([
            'firstname' => 'Nissem',
            'lastname' => 'BEZZAOUIA',
            'email' => 'nissem.bezzaouia@au-afcfta.org',
            'password' => Hash::make('Admin@123'), 
            'unit_id' => 1, 
            'role_id' => 1 
        ]);
    }
}
