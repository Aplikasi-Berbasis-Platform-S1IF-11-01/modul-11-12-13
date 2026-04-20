<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'name' => fake()->randomElement([
                'Beras Premium 5kg',
                'Minyak Goreng 1L',
                'Gula Pasir 1kg',
                'Teh Celup Melati',
                'Kopi Bubuk Original',
                'Mie Instan Goreng',
                'Susu UHT Coklat',
                'Sabun Mandi Cair',
                'Shampo Anti Lepek',
                'Pasta Gigi Herbal',
                'Air Mineral 600ml',
                'Telur Ayam 1kg',
            ]),
            'category' => fake()->randomElement([
                'Sembako',
                'Minuman',
                'Makanan',
                'Perawatan',
                'Kebutuhan Rumah',
            ]),
            'stock' => fake()->numberBetween(1, 150),
            'price' => fake()->numberBetween(5000, 150000),
            'description' => fake()->sentence(),
        ];
    }
}