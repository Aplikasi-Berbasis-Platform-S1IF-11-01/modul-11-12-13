<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@toko.com'],
            [
                'name'     => 'Admin Toko',
                'email'    => 'admin@toko.com',
                'password' => Hash::make('password'),
            ]
        );
    }
}