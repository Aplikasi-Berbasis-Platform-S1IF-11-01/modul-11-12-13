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
            // Bikin nama produk bohongan
            'nama_produk' => fake()->words(3, true), 
            // Bikin stok random dari 5 sampai 100
            'stok' => fake()->numberBetween(5, 100), 
            // Bikin harga random (kelipatan rupiah)
            'harga' => fake()->numberBetween(15000, 750000), 
            // Deskripsi santai
            'deskripsi' => 'Barang original dari supplier Mas Aimar, kualitas dijamin mantap King.', 
        ];
    }
}