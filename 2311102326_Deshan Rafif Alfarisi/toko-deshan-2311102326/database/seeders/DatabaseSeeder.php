<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin Deshan',
            'email' => 'admin@toko.com',
            'password' => bcrypt('password'),
        ]);

        // Create 25 products
        Product::factory()->count(25)->create();
    }
}
