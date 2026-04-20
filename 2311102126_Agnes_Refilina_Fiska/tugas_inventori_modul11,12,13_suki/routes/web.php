<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama: Langsung ke login
Route::get('/', function () {
    return redirect('/login');
});

// 2. Rute Registrasi (Di luar middleware agar bisa daftar)
Route::get('/register', function () { 
    return view('register'); 
});
Route::post('/register', [ProductController::class, 'register']);

// 3. Rute Login & Logout
Route::get('/login', function () { 
    return view('login'); 
})->name('login');

Route::post('/login', [ProductController::class, 'login']);
Route::post('/logout', [ProductController::class, 'logout']);

// 4. Rute Inventori (Hanya bisa diakses jika sudah Login)
Route::middleware(['auth.custom'])->group(function () {
    
    // Menampilkan Tabel
    Route::get('/inventori', [ProductController::class, 'index']);
    
    // Tambah Data
    Route::get('/inventori/create', [ProductController::class, 'create']);
    Route::post('/inventori/store', [ProductController::class, 'store']);
    
    // Edit Data
    Route::get('/inventori/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/inventori/{id}', [ProductController::class, 'update']);
    
    // Hapus Data
    Route::delete('/inventori/{id}', [ProductController::class, 'destroy']);

    // --- Rute Profil SUDAH DIHAPUS dari sini ---
});