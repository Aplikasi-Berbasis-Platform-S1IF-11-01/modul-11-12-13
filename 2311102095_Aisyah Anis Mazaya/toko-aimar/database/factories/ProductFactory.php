<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        
        $barangCewek = [
            'Tas Selempang Pink Pastel', 'Lipstik Matte Nude', 'Pashmina Ceruty Mocca',
            'Dress Motif Bunga', 'Sepatu Kets Putih', 'Cardigan Rajut Taro',
            'Paket Skincare Glowing', 'Parfum Aroma Vanilla', 'Dompet Lipat Lucu Comel',
            'Pita Rambut Style Korea', 'Cushion SPF 50', 'Tunik Lengan Balon',
            'Kacamata Fashion Cat-Eye', 'Jam Tangan Rose Gold', 'Slingbag Rantai Mini'
        ];

        return [
            // Pilih nama produk secara acak dari daftar di atas
            'nama_produk' => fake()->randomElement($barangCewek),
            
            // Harganya dibikin antara 15rb sampai 250rb
            'harga' => fake()->numberBetween(15000, 250000),
            'stok' => fake()->numberBetween(5, 50),
        ];
    }
}