@extends('layouts.master')

@section('title', 'Cart - BreadSMG')

@section('content')
    <div class="container py-6">
        <h2>Cart</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>@endif

        @if(count($items) === 0)
            <p>Your cart is empty.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $it)
                        <tr>
                            <td>{{ $it['product']->name }}</td>
                            <td>{{ $it['qty'] }}</td>
                            <td>Rp {{ number_format($it['product']->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($it['product']->price * $it['qty'], 0, ',', '.') }}</td>
                            <td>
                                <form method="POST" action="/cart/remove">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $it['product']->id }}">
                                    <button class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <h4>Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
            </div>
            <div class="mt-3 text-end">
                <a href="/checkout" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        @endif
    </div>
@endsection