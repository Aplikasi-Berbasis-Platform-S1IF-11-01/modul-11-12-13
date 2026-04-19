<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// ─── Public Routes ────────────────────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('login');
});

// ─── Auth Routes ──────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Admin / Owner Routes (role: admin) ──────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class)->except(['show']);
});

// ─── Customer / Shopper Routes (role: customer) ───────────────────────────────
Route::middleware(['auth', 'role:customer'])->name('shop.')->group(function () {
    Route::get('/shop',              [ShopController::class, 'index'])->name('index');
    Route::get('/shop/{product}',    [ShopController::class, 'show'])->name('show');
    Route::post('/cart/add/{product}',[CartController::class, 'add'])->name('cart.add');
    Route::get('/cart',              [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{id}',       [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}',      [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout',    [CartController::class, 'checkout'])->name('cart.checkout');
});
