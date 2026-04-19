<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalProduk = Product::count();
    $totalStok = Product::sum('stok');
    $stokHabis = Product::where('stok', '<=', 0)->count();
    $stokRendah = Product::where('stok', '>', 0)->where('stok', '<=', 5)->count();
    $produkTerbaru = Product::latest()->take(5)->get();
    $nilaiInventori = Product::selectRaw('SUM(harga * stok) as total')->value('total') ?? 0;

    return view('dashboard', compact(
        'totalProduk',
        'totalStok',
        'stokHabis',
        'stokRendah',
        'produkTerbaru',
        'nilaiInventori'
    ));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});