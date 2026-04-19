<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // ── GET /dashboard ───────────────────────────────────────────────────
    public function dashboard()
    {
        $totalProduk   = Product::count();
        $produkAktif   = Product::aktif()->count();
        $stokHampirHabis = Product::where('stok', '<=', 10)->where('stok', '>', 0)->count();
        $stokHabis     = Product::where('stok', 0)->count();
        $nilaiInventaris = Product::aktif()->selectRaw('SUM(stok * harga_jual) as total')->value('total') ?? 0;

        $produkTerbaru = Product::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalProduk', 'produkAktif', 'stokHampirHabis',
            'stokHabis', 'nilaiInventaris', 'produkTerbaru'
        ));
    }

    // ── GET /products ────────────────────────────────────────────────────
    public function index(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products  = $query->latest()->paginate(10)->withQueryString();
        $kategoris = Product::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

        return view('products.index', compact('products', 'kategoris'));
    }

    // ── GET /products/create ─────────────────────────────────────────────
    public function create()
    {
        $kategoris = Product::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');
        return view('products.create', compact('kategoris'));
    }

    // ── POST /products ───────────────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk'  => 'required|string|max:50|unique:products,kode_produk',
            'nama_produk'  => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'deskripsi'    => 'nullable|string|max:1000',
            'stok'         => 'required|integer|min:0',
            'harga_beli'   => 'required|numeric|min:0',
            'harga_jual'   => 'required|numeric|min:0|gte:harga_beli',
            'satuan'       => 'required|string|max:20',
            'status'       => 'required|in:aktif,nonaktif',
        ], [
            'kode_produk.unique'   => 'Kode produk sudah digunakan.',
            'harga_jual.gte'       => 'Harga jual tidak boleh lebih kecil dari harga beli.',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $validated['nama_produk'] . '" berhasil ditambahkan.');
    }

    // ── GET /products/{id}/edit ──────────────────────────────────────────
    public function edit(Product $product)
    {
        $kategoris = Product::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');
        return view('products.edit', compact('product', 'kategoris'));
    }

    // ── PUT /products/{id} ───────────────────────────────────────────────
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'kode_produk'  => 'required|string|max:50|unique:products,kode_produk,' . $product->id,
            'nama_produk'  => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'deskripsi'    => 'nullable|string|max:1000',
            'stok'         => 'required|integer|min:0',
            'harga_beli'   => 'required|numeric|min:0',
            'harga_jual'   => 'required|numeric|min:0|gte:harga_beli',
            'satuan'       => 'required|string|max:20',
            'status'       => 'required|in:aktif,nonaktif',
        ], [
            'kode_produk.unique' => 'Kode produk sudah digunakan.',
            'harga_jual.gte'     => 'Harga jual tidak boleh lebih kecil dari harga beli.',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $product->nama_produk . '" berhasil diperbarui.');
    }

    // ── DELETE /products/{id} ────────────────────────────────────────────
    public function destroy(Product $product)
    {
        $nama = $product->nama_produk;
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $nama . '" berhasil dihapus.');
    }

    // ── GET /products/{id} (show detail) ────────────────────────────────
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // ── Helper: generate kode otomatis (AJAX) ───────────────────────────
    public function generateKode()
    {
        $last = Product::latest()->first();
        $num  = $last ? ((int) Str::afterLast($last->kode_produk, '-')) + 1 : 1;
        return response()->json(['kode' => 'PRD-' . str_pad($num, 4, '0', STR_PAD_LEFT)]);
    }
}
