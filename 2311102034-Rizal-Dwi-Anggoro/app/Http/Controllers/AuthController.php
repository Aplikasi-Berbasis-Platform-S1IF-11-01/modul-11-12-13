<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * AuthController
 *
 * Mengelola proses autentikasi pengguna menggunakan sistem session Laravel.
 * Tidak menggunakan Laravel Breeze / Jetstream agar lebih sederhana
 * dan bisa kita pahami alurnya dari scratch.
 */
class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     * Jika sudah login, redirect ke halaman produk.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses form login.
     *
     * Validasi input → cari user → cek password → buat session.
     */
    public function login(Request $request)
    {
        // Validasi input dari form login
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        // Coba autentikasi dengan credentials yang diberikan
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerate session ID untuk mencegah session fixation attack
            $request->session()->regenerate();

            return redirect()->route('products.index')
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '! 👋');
        }

        // Jika gagal, kembalikan ke form login dengan pesan error
        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Email atau password salah. Silakan coba lagi.',
            ]);
    }

    /**
     * Proses logout.
     *
     * Hapus session dan redirect ke halaman login.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session dan regenerate token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('info', 'Anda telah berhasil logout. Sampai jumpa! 👋');
    }
}
