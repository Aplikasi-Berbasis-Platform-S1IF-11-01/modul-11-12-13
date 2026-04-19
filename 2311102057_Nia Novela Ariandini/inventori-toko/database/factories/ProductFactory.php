<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'nama' => $this->faker->randomElement(['Serum Pak Cik', 'Aimar Glow Serum', 'Sunscreen Mas Jakobi', 'Toner Suki-Suki', 'Moisturizer Aim']),
        'deskripsi' => 'Produk skincare kualitas terbaik pilihan Mas Aimar.',
        'stok' => $this->faker->numberBetween(10, 100),
        'harga' => $this->faker->numberBetween(50000, 250000),
    ];
}
}
