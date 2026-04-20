<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $kategori = ['Elektronik', 'Pakaian', 'Makanan', 'Minuman', 'Peralatan Rumah', 'Alat Tulis', 'Mainan', 'Kosmetik'];

        $produkByKategori = [
            'Elektronik'       => ['Kipas Angin', 'Rice Cooker', 'Setrika', 'Blender', 'Lampu LED', 'Speaker Bluetooth', 'Charger HP', 'Kabel Data'],
            'Pakaian'          => ['Kaos Polos', 'Kemeja Batik', 'Celana Jeans', 'Jaket Hoodie', 'Sandal Jepit', 'Topi Baseball', 'Kaus Kaki', 'Daster'],
            'Makanan'          => ['Mie Instan', 'Beras 5kg', 'Minyak Goreng', 'Gula Pasir', 'Tepung Terigu', 'Biskuit Kaleng', 'Kecap Manis', 'Sambal Botol'],
            'Minuman'          => ['Air Mineral 1500ml', 'Teh Botol', 'Kopi Sachet', 'Susu UHT', 'Jus Jeruk', 'Minuman Energi', 'Sirup Marjan', 'Yakult'],
            'Peralatan Rumah'  => ['Sapu Lidi', 'Ember Plastik', 'Pengki', 'Kain Pel', 'Sabun Cuci Piring', 'Lap Microfiber', 'Sikat WC', 'Gantungan Baju'],
            'Alat Tulis'       => ['Pulpen Hitam', 'Buku Tulis', 'Pensil 2B', 'Penghapus', 'Stabilo', 'Penggaris 30cm', 'Tip-X', 'Map Plastik'],
            'Mainan'           => ['Lego Mini', 'Mobil Remote', 'Boneka Beruang', 'Puzzle 500pcs', 'Yoyo', 'Bola Karet', 'Plastisin', 'Kartu Uno'],
            'Kosmetik'         => ['Bedak Tabur', 'Lipstik Merah', 'Sabun Muka', 'Lotion Tangan', 'Shampo Sachet', 'Kondisioner', 'Parfum Mini', 'Deodorant'],
        ];

        $cat = $this->faker->randomElement($kategori);
        $nama = $this->faker->randomElement($produkByKategori[$cat]);

        return [
            'nama_produk' => $nama,
            'kategori'    => $cat,
            'stok'        => $this->faker->numberBetween(5, 150),
            'harga'       => $this->faker->randomElement([
                2500, 3000, 5000, 7500, 8000, 10000, 12000, 15000,
                18000, 20000, 25000, 30000, 35000, 40000, 50000,
                60000, 75000, 85000, 100000, 125000, 150000, 175000,
                200000, 250000, 300000, 350000, 400000, 500000,
            ]),
            'deskripsi'   => 'Produk ' . $nama . ' berkualitas tinggi, tersedia di Toko Mas Aimar. ' . $this->faker->sentence(8),
        ];
    }
}
