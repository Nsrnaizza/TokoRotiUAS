@extends('layouts.master')

@section('title', 'Receipt - BreadSMG')

@section('content')
    <div class="container py-6">
        <h2>Order Receipt</h2>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>@endif

        <h4>Nota: {{ $order->nota }}</h4>
        <p>Name: {{ $order->customer_name }}</p>
        <p>Phone: {{ $order->phone }}</p>
        <p>Address: {{ $order->address }}</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $it)
                    <tr>
                        <td>{{ $it->product->name }}</td>
                        <td>{{ $it->qty }}</td>
                        <td>Rp {{ number_format($it->price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($it->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <h3>Total: Rp {{ number_format($order->total, 0, ',', '.') }}</h3>
        </div>
    </div>
@endsection