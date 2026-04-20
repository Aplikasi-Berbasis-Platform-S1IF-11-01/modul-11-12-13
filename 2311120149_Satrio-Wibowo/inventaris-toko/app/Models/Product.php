<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'price',
        'stock',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    // Scope: produk dengan stok kritis (< 10)
    public function scopeLowStock($query, int $threshold = 10)
    {
        return $query->where('stock', '<', $threshold);
    }

    // Accessor: format harga ke Rupiah
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Computed: total nilai stok
    public function getStockValueAttribute(): float
    {
        return $this->price * $this->stock;
    }
}