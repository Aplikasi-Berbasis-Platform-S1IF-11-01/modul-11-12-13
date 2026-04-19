<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Product
 *
 * Merepresentasikan tabel `products` di database.
 * Berisi definisi fillable fields dan beberapa helper method
 * untuk memudahkan tampilan data di view.
 *
 * @property int    $id
 * @property string $name
 * @property string $category
 * @property float  $price
 * @property int    $stock
 * @property string|null $description
 */
class Product extends Model
{
    use HasFactory;

    /**
     * Field yang boleh diisi secara massal (mass assignment).
     * Ini penting untuk keamanan - field di luar list ini tidak bisa diisi
     * melalui create() atau update() secara massal.
     */
    protected $fillable = [
        'name',
        'category',
        'price',
        'stock',
        'description',
    ];

    /**
     * Casting tipe data otomatis.
     * Memastikan tipe data sesuai saat diakses dari model.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * Format harga menjadi format Rupiah Indonesia.
     * Contoh: 15000 → "Rp 15.000"
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Tentukan status stok produk.
     * - "Habis" : stok = 0
     * - "Menipis" : stok < 10
     * - "Tersedia" : stok >= 10
     */
    public function getStockStatusAttribute(): string
    {
        if ($this->stock === 0) {
            return 'Habis';
        } elseif ($this->stock < 10) {
            return 'Menipis';
        }
        return 'Tersedia';
    }

    /**
     * Warna badge Bootstrap untuk status stok.
     */
    public function getStockBadgeClassAttribute(): string
    {
        return match($this->stock_status) {
            'Habis'    => 'danger',
            'Menipis'  => 'warning',
            default    => 'success',
        };
    }
}