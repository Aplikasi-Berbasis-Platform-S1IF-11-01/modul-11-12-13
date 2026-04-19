<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambah! 🌸');
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate! ✨');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus! 🗑️');
    }
}
