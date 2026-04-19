<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return redirect()->route('products.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('products', ProductController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';