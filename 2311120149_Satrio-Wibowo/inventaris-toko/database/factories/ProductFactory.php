<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    private static array $categories = [
        'Elektronik', 'Makanan & Minuman', 'Pakaian',
        'Peralatan Rumah', 'Kosmetik', 'Olahraga', 'Otomotif',
    ];

    public function definition(): array
    {
        return [
            'name'        => $this->faker->unique()->words(3, true),
            'category'    => $this->faker->randomElement(self::$categories),
            'price'       => $this->faker->randomFloat(2, 5000, 5000000),
            'stock'       => $this->faker->numberBetween(0, 200),
            'description' => $this->faker->sentence(12),
        ];
    }

    // State: produk dengan stok kritis
    public function lowStock(): static
    {
        return $this->state(fn () => ['stock' => $this->faker->numberBetween(0, 9)]);
    }
}