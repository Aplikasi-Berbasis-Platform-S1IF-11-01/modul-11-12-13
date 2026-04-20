<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * UserSeeder
 *
 * Membuat akun admin default untuk login ke aplikasi inventaris.
 * Jalankan dengan: php artisan db:seed --class=UserSeeder
 *
 * Akun yang dibuat:
 * - Email    : admin@toko.com
 * - Password : password
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah admin sudah ada, kalau belum baru buat
        // Ini mencegah duplikasi kalau seeder dijalankan berkali-kali
        User::firstOrCreate(
            ['email' => 'admin@toko.com'],
            [
                'name'     => 'Admin Toko',
                'password' => Hash::make('password'),
            ]
        );

        // Opsional: buat beberapa user tambahan untuk testing
        User::firstOrCreate(
            ['email' => 'pakcik@toko.com'],
            [
                'name'     => 'Pak Cik',
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'aimar@toko.com'],
            [
                'name'     => 'Mas Aimar',
                'password' => Hash::make('password'),
            ]
        );

        $this->command->info('✅ User seeder berhasil dijalankan!');
        $this->command->table(
            ['Nama', 'Email', 'Password'],
            [
                ['Admin Toko', 'admin@toko.com', 'password'],
                ['Pak Cik',    'pakcik@toko.com', 'password'],
                ['Mas Aimar',  'aimar@toko.com',  'password'],
            ]
        );
    }
}