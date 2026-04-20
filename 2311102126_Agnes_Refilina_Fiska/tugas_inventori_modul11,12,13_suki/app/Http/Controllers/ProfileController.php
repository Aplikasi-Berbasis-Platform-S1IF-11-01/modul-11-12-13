<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Tampilkan Halaman Edit Profil
     */
    public function index()
    {
        // Ambil data user yang sedang login dari session ID
        $user = User::findOrFail(session('user_id'));
        return view('profile', compact('user'));
    }

    /**
     * Update Data Profil
     */
    public function update(Request $request)
    {
        // Ambil data user yang sedang login
        $user = User::findOrFail(session('user_id'));

        // Validasi input
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username'  => [
                'required',
                'string',
                'max:255',
                // Pastikan username unik, kecuali untuk user ini sendiri
                Rule::unique('users')->ignore($user->id),
            ],
            // Password opsional, tapi kalau diisi minimal 6 karakter
            'password'  => 'nullable|string|min:6',
        ]);

        // Update Informasi Dasar
        $user->full_name = $request->full_name;
        $user->username  = $request->username;

        // Update Password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan ke Database
        $user->save();

        // Update session username (biar nama di pojok kanan dashboard ikut berubah)
        session(['username' => $user->username]);

        // Kembalikan dengan pesan sukses
        return redirect('/profile')->with('success', 'Profil Anda berhasil diperbarui!');
    }
}