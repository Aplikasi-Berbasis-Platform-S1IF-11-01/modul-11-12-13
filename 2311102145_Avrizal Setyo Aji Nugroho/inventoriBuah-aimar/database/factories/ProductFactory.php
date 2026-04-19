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
        $daftarBuah = [
            'Jeruk Sunkist',
            'Mangga Arumanis',
            'Semangka Tanpa Biji',
            'Melon Madu',
            'Anggur Muscat',
            'Pisang Raja',
            'Durian Montong',
            'Salak Pondoh',
            'Manggis Ngawi',
            'Nanas Madu'
        ];

        return [
            'nama_produk' => fake()->randomElement($daftarBuah),
            'stok' => fake()->numberBetween(1, 100),
            'harga' => fake()->numberBetween(5000, 50000),
        ];
    }
}
