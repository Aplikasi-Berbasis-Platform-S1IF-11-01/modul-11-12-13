<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tampilkan semua produk
    public function index()
    {
        $products      = Product::latest()->get();
        $totalProducts = $products->count();
        $totalStock    = $products->sum('stock');
        $lowStock      = $products->where('stock', '<=', 10)->count();

        return view('products.index', compact('products', 'totalProducts', 'totalStock', 'lowStock'));
    }

    // Form tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'unit'        => 'required|string|max:50',
        ], [
            'name.required'     => 'Nama produk wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'price.required'    => 'Harga wajib diisi.',
            'price.numeric'     => 'Harga harus berupa angka.',
            'stock.required'    => 'Stok wajib diisi.',
            'stock.integer'     => 'Stok harus berupa angka bulat.',
            'unit.required'     => 'Satuan wajib dipilih.',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $request->name . '" berhasil ditambahkan!');
    }

    // Form edit produk
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'unit'        => 'required|string|max:50',
        ], [
            'name.required'     => 'Nama produk wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'price.required'    => 'Harga wajib diisi.',
            'price.numeric'     => 'Harga harus berupa angka.',
            'stock.required'    => 'Stok wajib diisi.',
            'stock.integer'     => 'Stok harus berupa angka bulat.',
            'unit.required'     => 'Satuan wajib dipilih.',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $product->name . '" berhasil diperbarui!');
    }

    // Hapus produk
    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $name . '" berhasil dihapus!');
    }
}