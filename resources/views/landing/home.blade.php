@extends('layouts.landing')

@section('title', 'BreadSMG - Toko Roti & Kue Terbaik')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('template-assets/landing/img/carousel-1.jpg') }}" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                                <p class="text-primary text-uppercase fw-bold mb-2">// The Best Bakery</p>
                                <h1 class="display-1 text-light mb-4 animated slideInDown">Kami Memanggang Dengan Cinta</h1>
                                <p class="text-light fs-5 mb-4 pb-3">Nikmati kelezatan roti dan kue segar yang dipanggang
                                    setiap hari dengan bahan berkualitas tinggi.</p>
                                <a href="{{ url('/products') }}" class="btn btn-primary btn-lg">Lihat Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('template-assets/landing/img/carousel-2.jpg') }}" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                                <p class="text-primary text-uppercase fw-bold mb-2">// Kualitas Terjamin</p>
                                <h1 class="display-1 text-light mb-4 animated slideInDown">Roti & Kue Premium</h1>
                                <p class="text-light fs-5 mb-4 pb-3">Setiap gigitan memberikan pengalaman yang tak
                                    terlupakan dengan cita rasa yang khas.</p>
                                <a href="{{ url('/products') }}" class="btn btn-primary rounded-pill py-3 px-5">Pesan
                                    Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Facts Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-certificate fa-4x text-primary mb-4"></i>
                        <p class="mb-2">Tahun Pengalaman</p>
                        <h1 class="display-5 mb-0" data-toggle="counter-up">10</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-users fa-4x text-primary mb-4"></i>
                        <p class="mb-2">Profesional Ahli</p>
                        <h1 class="display-5 mb-0" data-toggle="counter-up">25</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-bread-slice fa-4x text-primary mb-4"></i>
                        <p class="mb-2">Total Produk</p>
                        <h1 class="display-5 mb-0" data-toggle="counter-up">{{ $menuCount }}</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.7s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-cart-plus fa-4x text-primary mb-4"></i>
                        <p class="mb-2">Pelanggan Puas</p>
                        <h1 class="display-5 mb-0" data-toggle="counter-up">5000</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- About Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="{{ asset('template-assets/landing/img/about-1.jpg') }}"
                                alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="{{ asset('template-assets/landing/img/about-2.jpg') }}"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <p class="text-primary text-uppercase mb-2">// Tentang Kami</p>
                        <h1 class="display-6 mb-4">Kami Memanggang Setiap Item Dengan Cinta</h1>
                        <p>BreadSMG adalah toko roti dan kue yang berlokasi di kota Anda. Kami telah melayani pelanggan
                            sejak bertahun-tahun dengan komitmen memberikan produk berkualitas terbaik.</p>
                        <p>Setiap roti dan kue dipanggang dengan bahan-bahan segar dan berkualitas tinggi, tanpa pengawet
                            buatan. Kami bangga dengan citarasa yang khas dan tekstur yang sempurna.</p>
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Produk Berkualitas
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Kue Custom
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Pesan Online
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Pengiriman ke Rumah
                            </div>
                        </div>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ url('/products') }}">Lihat Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Product Start -->
    <div class="container-xxl bg-light my-6 py-6 pt-0">
        <div class="container">
            <div class="bg-primary text-light rounded-bottom p-5 my-6 mt-0 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 text-light mb-0">Toko Roti & Kue Terbaik di Kota Anda</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <div class="d-inline-flex align-items-center text-start">
                            <i class="fa fa-phone-alt fa-4x flex-shrink-0"></i>
                            <div class="ms-4">
                                <p class="fs-5 fw-bold mb-0">Hubungi Kami</p>
                                <p class="fs-1 fw-bold mb-0">+62 123 4567 890</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">// Produk Kami</p>
                <h1 class="display-6 mb-4">Jelajahi Kategori Produk Roti & Kue Kami</h1>
            </div>
            <div class="row g-4">
                @foreach($menus as $menu)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                            <div class="text-center p-4">
                                <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">Rp
                                    {{ number_format($menu->price, 0, ',', '.') }}</div>
                                <h3 class="mb-3">{{ $menu->name }}</h3>
                                <span>{{ Str::limit($menu->description, 60) }}</span>
                            </div>
                            <div class="position-relative mt-auto">
                                @if($menu->image)
                                    <img class="img-fluid" src="{{ asset('images/menus/' . $menu->image) }}" alt="{{ $menu->name }}"
                                        style="height: 200px; object-fit: cover;">
                                @else
                                    <img class="img-fluid" src="{{ asset('template-assets/landing/img/product-1.jpg') }}"
                                        alt="{{ $menu->name }}">
                                @endif
                                <div class="product-overlay">
                                    <a class="btn btn-lg-square btn-outline-light rounded-circle"
                                        href="{{ url('/products') }}"><i class="fa fa-eye text-primary"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ url('/products') }}" class="btn btn-primary rounded-pill py-3 px-5">Lihat Semua Produk</a>
            </div>
        </div>
    </div>
    <!-- Product End -->


    <!-- Service Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="text-primary text-uppercase mb-2">// Layanan Kami</p>
                    <h1 class="display-6 mb-4">Apa Yang Kami Tawarkan?</h1>
                    <p class="mb-5">Kami menyediakan berbagai layanan untuk memenuhi kebutuhan Anda</p>
                    <div class="row gy-5 gx-4">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-bread-slice text-white"></i>
                                </div>
                                <h5 class="mb-0">Produk Berkualitas</h5>
                            </div>
                            <span>Setiap produk dibuat dengan bahan-bahan terbaik dan segar</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-birthday-cake text-white"></i>
                                </div>
                                <h5 class="mb-0">Kue Custom</h5>
                            </div>
                            <span>Kami menerima pesanan kue custom untuk berbagai acara</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-cart-plus text-white"></i>
                                </div>
                                <h5 class="mb-0">Pesan Online</h5>
                            </div>
                            <span>Pesan produk favorit Anda dengan mudah secara online</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-truck text-white"></i>
                                </div>
                                <h5 class="mb-0">Pengiriman</h5>
                            </div>
                            <span>Layanan pengiriman ke seluruh area kota</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="{{ asset('template-assets/landing/img/service-1.jpg') }}"
                                alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="{{ asset('template-assets/landing/img/service-2.jpg') }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Contact Start -->
    <div id="contact" class="container-xxl bg-light my-6 py-6 pb-0">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">// Hubungi Kami</p>
                <h1 class="display-6 mb-4">Ada Pertanyaan? Silakan Hubungi Kami</h1>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-center bg-white rounded p-4 shadow-sm">
                            <div class="btn-square bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-map-marker-alt text-white fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1">Alamat</h5>
                                <p class="mb-0 text-muted">Jl. Raya Utama No. 123, Kota Anda</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center bg-white rounded p-4 shadow-sm">
                            <div class="btn-square bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-phone-alt text-white fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1">Telepon</h5>
                                <p class="mb-0 text-muted">+62 123 4567 890</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center bg-white rounded p-4 shadow-sm">
                            <div class="btn-square bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-envelope text-white fs-4"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1">Email</h5>
                                <p class="mb-0 text-muted">info@breadsmg.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Nama Anda">
                                    <label for="name">Nama Anda</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email Anda">
                                    <label for="email">Email Anda</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subjek">
                                    <label for="subject">Subjek</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Pesan Anda" id="message"
                                        style="height: 150px"></textarea>
                                    <label for="message">Pesan Anda</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5 w-100" type="submit">Kirim
                                    Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection