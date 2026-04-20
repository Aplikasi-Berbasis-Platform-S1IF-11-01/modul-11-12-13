<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::inStock();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category = $request->get('category')) {
            $query->where('category', $category);
        }

        $sortBy = $request->get('sort', 'name');
        $query->orderBy(in_array($sortBy, ['name', 'price']) ? $sortBy : 'name', 'asc');

        $products   = $query->paginate(12)->withQueryString();
        $categories = Product::inStock()->select('category')->distinct()->pluck('category');

        return view('shop.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        abort_if(!$product->isInStock(), 404);
        return view('shop.show', compact('product'));
    }
}
