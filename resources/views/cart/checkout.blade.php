@extends('layouts.master')

@section('title', 'Checkout - BreadSMG')

@section('content')
    <div class="container py-6">
        <h2>Checkout</h2>

        <form method="POST" action="/checkout">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="customer_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Payment method</label>
                <select name="payment_method" class="form-control">
                    <option value="cash">Cash on Delivery</option>
                    <option value="transfer">Bank Transfer</option>
                </select>
            </div>
            <div class="text-end">
                <button class="btn btn-primary">Pay / Place Order</button>
            </div>
        </form>
    </div>
@endsection