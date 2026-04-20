<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 🔒 Proteksi login
    public function __construct()
    {
        if (!session('login')) {
            redirect('/')->send();
        }
    }

    // 📊 Tampilkan semua data
    public function index()
    {
        $data = Product::all();
        return view('products.index', compact('data'));
    }

    // ➕ Form tambah
    public function create()
    {
        return view('products.create');
    }

    // 💾 Simpan data + upload gambar
    public function store(Request $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $imageName
        ]);

        return redirect('/products')->with('success', 'Data berhasil ditambahkan');
    }

    // ✏️ Form edit
    public function edit($id)
    {
        $data = Product::findOrFail($id);
        return view('products.edit', compact('data'));
    }

    // 🔄 Update data + optional gambar
    public function update(Request $request, $id)
    {
        $data = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');
            $data->image = $imageName;
        }

        $data->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $data->image
        ]);

        return redirect('/products')->with('success', 'Data berhasil diupdate');
    }

    // ❌ Hapus data
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/products')->with('success', 'Data berhasil dihapus');
    }
}