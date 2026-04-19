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
        // ── Admin default ────────────────────────────────────────────────
        User::create([
            'name'     => 'Admin Toko',
            'email'    => 'admin@toko.com',
            'password' => Hash::make('admin123'),
        ]);

        // ── Tambahan user dummy ──────────────────────────────────────────
        User::factory(4)->create();

        // ── 25 produk dummy ─────────────────────────────────────────────
        Product::factory(25)->create();

        $this->command->info('✅  Seeder selesai!');
        $this->command->info('   Login: admin@toko.com / admin123');
    }
}
