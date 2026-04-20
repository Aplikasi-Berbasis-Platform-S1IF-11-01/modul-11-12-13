<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * AuthMiddleware
 *
 * Middleware untuk memproteksi route yang membutuhkan autentikasi.
 * Jika user belum login, akan diredirect ke halaman login.
 */
class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}