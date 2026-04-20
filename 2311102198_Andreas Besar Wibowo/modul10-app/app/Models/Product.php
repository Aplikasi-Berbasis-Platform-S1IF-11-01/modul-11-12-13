<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'category',
        'unit',
        'buy_price',
        'sell_price',
        'stock',
        'min_stock',
        'description',
    ];

    protected $casts = [
        'buy_price' => 'float:2',
        'sell_price' => 'float:2',
        'stock' => 'integer',
        'min_stock' => 'integer',
    ];

    /**
     * Cek apakah stok di bawah minimum
     */
    public function isLowStock(): bool
    {
        return $this->stock <= $this->min_stock;
    }

    /**
     * Format harga beli ke Rupiah
     */
    public function getBuyPriceFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->buy_price, 0, ',', '.');
    }

    /**
     * Format harga jual ke Rupiah
     */
    public function getSellPriceFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->sell_price, 0, ',', '.');
    }

    /**
     * Hitung margin keuntungan
     */
    public function getMarginAttribute(): float
    {
        if ($this->buy_price == 0)
            return 0;
        return round((($this->sell_price - $this->buy_price) / $this->buy_price) * 100, 1);
    }
}