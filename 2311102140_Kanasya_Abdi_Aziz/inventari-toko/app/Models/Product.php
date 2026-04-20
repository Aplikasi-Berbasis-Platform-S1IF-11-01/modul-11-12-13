<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'stock',
        'unit',
    ];

    // Format harga ke Rupiah
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Status stok
    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) return 'Habis';
        if ($this->stock <= 10) return 'Menipis';
        return 'Tersedia';
    }

    public function getStockBadgeAttribute(): string
    {
        if ($this->stock <= 0) return 'danger';
        if ($this->stock <= 10) return 'warning';
        return 'success';
    }
}