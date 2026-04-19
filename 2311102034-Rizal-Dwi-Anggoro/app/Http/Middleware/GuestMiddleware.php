<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * GuestMiddleware
 *
 * Middleware untuk route yang hanya bisa diakses oleh tamu (belum login).
 * Jika user sudah login, akan diredirect ke halaman produk.
 * Contoh: halaman login tidak perlu ditampilkan kalau sudah login.
 */
class GuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Jika sudah login, redirect ke halaman produk
        if (Auth::check()) {
            return redirect()->route('products.index');
        }

        return $next($request);
    }
}