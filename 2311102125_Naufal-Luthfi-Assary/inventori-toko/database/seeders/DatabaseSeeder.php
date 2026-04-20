<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@toko.com'],
            [
                'name' => 'Admin Toko',
                'password' => Hash::make('password123'),
            ]
        );

        $products = [
            [
                'user_id' => $user->id,
                'nama_produk' => 'Beras Ramos 5Kg',
                'kategori' => 'Sembako',
                'harga' => 78000,
                'stok' => 12,
                'deskripsi' => 'Beras ramos kualitas premium ukuran 5 kilogram.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Minyak Goreng 1L',
                'kategori' => 'Sembako',
                'harga' => 18000,
                'stok' => 20,
                'deskripsi' => 'Minyak goreng kemasan 1 liter.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Gula Pasir 1Kg',
                'kategori' => 'Sembako',
                'harga' => 15000,
                'stok' => 15,
                'deskripsi' => 'Gula pasir putih kemasan 1 kilogram.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Indomie Goreng',
                'kategori' => 'Makanan',
                'harga' => 3500,
                'stok' => 50,
                'deskripsi' => 'Mi instan rasa ayam goreng.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Supermie Ayam Bawang',
                'kategori' => 'Makanan',
                'harga' => 3200,
                'stok' => 40,
                'deskripsi' => 'Mi instan rasa ayam bawang.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Teh Botol Sosro',
                'kategori' => 'Minuman',
                'harga' => 5000,
                'stok' => 25,
                'deskripsi' => 'Minuman teh siap minum botol.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Aqua 600ml',
                'kategori' => 'Minuman',
                'harga' => 3000,
                'stok' => 35,
                'deskripsi' => 'Air mineral kemasan botol 600ml.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Kopi Kapal Api',
                'kategori' => 'Minuman',
                'harga' => 2500,
                'stok' => 30,
                'deskripsi' => 'Kopi sachet siap seduh.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Sabun Lifebuoy',
                'kategori' => 'Kebutuhan Harian',
                'harga' => 4500,
                'stok' => 18,
                'deskripsi' => 'Sabun mandi batang Lifebuoy.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Pasta Gigi Pepsodent',
                'kategori' => 'Kebutuhan Harian',
                'harga' => 12000,
                'stok' => 10,
                'deskripsi' => 'Pasta gigi Pepsodent ukuran sedang.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Susu Dancow Sachet',
                'kategori' => 'Minuman',
                'harga' => 2500,
                'stok' => 22,
                'deskripsi' => 'Susu bubuk sachet rasa original.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Tepung Terigu 1Kg',
                'kategori' => 'Sembako',
                'harga' => 14000,
                'stok' => 14,
                'deskripsi' => 'Tepung terigu serbaguna kemasan 1 kilogram.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Telur Ayam 1Kg',
                'kategori' => 'Sembako',
                'harga' => 28000,
                'stok' => 9,
                'deskripsi' => 'Telur ayam negeri segar per kilogram.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Kecap Bango',
                'kategori' => 'Bumbu Dapur',
                'harga' => 22000,
                'stok' => 8,
                'deskripsi' => 'Kecap manis bango ukuran sedang.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Saus Sambal ABC',
                'kategori' => 'Bumbu Dapur',
                'harga' => 11000,
                'stok' => 11,
                'deskripsi' => 'Saus sambal botol ABC.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Garam Dapur',
                'kategori' => 'Bumbu Dapur',
                'harga' => 4000,
                'stok' => 17,
                'deskripsi' => 'Garam dapur halus kemasan.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Chitato Sapi Panggang',
                'kategori' => 'Snack',
                'harga' => 9000,
                'stok' => 19,
                'deskripsi' => 'Snack kentang rasa sapi panggang.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Wafer Tango',
                'kategori' => 'Snack',
                'harga' => 8500,
                'stok' => 16,
                'deskripsi' => 'Wafer renyah isi cokelat.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Biskuit Roma Kelapa',
                'kategori' => 'Snack',
                'harga' => 7000,
                'stok' => 13,
                'deskripsi' => 'Biskuit roma rasa kelapa.',
            ],
            [
                'user_id' => $user->id,
                'nama_produk' => 'Tisu Nice',
                'kategori' => 'Kebutuhan Harian',
                'harga' => 8000,
                'stok' => 12,
                'deskripsi' => 'Tisu wajah kemasan praktis.',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}