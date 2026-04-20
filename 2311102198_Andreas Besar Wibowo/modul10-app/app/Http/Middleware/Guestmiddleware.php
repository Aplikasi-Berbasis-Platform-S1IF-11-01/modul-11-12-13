<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestMiddleware
{
    /**
     * Redirect ke halaman produk jika user sudah login.
     * Mencegah user yang sudah login mengakses halaman login.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('auth_user')) {
            return redirect()->route('products.index');
        }

        return $next($request);
    }
}