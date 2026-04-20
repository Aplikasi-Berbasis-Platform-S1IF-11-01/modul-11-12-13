<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun pemilik toko - Andreas
        User::create([
            'name' => 'Andreas',
            'email' => 'andreas@toko.com',
            'password' => Hash::make('password123'),
        ]);

        // Akun pemilik toko - Viani
        User::create([
            'name' => 'Viani',
            'email' => 'viani@toko.com',
            'password' => Hash::make('password123'),
        ]);

        // Akun admin umum
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@toko.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}