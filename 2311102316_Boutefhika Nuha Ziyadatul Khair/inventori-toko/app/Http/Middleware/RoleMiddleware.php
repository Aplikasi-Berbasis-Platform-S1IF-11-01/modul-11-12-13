<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== $role) {
            // Admin yang coba akses shop → redirect ke dashboard
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Akses ditolak. Anda adalah Admin.');
            }

            // Customer yang coba akses admin → redirect ke shop
            return redirect()->route('shop.index')
                ->with('error', 'Akses ditolak. Halaman ini hanya untuk Admin.');
        }

        return $next($request);
    }
}
