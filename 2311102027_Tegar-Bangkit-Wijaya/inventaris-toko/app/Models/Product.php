<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori',
        'deskripsi',
        'stok',
        'harga_beli',
        'harga_jual',
        'satuan',
        'status',
    ];

    protected $casts = [
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2',
        'stok'       => 'integer',
    ];

    // Accessor: format harga ke Rupiah
    public function getHargaBeliFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_beli, 0, ',', '.');
    }

    public function getHargaJualFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_jual, 0, ',', '.');
    }

    // Scope: filter by status
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope: search
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('nama_produk', 'like', "%{$keyword}%")
              ->orWhere('kode_produk', 'like', "%{$keyword}%")
              ->orWhere('kategori',   'like', "%{$keyword}%");
        });
    }
}
