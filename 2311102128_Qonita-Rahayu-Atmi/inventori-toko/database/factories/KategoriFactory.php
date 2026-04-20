<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFactory extends Factory
{
    protected $model = Kategori::class;

    public function definition(): array
    {
        static $index = 0;
        $data = [
            ['nama' => 'Makanan', 'kode' => 'MKN'],
            ['nama' => 'Minuman', 'kode' => 'MNM'],
            ['nama' => 'Snack', 'kode' => 'SNK'],
            ['nama' => 'Kebutuhan Rumah', 'kode' => 'KBR'],
            ['nama' => 'Perawatan Diri', 'kode' => 'PRD'],
            ['nama' => 'Alat Tulis', 'kode' => 'ALT'],
        ];

        $item = $data[$index % count($data)];
        $index++;

        return [
            'nama'      => $item['nama'],
            'kode'      => $item['kode'],
            'deskripsi' => $this->faker->sentence(8),
        ];
    }
}
