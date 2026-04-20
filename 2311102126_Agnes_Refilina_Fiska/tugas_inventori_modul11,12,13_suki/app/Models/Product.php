<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Ini sangat penting agar data dari form atau seeder bisa masuk
    protected $fillable = ['nama_produk', 'kategori', 'harga', 'stok'];
}