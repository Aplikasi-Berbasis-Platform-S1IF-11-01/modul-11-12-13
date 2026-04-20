<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'totalProducts'    => Product::count(),
            'totalAssetValue'  => Product::sum(DB::raw('price * stock')),
            'lowStockProducts' => Product::lowStock()->orderBy('stock')->limit(10)->get(),
            'totalCategories'  => Product::distinct('category')->count('category'),
        ]);
    }
}