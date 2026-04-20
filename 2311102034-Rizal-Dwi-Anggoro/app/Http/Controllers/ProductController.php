<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * ProductController
 *
 * Mengelola operasi CRUD (Create, Read, Update, Delete) untuk produk.
 * Setiap method sudah dilengkapi validasi input dan flash message
 * untuk memberikan feedback ke user.
 */
class ProductController extends Controller
{
    /**
     * INDEX - Tampilkan daftar semua produk.
     *
     * Data ditampilkan dalam DataTable agar bisa dicari,
     * diurutkan, dan di-paginate secara interaktif.
     */
    public function index()
    {
        // Ambil semua produk, diurutkan dari yang terbaru
        $products = Product::latest()->get();

        // Hitung statistik ringkasan untuk dashboard cards
        $stats = [
            'total_products' => Product::count(),
            'total_stock'    => Product::sum('stock'),
            'low_stock'      => Product::where('stock', '<', 10)->count(),
            'categories'     => Product::distinct('category')->count('category'),
        ];

        return view('products.index', compact('products', 'stats'));
    }

    /**
     * CREATE - Tampilkan form untuk menambah produk baru.
     */
    public function create()
    {
        // Ambil daftar kategori yang sudah ada untuk dropdown
        $categories = Product::distinct('category')
            ->orderBy('category')
            ->pluck('category');

        return view('products.create', compact('categories'));
    }

    /**
     * STORE - Simpan produk baru ke database.
     *
     * Validasi input sebelum menyimpan ke database.
     */
    public function store(Request $request)
    {
        // Validasi semua field yang dikirim dari form
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required'     => 'Nama produk wajib diisi.',
            'name.max'          => 'Nama produk maksimal 255 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'price.required'    => 'Harga wajib diisi.',
            'price.numeric'     => 'Harga harus berupa angka.',
            'price.min'         => 'Harga tidak boleh negatif.',
            'stock.required'    => 'Stok wajib diisi.',
            'stock.integer'     => 'Stok harus berupa bilangan bulat.',
            'stock.min'         => 'Stok tidak boleh negatif.',
        ]);

        // Simpan produk baru ke database
        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', "Produk \"{$validated['name']}\" berhasil ditambahkan! 🎉");
    }

    /**
     * EDIT - Tampilkan form untuk mengedit produk yang sudah ada.
     *
     * @param  int  $id  ID produk yang akan diedit
     */
    public function edit($id)
    {
        // Cari produk berdasarkan ID, lempar 404 jika tidak ditemukan
        $product = Product::findOrFail($id);

        // Ambil daftar kategori untuk dropdown
        $categories = Product::distinct('category')
            ->orderBy('category')
            ->pluck('category');

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * UPDATE - Simpan perubahan data produk.
     *
     * @param  int  $id  ID produk yang akan diupdate
     */
    public function update(Request $request, $id)
    {
        // Cari produk yang akan diupdate
        $product = Product::findOrFail($id);

        // Validasi data yang dikirim
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required'     => 'Nama produk wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'price.required'    => 'Harga wajib diisi.',
            'price.numeric'     => 'Harga harus berupa angka.',
            'stock.required'    => 'Stok wajib diisi.',
            'stock.integer'     => 'Stok harus berupa bilangan bulat.',
        ]);

        // Update data produk
        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', "Produk \"{$product->name}\" berhasil diperbarui! ✅");
    }

    /**
     * DESTROY - Hapus produk dari database.
     *
     * Dipanggil setelah user mengkonfirmasi di modal konfirmasi.
     *
     * @param  int  $id  ID produk yang akan dihapus
     */
    public function destroy($id)
    {
        // Cari produk yang akan dihapus
        $product = Product::findOrFail($id);
        $productName = $product->name;

        // Hapus produk dari database
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', "Produk \"{$productName}\" berhasil dihapus! 🗑️");
    }
}