<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page Routes
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/products', [LandingController::class, 'products'])->name('products');


// Order Routes
Route::post('/orders', [LandingController::class, 'storeOrder'])->name('orders.store');
Route::get('/orders/success/{id}', [LandingController::class, 'orderSuccess'])->name('orders.success');
Route::get('/orders', [LandingController::class, 'orderSuccess'])->name('orders');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/process', [CartController::class, 'processOrder'])->name('cart.process');
Route::get('/cart/receipt/{id}', [CartController::class, 'receipt'])->name('order.receipt');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Menu CRUD
    Route::resource('menus', AdminMenuController::class);

    // Order management
    Route::resource('orders', AdminOrderController::class);
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
});

// Keep old routes for backward compatibility
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');
