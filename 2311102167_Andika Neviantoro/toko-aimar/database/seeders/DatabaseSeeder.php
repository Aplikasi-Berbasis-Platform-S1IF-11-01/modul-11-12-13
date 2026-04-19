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
            'email'    => 'pakcik@tokoaimar.com',
            'password' => Hash::make('pakcik123'),
        ]);

        // ── Akun tetap Mas Aimar (admin/pemilik toko) ─────────────────────────
        User::factory()->admin()->create([
            'name'     => 'Mas Aimar',
            'email'    => 'aimar@tokoaimar.com',
            'password' => Hash::make('aimar123'),
        ]);

        // ── Akun tetap Mas Jakobi (customer / pembeli) ────────────────────────
        User::factory()->customer()->create([
            'name'     => 'Mas Jakobi',
            'email'    => 'jakobi@gmail.com',
            'password' => Hash::make('jakobi123'),
        ]);

        // ── Customer acak tambahan ─────────────────────────────────────────────
        User::factory()->customer()->count(7)->create();

        // ── Produk acak (50 produk) ────────────────────────────────────────────
        Product::factory()->count(50)->create();

        $this->command->info('✅  Seeder selesai!');
        $this->command->table(
            ['Akun', 'Email', 'Password', 'Role'],
            [
                ['Pak Cik',    'pakcik@tokoaimar.com', 'pakcik123',  'admin'],
                ['Mas Aimar',  'aimar@tokoaimar.com',  'aimar123',   'admin'],
                ['Mas Jakobi', 'jakobi@gmail.com',     'jakobi123',  'customer'],
            ]
        );
    }
}
