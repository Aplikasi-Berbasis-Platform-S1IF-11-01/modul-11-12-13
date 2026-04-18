<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Akun tetap Pak Cik (admin/owner) ──────────────────────────────────
        User::factory()->admin()->create([
            'name'     => 'Pak Cik',
            'email'    => 'pakcik@gmail.com',
            'password' => Hash::make('pakcik123'),
        ]);

        // ── Akun tetap Mas Aimar (admin/pemilik toko) ─────────────────────────
        User::factory()->admin()->create([
            'name'     => 'Mas Aimar',
            'email'    => 'aimar@gmail.com',
            'password' => Hash::make('aimar123'),
        ]);

        // ── Akun tetap Nuha (customer / pembeli) ────────────────────────
        User::factory()->customer()->create([
            'name'     => 'Boutefhika Nuha Z K',
            'email'    => 'bnzk@gmail.com',
            'password' => Hash::make('nuha123'),
        ]);

        // ── Customer acak tambahan ─────────────────────────────────────────────
        User::factory()->customer()->count(7)->create();

        // ── Produk acak (50 produk) ────────────────────────────────────────────
        Product::factory()->count(50)->create();

        $this->command->info('✅  Seeder selesai!');
        $this->command->table(
            ['Akun', 'Email', 'Password', 'Role'],
            [
                ['Pak Cik',    'pakcik@gmail.com', 'pakcik123',  'admin'],
                ['Mas Aimar',  'aimar@gmail.com',  'aimar123',   'admin'],
                ['Boutefhika Nuha Z K', 'bnzk@gmail.com', 'nuha123',  'customer'],
            ]
        );
    }
}
