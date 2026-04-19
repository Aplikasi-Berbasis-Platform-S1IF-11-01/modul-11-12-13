<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Makanan', 'Minuman', 'Sembako', 'Kebersihan', 'Elektronik'];
        $units = ['pcs', 'kg', 'liter', 'lusin', 'pack'];

        return [
            'name' => $this->faker->words(3, true),
            'category' => $this->faker->randomElement($categories),
            'description' => $this->faker->sentence(),
            'stock' => $this->faker->numberBetween(10, 500),
            'price' => $this->faker->numberBetween(1000, 500000),
            'unit' => $this->faker->randomElement($units),
        ];
    }
}