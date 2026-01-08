<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class HomeController extends Controller
{
    // Admin Dashboard
    public function adminDashboard()
    {
        $menuCount = Product::count();
        $orderCount = Order::count();
        $pendingCount = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $recentOrders = Order::latest()->limit(5)->get();

        return view('admin.dashboard', compact('menuCount', 'orderCount', 'pendingCount', 'totalRevenue', 'recentOrders'));
    }

    public function index()
    {
        $menus = Product::active()->latest()->take(6)->get();
        $menuCount = Product::count();
        return view('landing.home', compact('menus', 'menuCount'));
    }

    public function show($id)
    {
        $menu = Product::findOrFail($id);
        return view('product', compact('menu'));
    }
}
