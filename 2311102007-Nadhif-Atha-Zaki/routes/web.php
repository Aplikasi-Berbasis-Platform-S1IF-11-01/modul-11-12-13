<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';