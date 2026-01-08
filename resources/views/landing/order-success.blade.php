@extends('layouts.landing')

@section('title', 'Pesanan Berhasil - BreadSMG')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Pesanan Berhasil</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Pesanan Berhasil</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Success Section Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card rounded-4 shadow-sm border-0">
                        <div class="card-body p-5 text-center">
                            <div class="mb-4">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 80px;"></i>
                            </div>
                            <h2 class="mb-3">Terima Kasih!</h2>
                            <p class="text-muted mb-4">Pesanan Anda telah berhasil dibuat. Berikut adalah detail pesanan
                                Anda:</p>

                            <div class="bg-light rounded-3 p-4 mb-4 text-start">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Nomor Nota:</span>
                                    <strong>{{ $order->nota }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Tanggal:</span>
                                    <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Status:</span>
                                    <span class="badge bg-warning text-dark rounded-3">Pending</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <strong>Total Pembayaran:</strong>
                                    <strong class="text-primary">Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                                </div>
                            </div>

                            <div class="alert alert-info rounded-3 mb-4">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Silakan simpan nomor nota Anda:</strong> <code>{{ $order->nota }}</code>
                            </div>

                            @if($order->payment_method == 'Tunai')
                                <div class="alert alert-warning rounded-3 mb-4">
                                    <i class="bi bi-cash me-2"></i>
                                    Anda memilih pembayaran <strong>Tunai</strong>. Silakan lakukan pembayaran di toko kami saat
                                    mengambil pesanan.
                                </div>
                            @elseif($order->payment_method == 'Transfer Bank')
                                <div class="alert alert-primary rounded-3 mb-4">
                                    <i class="bi bi-bank me-2"></i>
                                    <strong>Transfer Bank:</strong><br>
                                    Bank: BCA<br>
                                    Nomor Rekening: 1234567890<br>
                                    Atas Nama: BreadSMG<br>
                                    Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                                </div>
                            @else
                                <div class="alert alert-success rounded-3 mb-4">
                                    <i class="bi bi-wallet2 me-2"></i>
                                    <strong>E-Wallet:</strong><br>
                                    Silakan lakukan pembayaran melalui E-Wallet pilihan Anda.
                                </div>
                            @endif

                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="bi bi-house me-2"></i>Kembali ke Home
                                </a>
                                <button type="button" class="btn btn-primary rounded-pill px-4" onclick="window.print()">
                                    <i class="bi bi-printer me-2"></i>Cetak Nota
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Section End -->


    <!-- Order Details Section -->
    <div class="container-xxl py-6 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card rounded-4 shadow-sm border-0">
                        <div class="card-header bg-transparent border-0 px-4 py-3">
                            <h5 class="mb-0">Detail Pesanan</h5>
                        </div>
                        <div class="card-body p-4 pt-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-end">Harga</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        @if($item->product && $item->product->image)
                                                            <img src="{{ asset('images/menus/' . $item->product->image) }}" alt=""
                                                                width="50" height="50" class="rounded-3" style="object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                                                style="width: 50px; height: 50px;">
                                                                <i class="material-icons-outlined text-muted">restaurant_menu</i>
                                                            </div>
                                                        @endif
                                                        <span>{{ $item->product ? $item->product->name : 'Produk Dihapus' }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $item->qty }}</td>
                                                <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                            <td class="text-end"><strong>Rp
                                                    {{ number_format($order->total, 0, ',', '.') }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h6>Informasi Pelanggan</h6>
                                    <table class="table table-sm">
                                        <tr>
                                            <td class="text-muted">Nama</td>
                                            <td>{{ $order->customer_name }}</td>
                                        </tr>
                                        @if($order->email)
                                            <tr>
                                                <td class="text-muted">Email</td>
                                                <td>{{ $order->email }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="text-muted">Telepon</td>
                                            <td>{{ $order->phone }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6>Informasi Pengiriman</h6>
                                    <p class="text-muted">{{ $order->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection