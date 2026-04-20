<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tokosuki.com'],
            [
                'name'     => 'Admin Toko Suki',
                'email'    => 'admin@tokosuki.com',
                'password' => Hash::make('password123'),
            ]
        );
    }
}