<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Data produk realistis untuk toko kelontong/sembako.
     * Diakses via sequence() di seeder agar tidak bergantung static counter.
     */
    public static array $productList = [
        // Sembako
        ['prefix' => 'SMB', 'name' => 'Beras Premium 5kg', 'category' => 'Sembako', 'unit' => 'Karung', 'buy' => 65000, 'sell' => 72000],
        ['prefix' => 'SMB', 'name' => 'Gula Pasir 1kg', 'category' => 'Sembako', 'unit' => 'Kg', 'buy' => 14000, 'sell' => 16000],
        ['prefix' => 'SMB', 'name' => 'Minyak Goreng 2L', 'category' => 'Sembako', 'unit' => 'Botol', 'buy' => 30000, 'sell' => 34000],
        ['prefix' => 'SMB', 'name' => 'Tepung Terigu 1kg', 'category' => 'Sembako', 'unit' => 'Kg', 'buy' => 10000, 'sell' => 12500],
        ['prefix' => 'SMB', 'name' => 'Garam Dapur 250g', 'category' => 'Sembako', 'unit' => 'Bungkus', 'buy' => 2500, 'sell' => 3500],
        // Makanan
        ['prefix' => 'MKN', 'name' => 'Mie Instan Ayam', 'category' => 'Makanan', 'unit' => 'Bungkus', 'buy' => 2800, 'sell' => 3500],
        ['prefix' => 'MKN', 'name' => 'Mie Instan Goreng', 'category' => 'Makanan', 'unit' => 'Bungkus', 'buy' => 2800, 'sell' => 3500],
        ['prefix' => 'MKN', 'name' => 'Sarden Kalengan 155g', 'category' => 'Makanan', 'unit' => 'Kaleng', 'buy' => 10000, 'sell' => 13000],
        // Bumbu
        ['prefix' => 'BMB', 'name' => 'Kecap Manis 220ml', 'category' => 'Bumbu', 'unit' => 'Botol', 'buy' => 8500, 'sell' => 10000],
        ['prefix' => 'BMB', 'name' => 'Sambal Botol 340g', 'category' => 'Bumbu', 'unit' => 'Botol', 'buy' => 12000, 'sell' => 15000],
        ['prefix' => 'BMB', 'name' => 'Saos Tomat 340g', 'category' => 'Bumbu', 'unit' => 'Botol', 'buy' => 11000, 'sell' => 13500],
        // Minuman
        ['prefix' => 'MNM', 'name' => 'Air Mineral 600ml', 'category' => 'Minuman', 'unit' => 'Botol', 'buy' => 2500, 'sell' => 4000],
        ['prefix' => 'MNM', 'name' => 'Air Mineral 1500ml', 'category' => 'Minuman', 'unit' => 'Botol', 'buy' => 4000, 'sell' => 6000],
        ['prefix' => 'MNM', 'name' => 'Teh Botol Sosro', 'category' => 'Minuman', 'unit' => 'Botol', 'buy' => 5000, 'sell' => 7000],
        ['prefix' => 'MNM', 'name' => 'Kopi Sachet 3in1', 'category' => 'Minuman', 'unit' => 'Box', 'buy' => 22000, 'sell' => 28000],
        ['prefix' => 'MNM', 'name' => 'Susu UHT 250ml', 'category' => 'Minuman', 'unit' => 'Kotak', 'buy' => 5500, 'sell' => 7500],
        // Kebersihan
        ['prefix' => 'KBR', 'name' => 'Sabun Mandi Batang', 'category' => 'Kebersihan', 'unit' => 'Buah', 'buy' => 4500, 'sell' => 6000],
        ['prefix' => 'KBR', 'name' => 'Shampo Sachet', 'category' => 'Kebersihan', 'unit' => 'Pcs', 'buy' => 1200, 'sell' => 2000],
        ['prefix' => 'KBR', 'name' => 'Detergen Bubuk 1kg', 'category' => 'Kebersihan', 'unit' => 'Bungkus', 'buy' => 18000, 'sell' => 22000],
        ['prefix' => 'KBR', 'name' => 'Sabun Cuci Piring', 'category' => 'Kebersihan', 'unit' => 'Botol', 'buy' => 8000, 'sell' => 10000],
        ['prefix' => 'KBR', 'name' => 'Odol Pasta Gigi', 'category' => 'Kebersihan', 'unit' => 'Tube', 'buy' => 12000, 'sell' => 15000],
        // Snack
        ['prefix' => 'SNK', 'name' => 'Keripik Singkong', 'category' => 'Snack', 'unit' => 'Bungkus', 'buy' => 5000, 'sell' => 7000],
        ['prefix' => 'SNK', 'name' => 'Permen Mint', 'category' => 'Snack', 'unit' => 'Bungkus', 'buy' => 2000, 'sell' => 3000],
        ['prefix' => 'SNK', 'name' => 'Wafer Coklat', 'category' => 'Snack', 'unit' => 'Pcs', 'buy' => 3000, 'sell' => 4500],
        ['prefix' => 'SNK', 'name' => 'Biskuit Kaleng', 'category' => 'Snack', 'unit' => 'Kaleng', 'buy' => 35000, 'sell' => 42000],
        // Rokok
        ['prefix' => 'RKK', 'name' => 'Rokok Kretek Filter', 'category' => 'Rokok', 'unit' => 'Bungkus', 'buy' => 23000, 'sell' => 26000],
    ];

    public function definition(): array
    {
        // Pilih produk secara acak dari daftar
        $product = $this->faker->randomElement(self::$productList);

        return [
            'code' => $product['prefix'] . '-' . strtoupper(Str::random(6)),
            'name' => $product['name'],
            'category' => $product['category'],
            'unit' => $product['unit'],
            'buy_price' => $product['buy'],
            'sell_price' => $product['sell'],
            'stock' => $this->faker->numberBetween(10, 200),
            'min_stock' => $this->faker->numberBetween(5, 20),
            'description' => $this->faker->optional(0.6)->sentence(8),
        ];
    }
}