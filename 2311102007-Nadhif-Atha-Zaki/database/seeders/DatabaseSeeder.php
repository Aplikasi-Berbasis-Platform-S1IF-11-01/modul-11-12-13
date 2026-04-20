<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@toko.com'],
            [
                'name' => 'Admin Toko',
                'password' => bcrypt('password123'),
            ]
        );

        $this->call([
            ProductSeeder::class,
        ]);
    }
}