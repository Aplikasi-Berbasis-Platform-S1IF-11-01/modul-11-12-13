<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $kategori = $request->get('kategori');

        $query = Product::query();

        if ($search) {
            $query->where('nama_produk', 'like', "%{$search}%");
        }

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $products  = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $kategoris = Product::select('kategori')->distinct()->pluck('kategori');

        return view('products.index', compact('products', 'kategoris', 'search', 'kategori'));
    }

    public function create()
    {
        $kategoris = ['Minuman', 'Makanan Ringan', 'Sembako', 'Peralatan Rumah', 'Kebersihan', 'Kosmetik'];
        return view('products.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'kategori'    => 'required|string|max:50',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string|max:500',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'kategori.required'    => 'Kategori wajib dipilih.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.integer'         => 'Stok harus berupa angka.',
            'stok.min'             => 'Stok tidak boleh negatif.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka.',
        ]);

        Product::create($request->only(['nama_produk', 'kategori', 'stok', 'harga', 'deskripsi']));

        return redirect()->route('products.index')->with('success', 'Produk "' . $request->nama_produk . '" berhasil ditambahkan! 🛒');
    }

    public function edit(Product $product)
    {
        $kategoris = ['Minuman', 'Makanan Ringan', 'Sembako', 'Peralatan Rumah', 'Kebersihan', 'Kosmetik'];
        return view('products.edit', compact('product', 'kategoris'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'kategori'    => 'required|string|max:50',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string|max:500',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'kategori.required'    => 'Kategori wajib dipilih.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.integer'         => 'Stok harus berupa angka.',
            'stok.min'             => 'Stok tidak boleh negatif.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka.',
        ]);

        $product->update($request->only(['nama_produk', 'kategori', 'stok', 'harga', 'deskripsi']));

        return redirect()->route('products.index')->with('success', 'Produk "' . $product->nama_produk . '" berhasil diperbarui! ✅');
    }

    public function destroy(Product $product)
    {
        $nama = $product->nama_produk;
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk "' . $nama . '" berhasil dihapus! 🗑️');
    }
}
