<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class LandingController extends Controller
{
    public function index()
    {
        // show latest active products
        $menus = Product::active()->latest()->take(6)->get();
        $menuCount = Product::count();
        return view('landing.home', compact('menus', 'menuCount'));
    }

    public function products()
    {
        $menus = Product::when(request()->category, function ($query) {
            return $query->where('category', request()->category);
        })->active()->orderBy('created_at', 'desc')->paginate(12);

        return view('landing.products', compact('menus'));
    }



    public function storeOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Generate unique nota number
        $nota = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

        // Create order
        $order = Order::create([
            'nota' => $nota,
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $product->price * $request->qty,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        // Create order item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'qty' => $request->qty,
            'price' => $product->price,
            'subtotal' => $product->price * $request->qty,
        ]);

        return redirect()->route('orders.success', $order->id)->with('success', 'Pesanan berhasil dibuat!');
    }

    public function orderSuccess($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('landing.order-success', compact('order'));
    }
}
