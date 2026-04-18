<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    protected $model = Produk::class;

    public function definition(): array
    {
        $produkList = [
            // Makanan
            ['nama' => 'Beras Premium 5kg', 'satuan' => 'karung'],
            ['nama' => 'Mie Goreng Instan', 'satuan' => 'bungkus'],
            ['nama' => 'Gula Pasir 1kg', 'satuan' => 'kg'],
            ['nama' => 'Minyak Goreng 2L', 'satuan' => 'botol'],
            ['nama' => 'Telur Ayam 1kg', 'satuan' => 'kg'],
            // Minuman
            ['nama' => 'Air Mineral 600ml', 'satuan' => 'botol'],
            ['nama' => 'Teh Kotak 200ml', 'satuan' => 'kotak'],
            ['nama' => 'Kopi Sachet', 'satuan' => 'bungkus'],
            ['nama' => 'Susu UHT 1L', 'satuan' => 'liter'],
            // Snack
            ['nama' => 'Keripik Singkong 200g', 'satuan' => 'bungkus'],
            ['nama' => 'Biskuit Coklat', 'satuan' => 'kotak'],
            ['nama' => 'Permen Jahe', 'satuan' => 'bungkus'],
            ['nama' => 'Wafer Krim Vanilla', 'satuan' => 'bungkus'],
            // Kebutuhan Rumah
            ['nama' => 'Sabun Cuci Piring 500ml', 'satuan' => 'botol'],
            ['nama' => 'Detergen Bubuk 1kg', 'satuan' => 'kg'],
            ['nama' => 'Tisu Wajah 50 lembar', 'satuan' => 'kotak'],
            ['nama' => 'Kantong Plastik 100 pcs', 'satuan' => 'pack'],
            // Perawatan Diri
            ['nama' => 'Sabun Mandi Antiseptik', 'satuan' => 'batang'],
            ['nama' => 'Sampo Ketombe 340ml', 'satuan' => 'botol'],
            ['nama' => 'Pasta Gigi 120g', 'satuan' => 'tube'],
            // Alat Tulis
            ['nama' => 'Pulpen Ballpoint', 'satuan' => 'buah'],
            ['nama' => 'Buku Nota A5', 'satuan' => 'buah'],
            ['nama' => 'Penghapus Karet', 'satuan' => 'buah'],
        ];

        $pick = $this->faker->randomElement($produkList);
        $kode = strtoupper(substr(str_replace(' ', '', $pick['nama']), 0, 4))
            . '-' . $this->faker->unique()->numerify('###');

        return [
            'nama'        => $pick['nama'],
            'kode'        => $kode,
            'deskripsi'   => $this->faker->sentence(12),
            'harga'       => $this->faker->numberBetween(500, 150000),
            'stok'        => $this->faker->numberBetween(5, 500),
            'satuan'      => $pick['satuan'],
            'kategori_id' => Kategori::inRandomOrder()->first()->id,
            'status'      => $this->faker->randomElement(['aktif', 'nonaktif']),
        ];
    }
}
