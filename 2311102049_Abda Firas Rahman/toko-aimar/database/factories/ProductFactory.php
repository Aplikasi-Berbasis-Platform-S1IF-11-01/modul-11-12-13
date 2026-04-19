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
    $elektronik = [
        'Mouse Gaming Logitech', 'Keyboard Mechanical RGB', 'Monitor 24 Inch IPS', 
        'Webcam Full HD 1080p', 'Headset SteelSeries', 'Laptop Stand Aluminium', 
        'SSD NVMe 512GB', 'RAM DDR4 16GB', 'Kabel HDMI 2.1', 'Speaker Bluetooth Bose', 
        'Powerbank 20000mAh', 'Router WiFi 6'
    ];

    return [
        'nama_produk' => fake()->unique()->randomElement($elektronik),
        'deskripsi' => 'Perangkat elektronik kualitas terbaik untuk pelanggan setia Mas Aimar.',
        'harga' => fake()->numberBetween(50, 500) * 1000, // Harga kelipatan 1000
        'stok' => fake()->numberBetween(5, 30),
    ];
}
}
