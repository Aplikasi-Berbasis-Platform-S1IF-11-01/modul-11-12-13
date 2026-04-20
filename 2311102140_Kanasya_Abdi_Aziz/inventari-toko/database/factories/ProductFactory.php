<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $products = [
            ['name' => 'Indomie Goreng',          'category' => 'Makanan',    'unit' => 'pcs'],
            ['name' => 'Beras Premium 5kg',        'category' => 'Sembako',    'unit' => 'kg'],
            ['name' => 'Minyak Goreng Bimoli',     'category' => 'Sembako',    'unit' => 'liter'],
            ['name' => 'Teh Botol Sosro',          'category' => 'Minuman',    'unit' => 'pcs'],
            ['name' => 'Kopi Kapal Api',           'category' => 'Minuman',    'unit' => 'pack'],
            ['name' => 'Gula Pasir',               'category' => 'Sembako',    'unit' => 'kg'],
            ['name' => 'Sabun Mandi Lifebuoy',     'category' => 'Kebersihan', 'unit' => 'pcs'],
            ['name' => 'Deterjen Rinso',           'category' => 'Kebersihan', 'unit' => 'pcs'],
            ['name' => 'Chiki Snack',              'category' => 'Snack',      'unit' => 'pcs'],
            ['name' => 'Biscuit Roma',             'category' => 'Snack',      'unit' => 'pcs'],
            ['name' => 'Kecap Manis ABC',          'category' => 'Bumbu',      'unit' => 'pcs'],
            ['name' => 'Sambal Indofood',          'category' => 'Bumbu',      'unit' => 'pcs'],
            ['name' => 'Aqua Galon',               'category' => 'Minuman',    'unit' => 'pcs'],
            ['name' => 'Susu Ultra 1 Liter',       'category' => 'Minuman',    'unit' => 'pcs'],
            ['name' => 'Tepung Terigu Segitiga',   'category' => 'Sembako',    'unit' => 'kg'],
        ];

        $product = $this->faker->randomElement($products);

        return [
            'name'        => $product['name'],
            'category'    => $product['category'],
            'description' => $this->faker->sentence(10),
            'price'       => $this->faker->numberBetween(1000, 150000),
            'stock'       => $this->faker->numberBetween(0, 200),
            'unit'        => $product['unit'],
        ];
    }
}