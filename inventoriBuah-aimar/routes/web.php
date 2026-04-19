<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Lindungi CRUD dengan Middleware Auth
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});
Route::get('/dashboard', function () {
    return redirect()->route('products.index');
})->middleware(['auth']);