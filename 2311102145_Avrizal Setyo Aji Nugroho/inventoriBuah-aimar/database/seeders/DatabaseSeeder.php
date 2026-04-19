<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; 

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin (Tetap sama)
        User::factory()->create([
            'name' => 'Mas Aimar',
            'email' => 'aimar@toko.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Wajib ada Apel Hijau buat Mas Jakobi
        Product::create([
            'nama_produk' => 'Apel Hijau',
            'stok' => 50,
            'harga' => 15000,
        ]);

        // 3. Tambahin 9 buah random lainnya dari Factory
        Product::factory(9)->create();
    }
}
