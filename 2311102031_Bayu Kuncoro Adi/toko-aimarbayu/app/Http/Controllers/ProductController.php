<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan halaman utama (Datatable)
    public function index()
    {
        // Ambil data produk terbaru, dibatasi 10 per halaman
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    // Menampilkan form tambah barang
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan barang baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable'
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Mantap! Barang baru Mas Aimar berhasil masuk gudang!');
    }

    // Menampilkan form edit barang
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Menyimpan perubahan edit barang
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable'
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Update berhasil! Data barang sudah valid.');
    }

    // Menghapus barang (dengan modal konfirmasi nanti di View)
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Barang berhasil dihapus dari sistem!');
    }
}