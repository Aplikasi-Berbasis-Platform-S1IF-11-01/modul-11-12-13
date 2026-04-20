<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 25 produk menggunakan factory (pilihan produk acak dari daftar)
        Product::factory(25)->create();

        // Tambah produk dengan stok rendah untuk demo alert stok menipis
        Product::create([
            'code' => 'BBR-LOW001',
            'name' => 'Bensin Premium',
            'category' => 'Bahan Bakar',
            'unit' => 'Liter',
            'buy_price' => 9500,
            'sell_price' => 10500,
            'stock' => 3,
            'min_stock' => 10,
            'description' => 'Stok sedang menipis, segera lakukan pemesanan.',
        ]);

        Product::create([
            'code' => 'SMB-LOW002',
            'name' => 'Gas LPG 3kg',
            'category' => 'Sembako',
            'unit' => 'Tabung',
            'buy_price' => 18000,
            'sell_price' => 20000,
            'stock' => 2,
            'min_stock' => 5,
            'description' => 'Tabung gas 3kg untuk rumah tangga.',
        ]);
    }
}