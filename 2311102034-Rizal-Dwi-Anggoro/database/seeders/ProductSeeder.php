<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * ProductSeeder
 *
 * Mengisi database dengan data produk dummy yang realistis
 * menggunakan ProductFactory yang sudah kita buat.
 *
 * Breakdown data yang dibuat:
 * - 5 produk stok menipis (0-9) → mewakili kondisi darurat
 * - 3 produk habis           → perlu restock segera
 * - 22 produk normal         → stok acak 10-100
 * Total: 30 produk
 */
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama terlebih dahulu agar tidak duplikasi
        Product::truncate();

        // Buat beberapa produk dengan stok menipis (stok 1-9)
        // Agar fitur indikator stok menipis bisa terlihat
        Product::factory()->count(5)->lowStock()->create();

        // Buat beberapa produk yang habis
        Product::factory()->count(3)->outOfStock()->create();

        // Buat produk normal dengan stok acak
        Product::factory()->count(22)->create();

        $this->command->info('✅ Product seeder berhasil dijalankan!');
        $this->command->info('   Total produk: ' . Product::count());
        $this->command->info('   Stok menipis: ' . Product::where('stock', '<', 10)->where('stock', '>', 0)->count());
        $this->command->info('   Stok habis  : ' . Product::where('stock', 0)->count());
    }
}