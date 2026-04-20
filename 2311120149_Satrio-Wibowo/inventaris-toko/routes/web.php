<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'))->name('home');

Route::middleware(['auth'])->group(function () {

    // Inventaris
    Route::get('/dashboard', App\Livewire\Dashboard::class)->name('dashboard');
    Route::get('/products', App\Livewire\ProductList::class)->name('products.index');
    Route::get('/products/create', App\Livewire\ProductForm::class)->name('products.create');
    Route::get('/products/{product}/edit', App\Livewire\ProductForm::class)->name('products.edit');

});

require __DIR__.'/auth.php';
require __DIR__.'/settings.php'; // ← tambahkan ini