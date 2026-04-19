<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Buat tabel products
 *
 * Tabel ini menyimpan semua data produk toko Pak Cik & Mas Aimar.
 * Kolom yang tersedia:
 * - name        : Nama produk (wajib)
 * - category    : Kategori produk seperti Makanan, Minuman, dll (wajib)
 * - price       : Harga satuan dalam Rupiah (wajib)
 * - stock       : Jumlah stok yang tersedia (wajib, default 0)
 * - description : Deskripsi tambahan produk (opsional)
 */
return new class extends Migration
{
    /**
     * Jalankan migration (buat tabel).
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                                      // Primary key auto increment
            $table->string('name');                            // Nama produk
            $table->string('category', 100);                  // Kategori produk
            $table->decimal('price', 10, 2);                  // Harga (max 99.999.999,99)
            $table->integer('stock')->default(0);             // Jumlah stok
            $table->text('description')->nullable();          // Deskripsi (boleh kosong)
            $table->timestamps();                             // created_at & updated_at
        });
    }

    /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};