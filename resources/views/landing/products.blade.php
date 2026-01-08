@extends('layouts.landing')

@section('title', 'Produk - BreadSMG')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Produk Kami</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Produk</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Product Start -->
    <div class="container-xxl bg-light my-6 py-6 pt-0" style="margin: 12rem 0;">
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

            <!-- Category Filter -->
            <div class="mb-4 text-center">
                <div class="btn-group flex-wrap justify-content-center" role="group">
                    <a href="{{ url('/products') }}"
                        class="btn {{ !request()->category ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 mx-1">Semua</a>
                    <a href="{{ url('/products?category=Roti') }}"
                        class="btn {{ request()->category == 'Roti' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 mx-1">Roti</a>
                    <a href="{{ url('/products?category=Kue') }}"
                        class="btn {{ request()->category == 'Kue' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 mx-1">Kue</a>
                    <a href="{{ url('/products?category=Cookies') }}"
                        class="btn {{ request()->category == 'Cookies' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 mx-1">Cookies</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                @forelse($menus as $menu)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100 shadow-sm">
                            <div class="text-center p-4">
                                @if($menu->category)
                                    <span
                                        class="badge bg-primary bg-opacity-10 text-primary rounded-pill mb-2">{{ $menu->category }}</span>
                                @endif
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
                                <div class="product-overlay d-flex justify-content-center align-items-center gap-2">
                                    <button type="button" class="btn btn-lg-square btn-outline-light rounded-circle"
                                        data-bs-toggle="modal" data-bs-target="#orderModal{{ $menu->id }}">
                                        <i class="fa fa-shopping-cart text-primary"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Modal for this product -->
                    <div class="modal fade" id="orderModal{{ $menu->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="modal-title">Pesan {{ $menu->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('orders.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="product_id" value="{{ $menu->id }}">

                                        <div class="text-center mb-4">
                                            @if($menu->image)
                                                <img src="{{ asset('images/menus/' . $menu->image) }}" alt="{{ $menu->name }}"
                                                    class="rounded-3 mb-3" style="max-height: 150px; object-fit: cover;">
                                            @endif
                                            <h4>{{ $menu->name }}</h4>
                                            <p class="text-muted">{{ Str::limit($menu->description, 100) }}</p>
                                            <h5 class="text-primary">Rp {{ number_format($menu->price, 0, ',', '.') }}</h5>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-outline-primary"
                                                    onclick="decreaseQty('qty{{ $menu->id }}')">-</button>
                                                <input type="number" class="form-control text-center" name="qty"
                                                    id="qty{{ $menu->id }}" value="1" min="1" max="99" required
                                                    onchange="updateTotal('{{ $menu->id }}', {{ $menu->price }})"
                                                    onkeyup="updateTotal('{{ $menu->id }}', {{ $menu->price }})">
                                                <button type="button" class="btn btn-outline-primary"
                                                    onclick="increaseQty('qty{{ $menu->id }}')">+</button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control rounded-3 @error('customer_name') is-invalid @enderror"
                                                name="customer_name" value="{{ old('customer_name') }}" required
                                                placeholder="Nama lengkap Anda">
                                            @error('customer_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control rounded-3" name="email"
                                                value="{{ old('email') }}" placeholder="email@anda.com">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Telepon <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control rounded-3 @error('phone') is-invalid @enderror" name="phone"
                                                value="{{ old('phone') }}" required placeholder="08xxxxxxxxxx">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Alamat Pengiriman <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control rounded-3 @error('address') is-invalid @enderror"
                                                name="address" rows="2" required
                                                placeholder="Alamat lengkap pengiriman">{{ old('address') }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Catatan</label>
                                            <textarea class="form-control rounded-3" name="notes" rows="2"
                                                placeholder="Catatan tambahan (opsional)">{{ old('notes') }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Metode Pembayaran <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select rounded-3 @error('payment_method') is-invalid @enderror"
                                                name="payment_method" required>
                                                <option value="">Pilih Metode Pembayaran</option>
                                                <option value="Tunai" {{ old('payment_method') == 'Tunai' ? 'selected' : '' }}>
                                                    Tunai (Bayar di Toko)</option>
                                                <option value="Transfer Bank" {{ old('payment_method') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                                <option value="E-Wallet" {{ old('payment_method') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet (OVO, GoPay, DANA)</option>
                                            </select>
                                            @error('payment_method')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="alert alert-info rounded-3">
                                            <strong>Total Pembayaran:</strong> <span id="total{{ $menu->id }}">Rp
                                                {{ number_format($menu->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-outline-secondary rounded-3"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary rounded-3">
                                            <i class="material-icons-outlined me-2">shopping_cart</i>Buat Pesanan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="material-icons-outlined text-muted" style="font-size: 64px;">restaurant_menu</i>
                        <p class="text-muted mt-3">Belum ada produk tersedia</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-5">
                {{ $menus->links() }}
            </div>
        </div>
    </div>
    <!-- Product End -->
@endsection

@push('scripts')
    <script>
        function increaseQty(inputId) {
            const input = document.getElementById(inputId);
            const currentValue = parseInt(input.value) || 0;
            if (currentValue < 99) {
                input.value = currentValue + 1;
                input.dispatchEvent(new Event('change'));
            }
        }

        function decreaseQty(inputId) {
            const input = document.getElementById(inputId);
            const currentValue = parseInt(input.value) || 0;
            if (currentValue > 1) {
                input.value = currentValue - 1;
                input.dispatchEvent(new Event('change'));
            }
        }

        function updateTotal(menuId, price) {
            const qty = parseInt(document.getElementById('qty' + menuId).value) || 1;
            const total = qty * price;
            document.getElementById('total' + menuId).textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    </script>
@endpush