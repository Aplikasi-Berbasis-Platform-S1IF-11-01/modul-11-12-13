<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk (DataTable)
     */
    public function index(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $category  = $request->get('category', '');

        $query = Product::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        $products   = $query->latest()->paginate($perPage)->withQueryString();
        $categories = Product::distinct()->pluck('category')->sort()->values();

        return view('products.index', compact('products', 'search', 'category', 'categories', 'perPage'));
    }

    /**
     * Tampilkan form tambah produk
     */
    public function create()
    {
        $categories = Product::distinct()->pluck('category')->sort()->values();
        return view('products.create', compact('categories'));
    }

    /**
     * Simpan produk baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:50|unique:products,code',
            'name'        => 'required|string|max:150',
            'category'    => 'required|string|max:100',
            'unit'        => 'required|string|max:20',
            'buy_price'   => 'required|numeric|min:0',
            'sell_price'  => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'min_stock'   => 'required|integer|min:0',
            'description' => 'nullable|string|max:500',
        ], [
            'code.required'       => 'Kode produk wajib diisi.',
            'code.unique'         => 'Kode produk sudah digunakan.',
            'name.required'       => 'Nama produk wajib diisi.',
            'category.required'   => 'Kategori wajib dipilih.',
            'unit.required'       => 'Satuan wajib diisi.',
            'buy_price.required'  => 'Harga beli wajib diisi.',
            'sell_price.required' => 'Harga jual wajib diisi.',
            'stock.required'      => 'Stok wajib diisi.',
            'min_stock.required'  => 'Stok minimum wajib diisi.',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $validated['name'] . '" berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail produk (opsional, redirect ke edit)
     */
    public function show(Product $product)
    {
        return redirect()->route('products.edit', $product);
    }

    /**
     * Tampilkan form edit produk
     */
    public function edit(Product $product)
    {
        $categories = Product::distinct()->pluck('category')->sort()->values();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk di database
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:50|unique:products,code,' . $product->id,
            'name'        => 'required|string|max:150',
            'category'    => 'required|string|max:100',
            'unit'        => 'required|string|max:20',
            'buy_price'   => 'required|numeric|min:0',
            'sell_price'  => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'min_stock'   => 'required|integer|min:0',
            'description' => 'nullable|string|max:500',
        ], [
            'code.required'       => 'Kode produk wajib diisi.',
            'code.unique'         => 'Kode produk sudah digunakan.',
            'name.required'       => 'Nama produk wajib diisi.',
            'category.required'   => 'Kategori wajib dipilih.',
            'unit.required'       => 'Satuan wajib diisi.',
            'buy_price.required'  => 'Harga beli wajib diisi.',
            'sell_price.required' => 'Harga jual wajib diisi.',
            'stock.required'      => 'Stok wajib diisi.',
            'min_stock.required'  => 'Stok minimum wajib diisi.',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $product->name . '" berhasil diperbarui!');
    }

    /**
     * Hapus produk dari database
     */
    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $name . '" berhasil dihapus.');
    }
}