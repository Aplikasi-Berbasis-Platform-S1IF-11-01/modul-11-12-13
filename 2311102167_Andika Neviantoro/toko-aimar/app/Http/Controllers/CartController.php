<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /** Tambah produk ke keranjang (session-based cart) */
    public function add(Request $request, Product $product)
    {
        $request->validate(['quantity' => ['required', 'integer', 'min:1']]);

        $qty  = (int) $request->quantity;
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'quantity'   => $qty,
            ];
        }

        // Jangan melebihi stok
        if ($cart[$product->id]['quantity'] > $product->stock) {
            $cart[$product->id]['quantity'] = $product->stock;
        }

        session()->put('cart', $cart);

        return redirect()->route('shop.cart.index')
            ->with('success', '"' . $product->name . '" berhasil ditambahkan ke keranjang!');
    }

    /** Tampilkan isi keranjang */
    public function index()
    {
        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('shop.cart', compact('cart', 'total'));
    }

    /** Update quantity item di keranjang */
    public function update(Request $request, int $id)
    {
        $request->validate(['quantity' => ['required', 'integer', 'min:1']]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $product = Product::find($id);
            $qty     = min((int) $request->quantity, $product ? $product->stock : 999);
            $cart[$id]['quantity'] = $qty;
            session()->put('cart', $cart);
        }

        return redirect()->route('shop.cart.index')
            ->with('success', 'Jumlah produk diperbarui.');
    }

    /** Hapus item dari keranjang */
    public function remove(int $id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->route('shop.cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /** Checkout – simpan order ke database */
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.cart.index')
                ->with('error', 'Keranjang masih kosong!');
        }

        DB::transaction(function () use ($cart, $request) {
            $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'user_id'     => auth()->id(),
                'total_price' => $total,
                'status'      => 'pending',
                'note'        => $request->note,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);

                // Kurangi stok
                Product::where('id', $item['product_id'])
                    ->decrement('stock', $item['quantity']);
            }
        });

        session()->forget('cart');

        return redirect()->route('shop.index')
            ->with('success', 'Pesanan berhasil dibuat! Terima kasih sudah belanja di Toko Aimar 🎉');
    }
}
