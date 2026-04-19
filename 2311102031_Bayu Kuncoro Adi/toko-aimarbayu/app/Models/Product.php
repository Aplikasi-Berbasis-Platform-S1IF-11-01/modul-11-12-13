<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tambahkan baris ini biar form form-nya diizinkan masuk ke database
    protected $fillable = [
        'nama_produk',
        'stok',
        'harga',
        'deskripsi',
    ];
}