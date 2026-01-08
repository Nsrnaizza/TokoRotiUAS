@extends('layouts.master')

@section('title', 'Home - BreadSMG')

@section('content')

    <!-- Navbar (simple, based on template) -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5">
        <a href="/" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0">BreadSMG</h1>
        </a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto p-4 p-lg-0">
                <a href="/" class="nav-item nav-link active">Home</a>
                <a href="#products" class="nav-item nav-link">Products</a>
            </div>
            <div class="d-flex">
                <a href="/cart" class="btn btn-outline-light text-primary">Cart (<span
                        id="cart-count">{{ session('cart') ? count(session('cart')) : 0 }}</span>)</a>
            </div>
        </div>
    </nav>

    <div style="height:80px"></div>

    <!-- Product List -->
    <div class="container-xxl bg-light my-6 py-6 pt-0" id="products">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">// Bakery Products</p>
                <h1 class="display-6 mb-4">Explore Our Breads & Cakes</h1>
            </div>

            <div class="row g-4">
                @forelse($menus as $menu)
                    <div class="col-lg-4 col-md-6 wow fadeInUp">
                        <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                            <div class="text-center p-4">
                                <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">Rp
                                    {{ number_format($menu->price, 0, ',', '.') }}</div>
                                <h3 class="mb-3">{{ $menu->name }}</h3>
                                <span>{{ \Illuminate\Support\Str::limit($menu->description, 80) }}</span>
                            </div>
                            <div class="position-relative mt-auto">
                                <img class="img-fluid"
                                    src="{{ $menu->image ? asset('images/menus/' . $menu->image) : asset('template-assets/landing/img/product-1.jpg') }}"
                                    alt="">
                                <div class="product-overlay">
                                    <form action="/cart/add" method="POST" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $menu->id }}">
                                        <input type="hidden" name="qty" value="1">
                                        <button class="btn btn-lg-square btn-outline-light rounded-circle"
                                            title="Add to cart"><i class="fa fa-cart-plus text-primary"></i></button>
                                    </form>
                                    <a class="btn btn-lg-square btn-outline-light rounded-circle"
                                        href="/product/{{ $menu->id }}"><i class="fa fa-eye text-primary"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">No products yet. Add some from Admin.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection