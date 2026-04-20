<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        
        Product::create($data);
        return back()->with('success', 'Barang Mas Aimar berhasil ditambah!');
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        
        $product->update($data);
        return back()->with('success', 'Data stok sudah diperbarui!');
    }

    public function destroy(Product $product) {
        $product->delete();
        return back()->with('success', 'Barang berhasil dihapus!');
    }
}
