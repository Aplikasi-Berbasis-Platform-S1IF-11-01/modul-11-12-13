<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('products.index');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class)->except(['show']);
});