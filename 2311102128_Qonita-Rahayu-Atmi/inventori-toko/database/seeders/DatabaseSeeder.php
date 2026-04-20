<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat akun user default
        User::firstOrCreate(
            ['email' => 'admin@toko.com'],
            [
                'name'     => 'Admin Toko',
                'password' => Hash::make('password123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'aimar@toko.com'],
            [
                'name'     => 'Mas Aimar',
                'password' => Hash::make('password123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'jakobi@toko.com'],
            [
                'name'     => 'Mas Jakobi',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Buat kategori
        $kategoris = [
            ['nama' => 'Makanan',          'kode' => 'MKN', 'deskripsi' => 'Produk makanan pokok dan olahan untuk kebutuhan sehari-hari.'],
            ['nama' => 'Minuman',          'kode' => 'MNM', 'deskripsi' => 'Berbagai minuman segar, baik kemasan maupun curah.'],
            ['nama' => 'Snack & Camilan',  'kode' => 'SNK', 'deskripsi' => 'Aneka camilan dan makanan ringan untuk semua usia.'],
            ['nama' => 'Kebutuhan Rumah',  'kode' => 'KBR', 'deskripsi' => 'Produk untuk kebersihan dan keperluan rumah tangga.'],
            ['nama' => 'Perawatan Diri',   'kode' => 'PRD', 'deskripsi' => 'Produk kecantikan dan perawatan tubuh sehari-hari.'],
            ['nama' => 'Alat Tulis',       'kode' => 'ALT', 'deskripsi' => 'Perlengkapan alat tulis kantor dan sekolah.'],
        ];

        foreach ($kategoris as $k) {
            Kategori::firstOrCreate(['kode' => $k['kode']], $k);
        }

        // 3. Buat produk dengan data tetap + 25 produk random factory
        $fixedProduk = [
            ['nama' => 'Beras Premium 5kg',       'kode' => 'MKN-001', 'harga' => 72000, 'stok' => 150, 'satuan' => 'karung',  'kategori' => 'MKN', 'status' => 'aktif'],
            ['nama' => 'Minyak Goreng Bimoli 2L',  'kode' => 'MKN-002', 'harga' => 38000, 'stok' => 80,  'satuan' => 'botol',   'kategori' => 'MKN', 'status' => 'aktif'],
            ['nama' => 'Gula Pasir 1kg',           'kode' => 'MKN-003', 'harga' => 17000, 'stok' => 200, 'satuan' => 'kg',      'kategori' => 'MKN', 'status' => 'aktif'],
            ['nama' => 'Mie Goreng Instan',        'kode' => 'MKN-004', 'harga' => 3500,  'stok' => 500, 'satuan' => 'bungkus', 'kategori' => 'MKN', 'status' => 'aktif'],
            ['nama' => 'Telur Ayam 1kg',           'kode' => 'MKN-005', 'harga' => 28000, 'stok' => 100, 'satuan' => 'kg',      'kategori' => 'MKN', 'status' => 'aktif'],
            ['nama' => 'Air Mineral Aqua 600ml',   'kode' => 'MNM-001', 'harga' => 4000,  'stok' => 300, 'satuan' => 'botol',   'kategori' => 'MNM', 'status' => 'aktif'],
            ['nama' => 'Teh Kotak 200ml',          'kode' => 'MNM-002', 'harga' => 4500,  'stok' => 250, 'satuan' => 'kotak',   'kategori' => 'MNM', 'status' => 'aktif'],
            ['nama' => 'Kopi Kapal Api Sachet',    'kode' => 'MNM-003', 'harga' => 2500,  'stok' => 400, 'satuan' => 'bungkus', 'kategori' => 'MNM', 'status' => 'aktif'],
            ['nama' => 'Susu UHT Ultra 1L',        'kode' => 'MNM-004', 'harga' => 18000, 'stok' => 120, 'satuan' => 'liter',   'kategori' => 'MNM', 'status' => 'aktif'],
            ['nama' => 'Keripik Singkong 200g',    'kode' => 'SNK-001', 'harga' => 12000, 'stok' => 90,  'satuan' => 'bungkus', 'kategori' => 'SNK', 'status' => 'aktif'],
            ['nama' => 'Biskuit Roma 250g',        'kode' => 'SNK-002', 'harga' => 15000, 'stok' => 75,  'satuan' => 'kotak',   'kategori' => 'SNK', 'status' => 'aktif'],
            ['nama' => 'Wafer Tango Coklat',       'kode' => 'SNK-003', 'harga' => 8000,  'stok' => 110, 'satuan' => 'bungkus', 'kategori' => 'SNK', 'status' => 'aktif'],
            ['nama' => 'Sabun Cuci Piring 500ml',  'kode' => 'KBR-001', 'harga' => 14000, 'stok' => 60,  'satuan' => 'botol',   'kategori' => 'KBR', 'status' => 'aktif'],
            ['nama' => 'Detergen Rinso 1kg',       'kode' => 'KBR-002', 'harga' => 22000, 'stok' => 40,  'satuan' => 'kg',      'kategori' => 'KBR', 'status' => 'aktif'],
            ['nama' => 'Tisu Wajah Paseo 50lbr',  'kode' => 'KBR-003', 'harga' => 8500,  'stok' => 130, 'satuan' => 'kotak',   'kategori' => 'KBR', 'status' => 'aktif'],
            ['nama' => 'Sabun Lifebuoy Batang',    'kode' => 'PRD-001', 'harga' => 6500,  'stok' => 200, 'satuan' => 'batang',  'kategori' => 'PRD', 'status' => 'aktif'],
            ['nama' => 'Sampo Clear 340ml',        'kode' => 'PRD-002', 'harga' => 28000, 'stok' => 50,  'satuan' => 'botol',   'kategori' => 'PRD', 'status' => 'aktif'],
            ['nama' => 'Pasta Gigi Pepsodent 120g','kode' => 'PRD-003', 'harga' => 12000, 'stok' => 180, 'satuan' => 'tube',    'kategori' => 'PRD', 'status' => 'aktif'],
            ['nama' => 'Pulpen Ballpoint Pilot',   'kode' => 'ALT-001', 'harga' => 5000,  'stok' => 300, 'satuan' => 'buah',    'kategori' => 'ALT', 'status' => 'aktif'],
            ['nama' => 'Buku Tulis 58 lembar',     'kode' => 'ALT-002', 'harga' => 9000,  'stok' => 250, 'satuan' => 'buah',    'kategori' => 'ALT', 'status' => 'aktif'],
            ['nama' => 'Penghapus Steadtler',      'kode' => 'ALT-003', 'harga' => 4000,  'stok' => 150, 'satuan' => 'buah',    'kategori' => 'ALT', 'status' => 'aktif'],
            ['nama' => 'Penggaris 30cm',           'kode' => 'ALT-004', 'harga' => 7000,  'stok' => 80,  'satuan' => 'buah',    'kategori' => 'ALT', 'status' => 'aktif'],
            ['nama' => 'Stabilo Boss Warna',       'kode' => 'ALT-005', 'harga' => 12000, 'stok' => 100, 'satuan' => 'buah',    'kategori' => 'ALT', 'status' => 'aktif'],
            ['nama' => 'Tali Rafia 100m',          'kode' => 'KBR-004', 'harga' => 11000, 'stok' => 45,  'satuan' => 'gulung',  'kategori' => 'KBR', 'status' => 'nonaktif'],
            ['nama' => 'Kecap Manis ABC 135ml',    'kode' => 'MKN-006', 'harga' => 9500,  'stok' => 0,   'satuan' => 'botol',   'kategori' => 'MKN', 'status' => 'nonaktif'],
        ];

        foreach ($fixedProduk as $p) {
            $kategori = Kategori::where('kode', $p['kategori'])->first();
            if ($kategori) {
                Produk::firstOrCreate(
                    ['kode' => $p['kode']],
                    [
                        'nama'        => $p['nama'],
                        'deskripsi'   => 'Produk unggulan toko Pak Cik & Mas Aimar, kualitas terjamin harga bersahabat.',
                        'harga'       => $p['harga'],
                        'stok'        => $p['stok'],
                        'satuan'      => $p['satuan'],
                        'kategori_id' => $kategori->id,
                        'status'      => $p['status'],
                    ]
                );
            }
        }
    }
}
