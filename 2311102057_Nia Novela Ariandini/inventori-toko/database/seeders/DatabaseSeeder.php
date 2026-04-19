<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Bikin 1 User buat login Pak Cik / Mas Aimar
    User::factory()->create([
        'name' => 'Mas Aimar',
        'email' => 'aimar@toko.com',
        'password' => bcrypt('password'), // password buat login nanti
    ]);

    // Bikin 10 Data Produk Otomatis
    \App\Models\Product::factory(10)->create();
}
}
