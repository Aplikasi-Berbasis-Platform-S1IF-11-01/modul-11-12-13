<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Ini kunci izin masuk datanya
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok'
    ];
}