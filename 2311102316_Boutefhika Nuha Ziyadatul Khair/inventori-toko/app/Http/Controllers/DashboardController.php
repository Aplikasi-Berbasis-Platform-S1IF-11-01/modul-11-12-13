<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $total      = Product::count();
        $inStock    = Product::inStock()->count();
        $lowStock   = Product::where('stock', '>', 0)->where('stock', '<=', 10)->count();
        $outStock   = Product::where('stock', 0)->count();

        $totalValue = Product::selectRaw('SUM(price * stock) as total')->value('total') ?? 0;

        // 5 produk dengan stok paling sedikit (tapi belum habis)
        $lowStockProducts = Product::where('stock', '>', 0)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();

        // 5 produk terbaru ditambahkan
        $latestProducts = Product::latest()->limit(5)->get();

        // Distribusi per kategori
        $categoryStats = Product::selectRaw('category, COUNT(*) as total, SUM(stock) as total_stock')
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        return view('dashboard', compact(
            'total', 'inStock', 'lowStock', 'outStock',
            'totalValue', 'lowStockProducts', 'latestProducts', 'categoryStats'
        ));
    }
}