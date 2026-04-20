<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
    'nama_produk' => $this->faker->randomElement(['Paket Suki A', 'Shabu Beef', 'Dumpling Keju', 'Kuah Tomyam', 'Teh Pucuk']),
    'kategori' => $this->faker->randomElement(['Makanan', 'Minuman', 'Frozen Food']),
    'harga' => $this->faker->numberBetween(10000, 50000),
    'stok' => $this->faker->numberBetween(1, 100),
];
    }
}
