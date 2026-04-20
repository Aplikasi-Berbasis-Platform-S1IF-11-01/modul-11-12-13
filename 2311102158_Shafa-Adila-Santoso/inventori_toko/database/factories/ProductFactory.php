<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $kategori = $this->faker->randomElement([
            'Minuman', 'Makanan Ringan', 'Sembako', 'Peralatan Rumah', 'Kebersihan', 'Kosmetik'
        ]);

        $produkByKategori = [
            'Minuman'          => ['Aqua 600ml', 'Teh Botol Sosro', 'Pocari Sweat', 'Mizone', 'Fanta Merah', 'Coca-Cola', 'Le Minerale', 'Sprite', 'Yakult', 'Kopiko 78°C'],
            'Makanan Ringan'   => ['Chitato Sapi Panggang', 'Oreo Original', 'Biskuat', 'Wafer Tango', 'Pringles Original', 'Roti Sobek Sari Roti', 'Malkist Crackers', 'Taro Net', 'Momogi', 'Superstar Snack'],
            'Sembako'          => ['Beras Premium 5kg', 'Minyak Goreng Bimoli 1L', 'Gula Pasir 1kg', 'Telur Ayam 1kg', 'Terigu Segitiga Biru', 'Kecap Manis ABC', 'Indomie Goreng', 'Santan Kara', 'Sarden ABC', 'Kornet Pronas'],
            'Peralatan Rumah'  => ['Sapu Lidi', 'Ember Plastik', 'Gayung', 'Lap Pel', 'Tali Rafia', 'Baskom Sedang', 'Hanger Baju', 'Sikat Gigi Oral-B', 'Korek Api', 'Lilin'],
            'Kebersihan'       => ['Sabun Lifebuoy', 'Shampoo Pantene', 'Deterjen Rinso', 'Softener Downy', 'Sabun Cuci Piring Sunlight', 'Odol Pepsodent', 'Pewangi Ruangan Glade', 'Pembalut Charm', 'Tisu Paseo', 'Hand Sanitizer'],
            'Kosmetik'         => ['Bedak Marcks', 'Lip Balm Vaseline', 'Pelembab Nivea', 'Deodorant Rexona', 'Body Lotion Citra', 'Minyak Kayu Putih Cap Lang', 'Balsem Geliga', 'Cologne Gatsby', 'Pomade Gatsby', 'Minyak Rambut Brisk'],
        ];

        return [
            'nama_produk' => $this->faker->randomElement($produkByKategori[$kategori]),
            'kategori'    => $kategori,
            'stok'        => $this->faker->numberBetween(5, 200),
            'harga'       => $this->faker->randomElement([1500, 2000, 2500, 3000, 3500, 4000, 5000, 6500, 7500, 8000, 10000, 12000, 15000, 18000, 20000, 25000, 30000, 35000, 45000, 50000]),
            'deskripsi'   => $this->faker->sentence(8),
        ];
    }
}
