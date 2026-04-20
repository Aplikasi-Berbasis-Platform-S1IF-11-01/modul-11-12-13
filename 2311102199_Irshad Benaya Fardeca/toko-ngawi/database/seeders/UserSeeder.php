<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Pak Cik (pemilik toko)
        User::create([
            'name'     => 'Pak Cik',
            'email'    => 'pakcik@toko.com',
            'password' => Hash::make('pakcik123'),
        ]);

        // Akun Mas Aimar (pemilik toko)
        User::create([
            'name'     => 'Mas Aimar',
            'email'    => 'aimar@toko.com',
            'password' => Hash::make('aimar123'),
        ]);

        $this->command->info('✅ User berhasil di-seed!');
        $this->command->table(
            ['Nama', 'Email', 'Password'],
            [
                ['Pak Cik', 'pakcik@toko.com', 'pakcik123'],
                ['Mas Aimar', 'aimar@toko.com', 'aimar123'],
            ]
        );
    }
}