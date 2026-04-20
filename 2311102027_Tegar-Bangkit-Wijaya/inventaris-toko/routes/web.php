<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ── Auth ─────────────────────────────────────────────────────────────────
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Protected routes (membutuhkan login) ─────────────────────────────────
Route::middleware(\App\Http\Middleware\AuthMiddleware::class)->group(function () {

    // Dashboard
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');

    // Generate kode produk otomatis
    Route::get('/products/generate-kode', [ProductController::class, 'generateKode'])
         ->name('products.generate-kode');

    // CRUD Produk
    Route::resource('products', ProductController::class);
});