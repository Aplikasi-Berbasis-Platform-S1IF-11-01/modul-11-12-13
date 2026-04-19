<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

// Route Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Proteksi Route Produk (Hanya bisa diakses jika sudah login)
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('/', [ProductController::class, 'index']); // Jadikan dashboard utama
});
