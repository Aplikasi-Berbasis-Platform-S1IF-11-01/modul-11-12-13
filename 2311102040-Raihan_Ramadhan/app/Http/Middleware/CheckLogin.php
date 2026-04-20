<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek session login
        if (!session('login')) {
            return redirect('/')->with('error', 'Silakan login dulu!');
        }

        return $next($request);
    }
}