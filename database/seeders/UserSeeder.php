<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $empresa1 = Company::where('code', 'empresa1')->first();
        $empresa2 = Company::where('code', 'empresa2')->first();
        $empresa3 = Company::where('code', 'empresa3')->first();

        User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@empresa1.com',
            'password' => Hash::make('123456'),
            'company_id' => $empresa1->id,
        ]);

        User::create([
            'name' => 'Ana Gómez',
            'email' => 'ana@empresa2.com',
            'password' => Hash::make('123456'),
            'company_id' => $empresa2->id,
        ]);

        User::create([
            'name' => 'Carlos Ruiz',
            'email' => 'carlos@empresa3.com',
            'password' => Hash::make('123456'),
            'company_id' => $empresa3->id,
        ]);
    }
}
