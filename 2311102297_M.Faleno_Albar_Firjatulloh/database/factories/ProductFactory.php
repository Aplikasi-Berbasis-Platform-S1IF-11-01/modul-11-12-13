<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $products = [
            ['name' => 'Beras Premium 5kg', 'category' => 'Makanan', 'unit' => 'kg'],
            ['name' => 'Minyak Goreng Tropical 2L', 'category' => 'Makanan', 'unit' => 'liter'],
            ['name' => 'Gula Pasir 1kg', 'category' => 'Makanan', 'unit' => 'kg'],
            ['name' => 'Tepung Terigu Segitiga Biru', 'category' => 'Makanan', 'unit' => 'kg'],
            ['name' => 'Mie Instan Goreng', 'category' => 'Makanan', 'unit' => 'pcs'],
            ['name' => 'Sarden Kaleng ABC', 'category' => 'Makanan', 'unit' => 'pcs'],
            ['name' => 'Kecap Manis Bango 600ml', 'category' => 'Makanan', 'unit' => 'pcs'],
            ['name' => 'Sambal ABC Extra Pedas', 'category' => 'Makanan', 'unit' => 'pcs'],
            ['name' => 'Susu Ultra Milk 1L', 'category' => 'Minuman', 'unit' => 'liter'],
            ['name' => 'Air Mineral Aqua 600ml', 'category' => 'Minuman', 'unit' => 'pcs'],
            ['name' => 'Teh Botol Sosro 350ml', 'category' => 'Minuman', 'unit' => 'pcs'],
            ['name' => 'Kopi Kapal Api Special', 'category' => 'Minuman', 'unit' => 'box'],
            ['name' => 'Minuman Energi Extra Joss', 'category' => 'Minuman', 'unit' => 'box'],
            ['name' => 'Jus Buah Marimas', 'category' => 'Minuman', 'unit' => 'box'],
            ['name' => 'Sabun Mandi Lifebuoy', 'category' => 'Kebersihan', 'unit' => 'pcs'],
            ['name' => 'Shampo Pantene 170ml', 'category' => 'Kebersihan', 'unit' => 'pcs'],
            ['name' => 'Pasta Gigi Pepsodent 190gr', 'category' => 'Kebersihan', 'unit' => 'pcs'],
            ['name' => 'Deterjen Rinso 800gr', 'category' => 'Kebersihan', 'unit' => 'pcs'],
            ['name' => 'Sabun Cuci Piring Sunlight', 'category' => 'Kebersihan', 'unit' => 'pcs'],
            ['name' => 'Pewangi Pakaian Molto', 'category' => 'Kebersihan', 'unit' => 'liter'],
            ['name' => 'Kaos Polos Cotton Combed', 'category' => 'Pakaian', 'unit' => 'pcs'],
            ['name' => 'Celana Pendek Training', 'category' => 'Pakaian', 'unit' => 'pcs'],
            ['name' => 'Kaos Kaki Polos', 'category' => 'Pakaian', 'unit' => 'lusin'],
            ['name' => 'Buku Tulis Sidu 58 Lembar', 'category' => 'Alat Tulis', 'unit' => 'pcs'],
            ['name' => 'Pulpen Pilot Hitam', 'category' => 'Alat Tulis', 'unit' => 'lusin'],
            ['name' => 'Pensil 2B Faber Castell', 'category' => 'Alat Tulis', 'unit' => 'lusin'],
            ['name' => 'Penggaris 30cm', 'category' => 'Alat Tulis', 'unit' => 'pcs'],
            ['name' => 'Stapler Kenko', 'category' => 'Alat Tulis', 'unit' => 'pcs'],
            ['name' => 'Lampu LED Philips 10W', 'category' => 'Elektronik', 'unit' => 'pcs'],
            ['name' => 'Baterai ABC AA isi 4', 'category' => 'Elektronik', 'unit' => 'box'],
        ];

        $product = $this->faker->randomElement($products);

        return [
            'name'        => $product['name'],
            'category'    => $product['category'],
            'unit'        => $product['unit'],
            'description' => $this->faker->randomElement([
                'Produk berkualitas tinggi pilihan pelanggan setia toko kami.',
                'Stok selalu fresh dan terjamin kualitasnya.',
                'Produk original bergaransi resmi dari distributor.',
                'Tersedia dalam berbagai varian pilihan.',
                'Harga terjangkau kualitas tidak mengecewakan.',
            ]),
            'stock'       => $this->faker->numberBetween(5, 200),
            'price'       => $this->faker->randomElement([
                2000, 3500, 5000, 7500, 8000, 10000, 12500, 15000,
                17500, 20000, 25000, 30000, 35000, 45000, 50000,
                60000, 75000, 85000, 100000, 125000, 150000, 200000
            ]),
        ];
    }
}