<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'nama_produk' => fake()->words(2, true),
            'kategori' => fake()->randomElement(['Makanan', 'Minuman', 'Elektronik', 'Sembako', 'ATK']),
            'harga' => fake()->numberBetween(3000, 50000),
            'stok' => fake()->numberBetween(1, 100),
            'deskripsi' => fake()->sentence(),
        ];
    }
}