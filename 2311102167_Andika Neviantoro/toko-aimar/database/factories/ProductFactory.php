<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    private static int $skuCounter = 1;

    public function definition(): array
    {
        $categories = [
            'Makanan & Minuman',
            'Elektronik',
            'Pakaian',
            'Alat Rumah Tangga',
            'Kesehatan & Kecantikan',
            'Perlengkapan Bayi',
            'Olahraga',
            'Buku & Alat Tulis',
        ];

        $products = [
            'Makanan & Minuman'     => ['Mie Instan Goreng', 'Kopi Sachet', 'Teh Botol', 'Biscuit Regal', 'Susu UHT', 'Air Mineral 1.5L', 'Minuman Energi', 'Snack Keripik', 'Coklat Batang', 'Roti Tawar'],
            'Elektronik'            => ['Charger USB-C', 'Earphone Kabel', 'Power Bank 10000mAh', 'Lampu LED 10W', 'Baterai AA', 'Kabel HDMI', 'Mouse Wireless', 'Keyboard USB', 'Flashdisk 64GB', 'Speaker Bluetooth Mini'],
            'Pakaian'               => ['Kaos Polos Putih', 'Celana Pendek Cargo', 'Jaket Denim', 'Kemeja Flanel', 'Sandal Jepit', 'Kaus Kaki Pendek', 'Topi Baseball', 'Daster Batik', 'Baju Olahraga', 'Celana Training'],
            'Alat Rumah Tangga'     => ['Sapu Ijuk', 'Ember Plastik 10L', 'Wadah Serbaguna', 'Sikat WC', 'Lap Microfiber', 'Hanger Baju 10pcs', 'Tempat Sabun', 'Tikar Plastik', 'Panci Teflon 22cm', 'Sendok Sayur'],
            'Kesehatan & Kecantikan'=> ['Masker Medis 50pcs', 'Hand Sanitizer 500ml', 'Vitamin C 1000mg', 'Sabun Mandi Cair', 'Shampo Anti Ketombe', 'Pasta Gigi Whitening', 'Krim Wajah SPF30', 'Deodorant Roll-on', 'Kapas Wajah', 'Plester Luka'],
            'Perlengkapan Bayi'     => ['Pampers Newborn', 'Bedak Bayi', 'Sabun Bayi', 'Botol Susu 250ml', 'Dot Bayi Silikon', 'Baju Bayi 0-3 Bulan', 'Selimut Bayi', 'Tisu Bayi 60 Lembar', 'Minyak Telon', 'Mainan Gigitan Bayi'],
            'Olahraga'              => ['Tali Skipping', 'Dumbbell 2kg', 'Matras Yoga', 'Botol Air 700ml', 'Kaos Lari', 'Bola Futsal', 'Raket Badminton', 'Shuttlecock 12pcs', 'Sepatu Olahraga', 'Pelindung Lutut'],
            'Buku & Alat Tulis'     => ['Pulpen Hitam 10pcs', 'Buku Tulis 40 Lembar', 'Pensil 2B', 'Penghapus Besar', 'Stabilo Warna', 'Penggaris 30cm', 'Kertas HVS A4', 'Amplop Coklat', 'Post-it Notes', 'Map Plastik'],
        ];

        $category    = $this->faker->randomElement($categories);
        $productList = $products[$category];
        $name        = $this->faker->randomElement($productList) . ' ' . $this->faker->optional(0.3)->randomElement(['Premium', 'Original', 'Mini', 'Jumbo', '2-Pack']);
        $name        = trim($name);

        return [
            'name'        => $name,
            'description' => $this->faker->optional(0.8)->sentence(rand(10, 20)),
            'price'       => $this->faker->randomElement([
                rand(2, 50) * 1000,
                rand(1, 10) * 5000,
                rand(1, 20) * 10000,
            ]),
            'stock'       => $this->faker->numberBetween(0, 200),
            'category'    => $category,
            'sku'         => 'SKU-' . str_pad(self::$skuCounter++, 5, '0', STR_PAD_LEFT),
        ];
    }
}
