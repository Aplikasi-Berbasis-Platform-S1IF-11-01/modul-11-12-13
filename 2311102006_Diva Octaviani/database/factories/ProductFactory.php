<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Atasan', 'Bawahan', 'Dress', 'Hijab', 'Aksesoris'];
        $names = [
            'Blouse Linen Cream', 'Rok Plisket Navy', 'Dress Batik Modern',
            'Hijab Voal Motif', 'Kalung Mutiara', 'Kemeja Flanel', 'Celana Kulot',
            'Gamis Syari', 'Pashmina Satin', 'Anting Vintage'
        ];

        return [
            'name'     => $this->faker->randomElement($names) . ' ' . $this->faker->bothify('##??'),
            'category' => $this->faker->randomElement($categories),
            'price'    => $this->faker->numberBetween(50000, 500000),
        ];
    }
}