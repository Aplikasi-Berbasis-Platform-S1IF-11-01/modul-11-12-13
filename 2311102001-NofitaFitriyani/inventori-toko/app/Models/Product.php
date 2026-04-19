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
        'sku',
        'price',
        'buying_price',
        'stock',
        'unit',
        'description',
        'image',
        'status',
    ];

    protected $casts = [
        'price'        => 'decimal:2',
        'buying_price' => 'decimal:2',
        'stock'        => 'integer',
    ];

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) return 'Habis';
        if ($this->stock <= 10) return 'Menipis';
        return 'Tersedia';
    }

    public function getStockBadgeClassAttribute(): string
    {
        if ($this->stock <= 0) return 'badge-danger';
        if ($this->stock <= 10) return 'badge-warning';
        return 'badge-success';
    }
}
