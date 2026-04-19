<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Menampilkan Dashboard
    public function index() {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // 2. Menampilkan Form Tambah Produk
    public function create() {
        return view('products.create');
    }

    // 3. Menyimpan Data Baru ke Database (SUDAH DIPERBAIKI)
    public function store(Request $request) {
        // Validasi inputan sekaligus menyaring data (_token tidak akan ikut)
        $validatedData = $request->validate([
            'nama_produk' => 'required',
            'deskripsi'   => 'nullable',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|numeric|min:0',
        ]);

        // Simpan data yang sudah divalidasi saja
        Product::create($validatedData);
        
        return redirect()->route('products.index')->with('success', 'Produk baru berhasil ditambahkan ke gudang!');
    }

    // 4. Menampilkan Form Edit
    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    // 5. Menyimpan Perubahan Data / Update (SUDAH DIPERBAIKI)
    public function update(Request $request, Product $product) {
        // Validasi inputan sekaligus menyaring data (_token dan _method tidak akan ikut)
        $validatedData = $request->validate([
            'nama_produk' => 'required',
            'deskripsi'   => 'nullable',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|numeric|min:0',
        ]);

        // Update dengan data yang sudah divalidasi saja
        $product->update($validatedData);
        
        return redirect()->route('products.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    // 6. Menghapus Data
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus dari sistem!');
    }
}