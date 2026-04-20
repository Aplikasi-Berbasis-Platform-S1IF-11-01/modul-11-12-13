<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Hanya tampilkan produk yang stoknya di atas 0
        $query = Product::where('stock', '>', 0);

        // Fitur Search
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->latest()->paginate(12);
        return view('shop.index', compact('products'));
    }

    public function buy(Product $product)
    {
        if ($product->stock > 0) {
            // Kurangi stok 1 di database
            $product->decrement('stock');
            
            return back()->with('success', "Berhasil membeli {$product->name}! Stok otomatis berkurang.");
        }

        return back()->with('error', 'Maaf, stok barang sudah habis!');
    }
}