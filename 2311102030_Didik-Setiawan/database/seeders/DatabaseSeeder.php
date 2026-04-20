<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User for Mas Jakobi
        User::factory()->create([
            'name' => 'Mas Jakobi',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Fake products
        \App\Models\Product::factory(50)->create();
    }
}
