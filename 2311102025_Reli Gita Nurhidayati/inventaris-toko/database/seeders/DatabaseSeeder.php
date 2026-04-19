<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::factory()->create([
            'name'     => 'Admin Toko',
            'email'    => 'admin@toko.com',
            'password' => bcrypt('password123'),
        ]);

        // Buat akun mas aimar buat login juga
        User::factory()->create([
            'name'     => 'Mas Aimar',
            'email'    => 'aimar@toko.com',
            'password' => bcrypt('password123'),
        ]);

        // Generate 25 produk dummy
        Product::factory(25)->create();

        $this->command->info('✅ Seeder selesai! 25 produk + 2 akun berhasil dibuat.');
        $this->command->info('   Login: admin@toko.com / password123');
        $this->command->info('   Login: aimar@toko.com  / password123');
    }
}
