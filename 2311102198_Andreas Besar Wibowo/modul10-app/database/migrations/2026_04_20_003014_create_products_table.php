<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique()->comment('Kode unik produk');
            $table->string('name', 150)->comment('Nama produk');
            $table->string('category', 100)->comment('Kategori produk');
            $table->string('unit', 20)->comment('Satuan: pcs, kg, liter, dll');
            $table->decimal('buy_price', 15, 2)->default(0)->comment('Harga beli dari supplier');
            $table->decimal('sell_price', 15, 2)->default(0)->comment('Harga jual ke pelanggan');
            $table->integer('stock')->default(0)->comment('Jumlah stok saat ini');
            $table->integer('min_stock')->default(0)->comment('Batas minimum stok (untuk alert)');
            $table->text('description')->nullable()->comment('Deskripsi produk');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};