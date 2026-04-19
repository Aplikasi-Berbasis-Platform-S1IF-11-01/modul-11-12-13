<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_produk' => fake()->words(2, true),
            'kategori' => fake()->randomElement([
                'Makanan',
                'Minuman',
                'Elektronik',
                'ATK',
                'Aksesoris'
            ]),
            'harga' => fake()->numberBetween(5000, 500000),
            'stok' => fake()->numberBetween(1, 100),
            'deskripsi' => fake()->sentence(),
        ];
    }
}