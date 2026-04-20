<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ─── AUTH ────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ─── PROTECTED: hanya bisa akses jika sudah login ────
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class)
         ->except(['show']); // kita tidak butuh halaman detail
});