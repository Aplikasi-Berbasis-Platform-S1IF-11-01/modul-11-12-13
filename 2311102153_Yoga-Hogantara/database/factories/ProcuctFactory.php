<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $products = [
            ['name' => 'Beras Premium 5kg',       'desc' => 'Beras pulen kualitas premium pilihan petani lokal'],
            ['name' => 'Minyak Goreng 2L',         'desc' => 'Minyak goreng kelapa sawit serbaguna'],
            ['name' => 'Gula Pasir 1kg',           'desc' => 'Gula pasir putih halus hasil produksi lokal'],
            ['name' => 'Tepung Terigu 1kg',        'desc' => 'Tepung terigu serbaguna untuk masak dan kue'],
            ['name' => 'Kecap Manis 600ml',        'desc' => 'Kecap manis legit untuk berbagai masakan'],
            ['name' => 'Sabun Mandi Batang',       'desc' => 'Sabun mandi dengan aroma segar dan lembut'],
            ['name' => 'Shampo 170ml',             'desc' => 'Shampo anti ketombe perawatan rambut'],
            ['name' => 'Detergen Bubuk 800g',      'desc' => 'Detergen ampuh mengangkat noda membandel'],
            ['name' => 'Susu UHT Full Cream 1L',  'desc' => 'Susu cair siap minum kaya kalsium'],
            ['name' => 'Mie Instan',               'desc' => 'Mie instan goreng rasa ayam bawang'],
            ['name' => 'Kopi Sachet 20pcs',        'desc' => 'Kopi 3-in-1 nikmat untuk pagi hari'],
            ['name' => 'Teh Celup 25pcs',          'desc' => 'Teh celup harum aroma melati pilihan'],
            ['name' => 'Biskuit Kaleng 400g',      'desc' => 'Biskuit renyah aneka rasa premium'],
            ['name' => 'Pasta Gigi 120g',          'desc' => 'Pasta gigi mint perlindungan gigi dan gusi'],
            ['name' => 'Air Mineral 1.5L',         'desc' => 'Air mineral bersih dan menyegarkan'],
            ['name' => 'Snack Keripik 150g',       'desc' => 'Keripik singkong renyah pedas manis'],
            ['name' => 'Sarden Kaleng 155g',       'desc' => 'Ikan sarden dalam saus tomat praktis'],
            ['name' => 'Kacang Tanah 500g',        'desc' => 'Kacang tanah kupas siap goreng berkualitas'],
        ];

        $product = $this->faker->randomElement($products);

        return [
            'name'        => $product['name'],
            'description' => $product['desc'],
            'price'       => $this->faker->randomElement([
                2000, 3500, 5000, 7500, 8000, 10000, 12500,
                15000, 18000, 20000, 25000, 35000, 45000, 55000, 75000
            ]),
            'stock'       => $this->faker->numberBetween(5, 200),
        ];
    }
}