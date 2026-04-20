<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin - Pak Cik & Mas Aimar
        User::create([
            'name'     => 'Pak Cik',
            'email'    => 'pakcik@toko.com',
            'password' => Hash::make('password158'),
        ]);

        User::create([
            'name'     => 'Mas Aimar',
            'email'    => 'aimar@toko.com',
            'password' => Hash::make('password158'),
        ]);

        // Generate 30 produk pakai factory
        Product::factory(30)->create();
    }
}
