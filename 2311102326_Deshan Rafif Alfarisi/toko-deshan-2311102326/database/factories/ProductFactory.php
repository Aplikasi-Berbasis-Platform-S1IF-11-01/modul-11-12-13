<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Product> */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $products = [
            ['nama' => 'Indomie Goreng', 'kategori' => 'Makanan'],
            ['nama' => 'Indomie Kuah Soto', 'kategori' => 'Makanan'],
            ['nama' => 'Suki Pack Original', 'kategori' => 'Makanan'],
            ['nama' => 'Mie Sedaap Goreng', 'kategori' => 'Makanan'],
            ['nama' => 'Pop Mie Ayam', 'kategori' => 'Makanan'],
            ['nama' => 'Chitato Sapi Panggang', 'kategori' => 'Snack'],
            ['nama' => 'Lays Classic', 'kategori' => 'Snack'],
            ['nama' => 'Qtela Tempe', 'kategori' => 'Snack'],
            ['nama' => 'Taro Net', 'kategori' => 'Snack'],
            ['nama' => 'Oreo Vanila', 'kategori' => 'Snack'],
            ['nama' => 'Pocky Cokelat', 'kategori' => 'Snack'],
            ['nama' => 'Pringles Original', 'kategori' => 'Snack'],
            ['nama' => 'Aqua 600ml', 'kategori' => 'Minuman'],
            ['nama' => 'Teh Botol Sosro', 'kategori' => 'Minuman'],
            ['nama' => 'Coca Cola 390ml', 'kategori' => 'Minuman'],
            ['nama' => 'Sprite 390ml', 'kategori' => 'Minuman'],
            ['nama' => 'Fanta Strawberry', 'kategori' => 'Minuman'],
            ['nama' => 'Ultra Milk Cokelat', 'kategori' => 'Minuman'],
            ['nama' => 'Good Day Cappuccino', 'kategori' => 'Minuman'],
            ['nama' => 'Teh Pucuk Harum', 'kategori' => 'Minuman'],
            ['nama' => 'Le Minerale 600ml', 'kategori' => 'Minuman'],
            ['nama' => 'Sabun Lifebuoy', 'kategori' => 'Peralatan'],
            ['nama' => 'Pasta Gigi Pepsodent', 'kategori' => 'Peralatan'],
            ['nama' => 'Shampoo Pantene 170ml', 'kategori' => 'Peralatan'],
            ['nama' => 'Deterjen Rinso 800g', 'kategori' => 'Peralatan'],
            ['nama' => 'Tissue Paseo 250s', 'kategori' => 'Peralatan'],
            ['nama' => 'Baterai ABC AA', 'kategori' => 'Peralatan'],
            ['nama' => 'Sikat Gigi Formula', 'kategori' => 'Peralatan'],
            ['nama' => 'Pewangi Molto 900ml', 'kategori' => 'Peralatan'],
            ['nama' => 'Sabun Cuci Sunlight', 'kategori' => 'Peralatan'],
        ];

        $product = $this->faker->unique()->randomElement($products);

        return [
            'nama_produk' => $product['nama'],
            'kategori' => $product['kategori'],
            'harga' => $this->faker->numberBetween(2, 75) * 500,
            'stok' => $this->faker->numberBetween(5, 200),
        ];
    }
}
