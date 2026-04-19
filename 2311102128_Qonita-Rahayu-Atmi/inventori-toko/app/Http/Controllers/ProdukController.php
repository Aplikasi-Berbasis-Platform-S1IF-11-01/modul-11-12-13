<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // ── Index: Daftar semua produk (DataTable) ──────────────────────────────
    public function index()
    {
        $produks   = Produk::with('kategori')->latest()->get();
        $kategoris = Kategori::all();
        $stats = [
            'total'    => $produks->count(),
            'aktif'    => $produks->where('status', 'aktif')->count(),
            'nonaktif' => $produks->where('status', 'nonaktif')->count(),
            'habis'    => $produks->where('stok', 0)->count(),
        ];
        return view('produk.index', compact('produks', 'kategoris', 'stats'));
    }

    // ── Create: Form tambah produk ──────────────────────────────────────────
    public function create()
    {
        $kategoris = Kategori::orderBy('nama')->get();
        return view('produk.create', compact('kategoris'));
    }

    // ── Store: Simpan produk baru ───────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'kode'        => 'required|string|max:50|unique:produks,kode',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'satuan'      => 'required|string|max:50',
            'kategori_id' => 'required|exists:kategoris,id',
            'status'      => 'required|in:aktif,nonaktif',
        ], [
            'nama.required'        => 'Nama produk wajib diisi.',
            'kode.required'        => 'Kode produk wajib diisi.',
            'kode.unique'          => 'Kode produk sudah digunakan.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.integer'         => 'Stok harus berupa angka bulat.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists'   => 'Kategori tidak valid.',
        ]);

        Produk::create($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk "' . $validated['nama'] . '" berhasil ditambahkan!');
    }

    // ── Show: Detail produk (opsional) ──────────────────────────────────────
    public function show(Produk $produk)
    {
        $produk->load('kategori');
        return view('produk.show', compact('produk'));
    }

    // ── Edit: Form edit produk ──────────────────────────────────────────────
    public function edit(Produk $produk)
    {
        $kategoris = Kategori::orderBy('nama')->get();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    // ── Update: Simpan perubahan produk ────────────────────────────────────
    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'kode'        => 'required|string|max:50|unique:produks,kode,' . $produk->id,
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'satuan'      => 'required|string|max:50',
            'kategori_id' => 'required|exists:kategoris,id',
            'status'      => 'required|in:aktif,nonaktif',
        ]);

        $produk->update($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk "' . $produk->nama . '" berhasil diperbarui!');
    }

    // ── Destroy: Hapus produk ───────────────────────────────────────────────
    public function destroy(Produk $produk)
    {
        $nama = $produk->nama;
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk "' . $nama . '" berhasil dihapus!');
    }
}
