<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::create([
            'name' => 'Mas Aimarico',
            'email' => 'aimarico@toko.com',
            'password' => Hash::make('aimarico123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pak Cik',
            'email' => 'pakcik@toko.com',
            'password' => Hash::make('pakcik123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Mas Jakobi',
            'email' => 'jakobi@gmail.com',
            'password' => Hash::make('jakobi123'),
            'role' => 'customer',
        ]);

        Product::factory()->count(30)->create();
    }
}