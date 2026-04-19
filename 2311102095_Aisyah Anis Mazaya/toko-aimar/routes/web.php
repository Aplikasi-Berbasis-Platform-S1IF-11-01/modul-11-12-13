<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

// --- JALUR LOGIN & LOGOUT ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- JALUR PRODUK (Hanya bisa diakses kalau sudah login) ---
Route::middleware('auth')->group(function () {
    
    // Kalau buka web utama, otomatis lempar ke halaman produk
    Route::get('/', function () {
        return redirect()->route('products.index');
    });

    Route::resource('products', ProductController::class);
});