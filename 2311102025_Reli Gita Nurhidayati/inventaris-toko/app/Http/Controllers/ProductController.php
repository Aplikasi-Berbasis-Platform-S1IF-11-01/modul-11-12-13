<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        $totalProduk = Product::count();
        $totalStok = Product::sum('stok');
        $totalNilai = Product::selectRaw('SUM(harga * stok) as total')->value('total');

        return view('products.index', compact('products', 'totalProduk', 'totalStok', 'totalNilai'));
    }

    public function create()
    {
        $kategoriList = ['Elektronik', 'Pakaian', 'Makanan', 'Minuman', 'Peralatan Rumah', 'Alat Tulis', 'Mainan', 'Kosmetik'];
        return view('products.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string|max:1000',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi!',
            'kategori.required'    => 'Kategori wajib dipilih!',
            'stok.required'        => 'Stok wajib diisi!',
            'stok.integer'         => 'Stok harus berupa angka bulat!',
            'stok.min'             => 'Stok tidak boleh negatif!',
            'harga.required'       => 'Harga wajib diisi!',
            'harga.numeric'        => 'Harga harus berupa angka!',
            'harga.min'            => 'Harga tidak boleh negatif!',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', '✅ Produk "' . $request->nama_produk . '" berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $kategoriList = ['Elektronik', 'Pakaian', 'Makanan', 'Minuman', 'Peralatan Rumah', 'Alat Tulis', 'Mainan', 'Kosmetik'];
        return view('products.edit', compact('product', 'kategoriList'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string|max:1000',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi!',
            'kategori.required'    => 'Kategori wajib dipilih!',
            'stok.required'        => 'Stok wajib diisi!',
            'stok.integer'         => 'Stok harus berupa angka bulat!',
            'stok.min'             => 'Stok tidak boleh negatif!',
            'harga.required'       => 'Harga wajib diisi!',
            'harga.numeric'        => 'Harga harus berupa angka!',
            'harga.min'            => 'Harga tidak boleh negatif!',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', '✅ Produk "' . $product->nama_produk . '" berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $nama = $product->nama_produk;
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', '🗑️ Produk "' . $nama . '" berhasil dihapus!');
    }
}
