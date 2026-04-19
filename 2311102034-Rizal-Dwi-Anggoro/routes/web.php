<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes - Inventaris Toko Pak Cik & Mas Aimar
|--------------------------------------------------------------------------
|
| Di sini kita mendefinisikan semua route untuk aplikasi web inventaris.
| Route dibagi menjadi dua grup:
| 1. Route tamu (guest) - bisa diakses tanpa login: halaman login
| 2. Route terproteksi (auth) - harus login dulu: semua fitur produk
|
*/

// ============================================================
// ROOT: Redirect ke produk (atau login kalau belum auth)
// ============================================================
Route::get('/', function () {
    return redirect()->route('products.index');
});

// ============================================================
// AUTH ROUTES - Tidak perlu login untuk akses ini
// ============================================================
Route::middleware('guest.custom')->group(function () {
    // Tampilkan form login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    // Proses form login
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// ============================================================
// PROTECTED ROUTES - Wajib login
// ============================================================
Route::middleware('auth.custom')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // CRUD Produk (Resource Route)
    // GET    /products          → index   (daftar produk + datatable)
    // GET    /products/create   → create  (form tambah produk)
    // POST   /products          → store   (simpan produk baru)
    // GET    /products/{id}/edit → edit   (form edit produk)
    // PUT    /products/{id}     → update  (simpan perubahan produk)
    // DELETE /products/{id}     → destroy (hapus produk)
    Route::resource('products', ProductController::class);
});