<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'code' => 'empresa1',
            'name' => 'Empresa 1',
            'primary_color' => '#1E90FF',
        ]);

        Company::create([
            'code' => 'empresa2',
            'name' => 'Empresa 2',
            'primary_color' => '#28A745',
        ]);

        Company::create([
            'code' => 'empresa3',
            'name' => 'Empresa 3',
            'primary_color' => '#DC3545',
        ]);
    }
}
