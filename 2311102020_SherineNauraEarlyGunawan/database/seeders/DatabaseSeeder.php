<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    \App\Models\User::factory()->create([
    'name' => 'Mas Aimar',
    'email' => 'admin@toko.com', 
    'password' => bcrypt('password123'),
]);

    \App\Models\Product::create([
        'name' => 'Pringles Chips',
        'stock' => 5,
        'price' => 25000
    ]); 
    }
}
