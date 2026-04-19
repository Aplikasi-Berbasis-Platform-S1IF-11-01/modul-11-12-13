<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
    $products = Product::latest()->get();
    $categories = ['Atasan', 'Bawahan', 'Dress', 'Hijab', 'Aksesoris'];
    return view('products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string',
            'price'    => 'required|integer|min:1',
        ]);

        Product::create($request->only('name', 'category', 'price'));
        return redirect()->route('products.index')->with('success', '✓ Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string',
            'price'    => 'required|integer|min:1',
        ]);

        $product->update($request->only('name', 'category', 'price'));
        return redirect()->route('products.index')->with('success', '✓ Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', '✓ Produk berhasil dihapus');
    }
}