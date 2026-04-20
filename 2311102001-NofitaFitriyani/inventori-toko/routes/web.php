<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect root & dashboard
Route::get('/', function () {
    return redirect()->route('products.index');
});
Route::get('/dashboard', function () {
    return redirect()->route('products.index');
});

// Protected Routes
Route::middleware(\App\Http\Middleware\AuthMiddleware::class)->group(function () {
    Route::resource('products', ProductController::class);
});
