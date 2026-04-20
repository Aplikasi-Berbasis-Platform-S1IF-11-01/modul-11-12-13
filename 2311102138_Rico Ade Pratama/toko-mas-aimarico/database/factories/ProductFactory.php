<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $catalog = [
            'Jersey & Apparel' => [
                ['Jersey Liverpool Home 24/25', 'Jersey merah kebanggaan Anfield edisi terbaru'],
                ['Jersey Liverpool Away 24/25', 'Jersey tandang putih-hijau original'],
                ['Jersey Retro LFC 2005', 'Jersey ikonik malam keajaiban Istanbul'],
                ['Jaket Anthem Liverpool', 'Jaket pra-pertandingan warna merah gelap'],
                ['Celana Training Bola', 'Celana panjang training bahan dry-fit'],
                ['Rompi Latihan (Bibs)', 'Rompi latihan tim warna neon terang'],
                ['Kaos Kaki Bola Panjang', 'Kaos kaki anti-slip untuk bertanding'],
            ],

            'Sepatu Bola & Futsal' => [
                ['Sepatu Bola Nike Mercurial', 'Sepatu bola ringan untuk winger cepat'],
                ['Sepatu Bola Adidas Predator', 'Sepatu bola kontrol presisi tinggi'],
                ['Sepatu Bola Specs Lightspeed', 'Sepatu bola lokal kualitas profesional'],
                ['Sepatu Futsal Ortuseight Jogosala', 'Sepatu futsal empuk untuk lapangan vinyl'],
                ['Sepatu Futsal Puma Future', 'Sepatu futsal dengan teknologi adaptive fit'],
                ['Sandal Slide LFC', 'Sandal santai untuk habis bertanding'],
            ],

            'Peralatan Latihan' => [
                ['Bola Sepak Nike Flight', 'Bola resmi standar FIFA Quality Pro'],
                ['Bola Futsal Specs', 'Bola futsal pantulan rendah (Low Bounce)'],
                ['Sarung Tangan Kiper Alisson', 'Gloves kiper dengan latex grip premium'],
                ['Cone Latihan 50 Pcs', 'Marking cone untuk latihan kelincahan (agility)'],
                ['Pompa Bola Manual', 'Pompa angin portabel plus pentil besi'],
                ['Papan Taktik Pelatih', 'Papan magnetik taktik formasi sepak bola'],
                ['Shin Guard (Dekker)', 'Pelindung tulang kering ringan dan kuat'],
            ],

            'Aksesoris Suporter' => [
                ['Syal YNWA Original', 'Scarf rajut tulisan Youll Never Walk Alone'],
                ['Topi Baseball LFC', 'Topi kasual dengan logo Liverbird'],
                ['Tas Sepatu Bola Serut', 'Gymsack anti air untuk bawa sepatu'],
                ['Botol Minum Olahraga 1L', 'Tumbler sport BPA-free ukuran besar'],
                ['Dekker Engkel (Ankle Support)', 'Pelindung engkel untuk mencegah cedera'],
            ],
        ];
        $category = $this->faker->randomElement(array_keys($catalog));
        [$name, $description] = $this->faker->randomElement($catalog[$category]);
        $suffix = $this->faker->optional(0.3)->randomElement(['(Player Issue)', '(Grade Ori)', 'Original', '- Diskon 20%', 'Limited Edition']);
        $nama_produk = $suffix ? "$name $suffix" : $name;
        $priceRange = match ($category) {
            'Jersey & Apparel'     => [150000, 1500000],
            'Sepatu Bola & Futsal' => [350000, 3500000],
            'Peralatan Latihan'    => [50000, 1500000],
            'Aksesoris Suporter'   => [35000, 350000],
            default                => [50000, 500000],
        };
        $harga = round($this->faker->numberBetween($priceRange[0], $priceRange[1]) / 5000) * 5000;
        return [
            'name'        => $nama_produk,
            'category'    => $category,
            'price'       => $harga,
            'stock'       => $this->faker->numberBetween(0, 50),
            'description' => $description, 
        ];
    }
}