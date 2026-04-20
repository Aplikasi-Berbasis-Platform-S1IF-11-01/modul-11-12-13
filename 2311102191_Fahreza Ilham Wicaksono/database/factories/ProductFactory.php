<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $categories = ['mouse', 'keyboard', 'monitor', 'headphone', 'iem'];
        $category = $this->faker->randomElement($categories);

        return [
            'name' => match ($category) {
                'mouse' => 'Mouse ' . $this->faker->randomElement(['Gaming', 'Wireless', 'RGB']),
                'keyboard' => 'Keyboard ' . $this->faker->randomElement(['Mechanical', 'RGB']),
                'monitor' => 'Monitor ' . $this->faker->randomElement(['IPS', 'OLED', '144Hz', '544Hz', '4K']),
                'headphone' => 'Headphone ' . $this->faker->randomElement(['Studio', 'Wireless']),
                'iem' => 'IEM ' . $this->faker->randomElement(['Pro', 'Bass']),
            },
            'category' => $category,
            'price' => $this->faker->numberBetween(50000, 5000000),
        ];
    }
}
