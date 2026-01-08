@extends('layouts.master')

@section('title', $menu->name)

@section('content')
<div class="container py-6">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $menu->image ? asset('images/menus/' . $menu->image) : asset('template-assets/landing/img/product-1.jpg') }}"
                class="img-fluid" alt="">
        </div>
        <div class="col-md-6">
            <h2>{{ $menu->name }}</h2>
            <h4>Rp {{ number_format($menu->price, 0, ',', '.') }}</h4>
            <p>{{ $menu->description }}</p>

            <form action="/cart/add" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $menu->id }}">
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" name="qty" value="1" class="form-control" min="1">
                </div>
                <button class="btn btn-primary">Add to cart</button>
            </form>
        </div>
    </div>
</div>
@endsection