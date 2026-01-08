<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $items = [];
        $total = 0;
        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if (!$product)
                continue;
            $items[] = ['product' => $product, 'qty' => $qty];
            $total += $product->price * $qty;
        }
        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|integer', 'qty' => 'required|integer|min:1']);
        $cart = session('cart', []);
        $id = $request->product_id;
        $cart[$id] = isset($cart[$id]) ? $cart[$id] + $request->qty : $request->qty;
        session(['cart' => $cart]);
        return back()->with('success', 'Item added to cart.');
    }

    public function remove(Request $request)
    {
        $id = $request->product_id;
        $cart = session('cart', []);
        if (isset($cart[$id]))
            unset($cart[$id]);
        session(['cart' => $cart]);
        return back();
    }

    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart))
            return redirect('/cart')->with('error', 'Cart is empty');
        $items = [];
        $total = 0;
        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if (!$product)
                continue;
            $items[] = ['product' => $product, 'qty' => $qty];
            $total += $product->price * $qty;
        }
        return view('cart.checkout', compact('items', 'total'));
    }

    public function processOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $cart = session('cart', []);
        if (empty($cart))
            return redirect('/cart')->with('error', 'Cart is empty');

        $total = 0;
        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if (!$product)
                continue;
            $total += $product->price * $qty;
        }

        $order = Order::create([
            'nota' => 'BSMG-' . time(),
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method ?? 'cash',
        ]);

        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if (!$product)
                continue;
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'qty' => $qty,
                'price' => $product->price,
                'subtotal' => $product->price * $qty,
            ]);
        }

        session()->forget('cart');
        return redirect()->route('order.receipt', $order->id)->with('success', 'Order placed successfully.');
    }

    public function receipt($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('cart.receipt', compact('order'));
    }
}