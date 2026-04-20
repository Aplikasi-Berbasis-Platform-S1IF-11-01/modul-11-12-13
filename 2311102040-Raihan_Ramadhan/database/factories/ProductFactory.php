<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'stock' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(1000, 100000),
            'image' => 'default.png',
        ];
    }
}