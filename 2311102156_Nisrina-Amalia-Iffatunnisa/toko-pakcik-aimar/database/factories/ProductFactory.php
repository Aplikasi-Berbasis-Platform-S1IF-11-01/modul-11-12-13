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
            'name' => $this->faker->words(2, true), // Nama barang (misal: "Suki Kuah")
            'price' => $this->faker->numberBetween(15000, 50000), // Harga antara 15rb-50rb
            'stock' => $this->faker->numberBetween(1, 100), // Stok barang
            'description' => $this->faker->sentence(), // Deskripsi singkat
            'category' => $this->faker->word(), // Kategori barang
        ];
    }
}
