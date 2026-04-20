<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    // 1. Menampilkan daftar tabel inventori
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() { return view('products.create'); }

    public function store(Request $request) {
        $request->validate([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);
        Product::create($request->all());
        return redirect('/inventori')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect('/inventori')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id) {
        Product::findOrFail($id)->delete();
        return redirect('/inventori')->with('success', 'Produk berhasil dihapus!');
    }

    // --- BAGIAN REGISTRASI (Fokus Username & Password) ---
    public function register(Request $request) {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:5',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // --- BAGIAN LOGIN (Penyelaras dengan Middleware auth.custom) ---
    public function login(Request $request) {
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // SANGAT PENTING:
            // Pastikan 'user' disimpan ke session karena middleware auth.custom 
            // biasanya mengecek Session::has('user')
            Session::put('user', $user->username);
            Session::put('user_id', $user->id);
            
            return redirect('/inventori')->with('success', 'Selamat datang!');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    // --- BAGIAN LOGOUT ---
    public function logout() {
        Session::flush(); // Menghapus semua session agar benar-benar keluar
        return redirect('/login');
    }
}