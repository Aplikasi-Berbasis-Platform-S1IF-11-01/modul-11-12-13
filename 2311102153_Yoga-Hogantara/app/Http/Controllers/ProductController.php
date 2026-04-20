<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Daftar semua produk (dengan search & pagination)
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        return view('products.index', compact('products', 'search'));
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ], [
            'name.required'  => 'Nama produk wajib diisi.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric'  => 'Harga harus berupa angka.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer'  => 'Stok harus berupa angka bulat.',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Produk "' . $validated['name'] . '" berhasil ditambahkan! ✅');
    }

    /**
     * Form edit produk
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Produk "' . $product->name . '" berhasil diperbarui! ✏️');
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Produk "' . $name . '" berhasil dihapus! 🗑️');
    }
}