<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama sebelum seed ulang
        Product::truncate();

        Product::factory()->count(15)->create();
    }
}