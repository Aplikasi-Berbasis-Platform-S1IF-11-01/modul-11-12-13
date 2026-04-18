<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Buat akun pengguna
        User::factory()->create([
            'name' => 'Mas Aimar',
            'email' => 'aimar@toko.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Jakobi',
            'email' => 'jakobi@toko.com',
            'password' => bcrypt('password'),
        ]);

        // Data buku pelajaran SMA
        $books = [
            ['name' => 'Matematika Wajib Kelas X', 'description' => 'Buku pelajaran Matematika Wajib untuk kelas X SMA, penerbit Erlangga.', 'price' => 85000, 'stock' => 42],
            ['name' => 'Matematika Wajib Kelas XI', 'description' => 'Buku pelajaran Matematika Wajib untuk kelas XI SMA, penerbit Erlangga.', 'price' => 87000, 'stock' => 35],
            ['name' => 'Matematika Wajib Kelas XII', 'description' => 'Buku pelajaran Matematika Wajib untuk kelas XII SMA, penerbit Erlangga.', 'price' => 89000, 'stock' => 28],
            ['name' => 'Fisika Kelas X SMA', 'description' => 'Buku Fisika untuk kelas X SMA, lengkap dengan latihan soal dan pembahasan.', 'price' => 90000, 'stock' => 50],
            ['name' => 'Fisika Kelas XI SMA', 'description' => 'Buku Fisika untuk kelas XI SMA, materi gelombang, optik, dan termodinamika.', 'price' => 92000, 'stock' => 30],
            ['name' => 'Fisika Kelas XII SMA', 'description' => 'Buku Fisika untuk kelas XII SMA, materi listrik, magnet, dan fisika modern.', 'price' => 94000, 'stock' => 22],
            ['name' => 'Kimia Kelas X SMA', 'description' => 'Buku Kimia untuk kelas X SMA, penerbit Intan Pariwara.', 'price' => 88000, 'stock' => 45],
            ['name' => 'Kimia Kelas XI SMA', 'description' => 'Buku Kimia untuk kelas XI SMA, materi laju reaksi, kesetimbangan kimia, dan asam basa.', 'price' => 90000, 'stock' => 38],
            ['name' => 'Kimia Kelas XII SMA', 'description' => 'Buku Kimia untuk kelas XII SMA, materi senyawa karbon dan polimer.', 'price' => 92000, 'stock' => 0],
            ['name' => 'Biologi Kelas X SMA', 'description' => 'Buku Biologi untuk kelas X SMA, penerbit Yudhistira.', 'price' => 85000, 'stock' => 60],
            ['name' => 'Biologi Kelas XI SMA', 'description' => 'Buku Biologi untuk kelas XI SMA, materi sistem organ manusia dan tumbuhan.', 'price' => 87000, 'stock' => 40],
            ['name' => 'Biologi Kelas XII SMA', 'description' => 'Buku Biologi untuk kelas XII SMA, materi genetika dan bioteknologi.', 'price' => 89000, 'stock' => 25],
            ['name' => 'Bahasa Indonesia Kelas X', 'description' => 'Buku Bahasa Indonesia untuk kelas X SMA, penerbit Kemdikbud.', 'price' => 72000, 'stock' => 55],
            ['name' => 'Bahasa Indonesia Kelas XI', 'description' => 'Buku Bahasa Indonesia untuk kelas XI SMA, dilengkapi teks fiksi dan nonfiksi.', 'price' => 74000, 'stock' => 48],
            ['name' => 'Bahasa Inggris Kelas X SMA', 'description' => 'Buku Bahasa Inggris untuk kelas X SMA, penerbit Cambridge.', 'price' => 95000, 'stock' => 33],
            ['name' => 'Bahasa Inggris Kelas XI SMA', 'description' => 'Buku Bahasa Inggris untuk kelas XI SMA, materi teks analytical dan report.', 'price' => 97000, 'stock' => 27],
            ['name' => 'Sejarah Indonesia Kelas X', 'description' => 'Buku Sejarah Indonesia untuk kelas X SMA, penerbit Kemdikbud.', 'price' => 68000, 'stock' => 40],
            ['name' => 'Ekonomi Kelas X SMA', 'description' => 'Buku Ekonomi untuk kelas X SMA, materi dasar ilmu ekonomi dan pelaku ekonomi.', 'price' => 80000, 'stock' => 35],
            ['name' => 'Sosiologi Kelas X SMA', 'description' => 'Buku Sosiologi untuk kelas X SMA, penerbit Erlangga.', 'price' => 78000, 'stock' => 0],
            ['name' => 'Geografi Kelas X SMA', 'description' => 'Buku Geografi untuk kelas X SMA, dilengkapi peta, atlas, dan latihan soal UN.', 'price' => 82000, 'stock' => 15],
        ];

        foreach ($books as $book) {
            Product::create($book);
        }
    }
}
