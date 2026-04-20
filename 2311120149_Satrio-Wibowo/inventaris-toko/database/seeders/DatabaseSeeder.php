<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User admin default
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin Toko',
                'password' => Hash::make('password'),
            ]
        );

        // 10 produk stok kritis, 40 produk normal
        Product::factory()->count(10)->lowStock()->create();
        Product::factory()->count(40)->create();
    }
}