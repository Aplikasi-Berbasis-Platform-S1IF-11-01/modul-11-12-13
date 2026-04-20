<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        if ($request->email == 'admin@gmail.com' && $request->password == '123') {
            session(['login' => true]);

            return redirect('/products');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}