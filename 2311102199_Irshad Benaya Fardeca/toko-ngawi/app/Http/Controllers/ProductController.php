<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Daftar semua produk (DataTable view)
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Pencarian
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter kategori
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Sorting
        $sortBy  = $request->query('sort', 'created_at');
        $sortDir = $request->query('direction', 'desc');
        $allowedSorts = ['name', 'category', 'price', 'stock', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir === 'asc' ? 'asc' : 'desc');
        }

        $products   = $query->paginate(10)->withQueryString();
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Form tambah produk baru
     */
    public function create()
    {
        $categories = Product::select('category')->distinct()->pluck('category');
        return view('products.create', compact('categories'));
    }

    /**
     * Simpan produk baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'max:100'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
            'unit'        => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
        ], [
            'name.required'     => 'Nama produk wajib diisi.',
            'category.required' => 'Kategori wajib diisi.',
            'price.required'    => 'Harga wajib diisi.',
            'price.numeric'     => 'Harga harus berupa angka.',
            'price.min'         => 'Harga tidak boleh negatif.',
            'stock.required'    => 'Stok wajib diisi.',
            'stock.integer'     => 'Stok harus berupa bilangan bulat.',
            'stock.min'         => 'Stok tidak boleh negatif.',
            'unit.required'     => 'Satuan wajib diisi.',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $validated['name'] . '" berhasil ditambahkan! 🎉');
    }

    /**
     * Detail produk (opsional)
     */
    public function show(Product $product) {}

    /**
     * Form edit produk
     */
    public function edit(Product $product)
    {
        $categories = Product::select('category')->distinct()->pluck('category');
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk di database
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'max:100'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
            'unit'        => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
        ], [
            'name.required'     => 'Nama produk wajib diisi.',
            'category.required' => 'Kategori wajib diisi.',
            'price.required'    => 'Harga wajib diisi.',
            'price.numeric'     => 'Harga harus berupa angka.',
            'price.min'         => 'Harga tidak boleh negatif.',
            'stock.required'    => 'Stok wajib diisi.',
            'stock.integer'     => 'Stok harus berupa bilangan bulat.',
            'stock.min'         => 'Stok tidak boleh negatif.',
            'unit.required'     => 'Satuan wajib diisi.',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $product->name . '" berhasil diperbarui! ✅');
    }

    /**
     * Hapus produk dari database
     */
    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $name . '" berhasil dihapus! 🗑️');
    }
}
