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
            'name' => fake()->words(2, true),
            'category' => fake()->randomElement(['Makanan', 'Minuman', 'Sembako']),
            'price' => fake()->numberBetween(2000, 100000),
            'stock' => fake()->numberBetween(1, 100),
            'description' => fake()->sentence(),
        ];
    }
}