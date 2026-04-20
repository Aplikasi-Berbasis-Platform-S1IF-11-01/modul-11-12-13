<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('inventory.index', compact('products'));
    }

    public function store(Request $request) {
        Product::create($request->all());
        return redirect()->back()->with('success', 'Produk berhasil ditambah!');
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->back()->with('success', 'Produk berhasil diubah!');
    }

    public function destroy($id) {
        Product::destroy($id);
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}