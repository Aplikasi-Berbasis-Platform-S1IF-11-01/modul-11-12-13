<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * DatabaseSeeder
 *
 * Seeder utama yang mengorkestrasi semua seeder lainnya.
 * Jalankan dengan: php artisan db:seed
 *
 * Urutan seeding penting! User harus dibuat sebelum data
 * yang mungkin punya relasi ke user (meski di project ini belum ada relasi).
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌱 Memulai proses seeding database...');
        $this->command->newLine();

        // 1. Buat user (akun login)
        $this->call(UserSeeder::class);

        $this->command->newLine();

        // 2. Buat data produk
        $this->call(ProductSeeder::class);

        $this->command->newLine();
        $this->command->info('🎉 Semua seeder berhasil dijalankan!');
        $this->command->info('   Login dengan: admin@toko.com / password');
    }
}