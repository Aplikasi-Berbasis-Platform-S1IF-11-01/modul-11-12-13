<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    private static int $counter = 1;

    private array $kategoriList = [
        'Elektronik', 'Makanan & Minuman', 'Pakaian', 'Peralatan Rumah',
        'Kesehatan & Kecantikan', 'Olahraga', 'Mainan', 'Otomotif',
        'Alat Tulis', 'Pertanian',
    ];

    private array $satuanList = ['pcs', 'kg', 'liter', 'dus', 'lusin', 'pack', 'meter', 'roll'];

    private array $produkList = [
        ['nama' => 'Smartphone Samsung Galaxy A54', 'kategori' => 'Elektronik'],
        ['nama' => 'Laptop Asus VivoBook 14',       'kategori' => 'Elektronik'],
        ['nama' => 'Headset Sony WH-1000XM5',       'kategori' => 'Elektronik'],
        ['nama' => 'Beras Premium 5kg',              'kategori' => 'Makanan & Minuman'],
        ['nama' => 'Minyak Goreng 2 Liter',          'kategori' => 'Makanan & Minuman'],
        ['nama' => 'Kaos Polo Pria',                 'kategori' => 'Pakaian'],
        ['nama' => 'Celana Jeans Wanita',            'kategori' => 'Pakaian'],
        ['nama' => 'Wajan Anti Lengket 30cm',        'kategori' => 'Peralatan Rumah'],
        ['nama' => 'Blender Philips 2L',             'kategori' => 'Peralatan Rumah'],
        ['nama' => 'Vitamin C 1000mg',               'kategori' => 'Kesehatan & Kecantikan'],
        ['nama' => 'Masker Wajah Clay',              'kategori' => 'Kesehatan & Kecantikan'],
        ['nama' => 'Sepatu Lari Nike Air Max',       'kategori' => 'Olahraga'],
        ['nama' => 'Raket Badminton Yonex',          'kategori' => 'Olahraga'],
        ['nama' => 'LEGO Technic Set',               'kategori' => 'Mainan'],
        ['nama' => 'Action Figure Gundam',           'kategori' => 'Mainan'],
        ['nama' => 'Oli Mesin Castrol 1L',           'kategori' => 'Otomotif'],
        ['nama' => 'Ban Mobil Bridgestone 185/65',   'kategori' => 'Otomotif'],
        ['nama' => 'Pulpen Pilot G-2 (Lusin)',       'kategori' => 'Alat Tulis'],
        ['nama' => 'Buku Tulis 100 Lembar',         'kategori' => 'Alat Tulis'],
        ['nama' => 'Pupuk Urea 50kg',               'kategori' => 'Pertanian'],
        ['nama' => 'Pestisida Roundup 1L',          'kategori' => 'Pertanian'],
        ['nama' => 'Teh Botol Sosro Dus',           'kategori' => 'Makanan & Minuman'],
        ['nama' => 'Susu UHT Ultra 1L',             'kategori' => 'Makanan & Minuman'],
        ['nama' => 'Kipas Angin Panasonic',         'kategori' => 'Elektronik'],
        ['nama' => 'Charger PD 65W',                'kategori' => 'Elektronik'],
    ];

    public function definition(): array
    {
        $idx     = (self::$counter - 1) % count($this->produkList);
        $produk  = $this->produkList[$idx];
        $hargaBeli = $this->faker->numberBetween(5000, 5000000);
        $margin    = $this->faker->randomFloat(2, 0.05, 0.30);

        $kode = 'PRD-' . str_pad(self::$counter, 4, '0', STR_PAD_LEFT);
        self::$counter++;

        return [
            'kode_produk'  => $kode,
            'nama_produk'  => $produk['nama'],
            'kategori'     => $produk['kategori'],
            'deskripsi'    => $this->faker->sentence(10),
            'stok'         => $this->faker->numberBetween(0, 500),
            'harga_beli'   => $hargaBeli,
            'harga_jual'   => round($hargaBeli * (1 + $margin), -2),
            'satuan'       => $this->faker->randomElement($this->satuanList),
            'status'       => $this->faker->randomElement(['aktif', 'aktif', 'aktif', 'nonaktif']),
        ];
    }
}
