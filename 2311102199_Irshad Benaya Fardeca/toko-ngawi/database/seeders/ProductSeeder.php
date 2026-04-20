<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Produk statis yang pasti ada di toko (biar realistis)
        $fixedProducts = [
            ['name' => 'Beras Pandan Wangi 5kg',   'category' => 'Sembako',    'price' => 70000,  'stock' => 50,  'unit' => 'karung',  'description' => 'Beras pulen kualitas premium, cocok untuk nasi sehari-hari.'],
            ['name' => 'Gula Pasir Gulaku 1kg',     'category' => 'Sembako',    'price' => 14500,  'stock' => 80,  'unit' => 'kg',      'description' => 'Gula pasir putih bersih murni.'],
            ['name' => 'Minyak Goreng Tropical 2L', 'category' => 'Sembako',    'price' => 32000,  'stock' => 60,  'unit' => 'botol',   'description' => 'Minyak goreng sawit premium, jernih dan hemat.'],
            ['name' => 'Telur Ayam Ras 1kg',        'category' => 'Sembako',    'price' => 28000,  'stock' => 40,  'unit' => 'kg',      'description' => 'Telur ayam segar langsung dari peternak.'],
            ['name' => 'Indomie Goreng Spesial',    'category' => 'Mie & Snack','price' => 3500,   'stock' => 200, 'unit' => 'pcs',     'description' => 'Mie instant rasa goreng, favorit semua kalangan.'],
            ['name' => 'Indomie Soto Spesial',      'category' => 'Mie & Snack','price' => 3500,   'stock' => 180, 'unit' => 'pcs',     'description' => 'Mie instant rasa soto yang segar.'],
            ['name' => 'Chitato Original 68g',      'category' => 'Mie & Snack','price' => 12000,  'stock' => 30,  'unit' => 'bungkus', 'description' => 'Keripik kentang rasa original renyah.'],
            ['name' => 'Aqua Galon 19L',            'category' => 'Minuman',    'price' => 20000,  'stock' => 25,  'unit' => 'galon',   'description' => 'Air mineral murni dalam galon isi ulang.'],
            ['name' => 'Teh Botol Sosro 450ml',     'category' => 'Minuman',    'price' => 6000,   'stock' => 120, 'unit' => 'botol',   'description' => 'Teh botol legendaris Indonesia, segar dingin.'],
            ['name' => 'Kopi Kapal Api Spesial',    'category' => 'Minuman',    'price' => 2000,   'stock' => 300, 'unit' => 'sachet',  'description' => 'Kopi hitam sachet khas Indonesia.'],
            ['name' => 'Royco Kaldu Ayam 460g',     'category' => 'Bumbu Dapur','price' => 17000,  'stock' => 45,  'unit' => 'bungkus', 'description' => 'Penyedap rasa ayam untuk masakan lezat.'],
            ['name' => 'Kecap Manis Bango 275ml',   'category' => 'Bumbu Dapur','price' => 12000,  'stock' => 55,  'unit' => 'botol',   'description' => 'Kecap manis kental rasa original.'],
            ['name' => 'Rinso Anti Noda 900g',      'category' => 'Kebersihan', 'price' => 20000,  'stock' => 35,  'unit' => 'bungkus', 'description' => 'Deterjen ampuh hilangkan noda membandel.'],
            ['name' => 'Sabun Mandi Lifebuoy 85g',  'category' => 'Kebersihan', 'price' => 5500,   'stock' => 7,   'unit' => 'pcs',     'description' => 'Sabun antiseptik proteksi kuman 100%.'],
            ['name' => 'Pepsodent Herbal 190g',     'category' => 'Kebersihan', 'price' => 14000,  'stock' => 0,   'unit' => 'pcs',     'description' => 'Pasta gigi herbal untuk gigi sehat.'],
        ];

        foreach ($fixedProducts as $product) {
            Product::create($product);
        }

        // Generate 25 produk random tambahan pakai factory
        Product::factory()->count(15)->create();
        Product::factory()->count(5)->lowStock()->create();
        Product::factory()->count(5)->outOfStock()->create();

        $total = Product::count();
        $this->command->info("✅ {$total} produk berhasil di-seed!");
    }
}