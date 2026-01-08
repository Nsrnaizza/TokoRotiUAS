@extends('layouts.admin')

@section('title', 'Dashboard - BreadSMG Admin')

@push('styles')
    <style>
        .stat-card {
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row g-3">
        <!-- Statistics Cards -->
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-0 text-muted">Total Menu</p>
                            <h4 class="mb-0 fw-bold">{{ $menuCount }}</h4>
                        </div>
                        <div
                            class="wh-42 d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10">
                            <i class="material-icons-outlined text-primary">restaurant_menu</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-0 text-muted">Total Pesanan</p>
                            <h4 class="mb-0 fw-bold">{{ $orderCount }}</h4>
                        </div>
                        <div
                            class="wh-42 d-flex align-items-center justify-content-center rounded-3 bg-success bg-opacity-10">
                            <i class="material-icons-outlined text-success">shopping_bag</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-0 text-muted">Pesanan Pending</p>
                            <h4 class="mb-0 fw-bold">{{ $pendingCount }}</h4>
                        </div>
                        <div
                            class="wh-42 d-flex align-items-center justify-content-center rounded-3 bg-warning bg-opacity-10">
                            <i class="material-icons-outlined text-warning">pending</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-0 text-muted">Total Pendapatan</p>
                            <h4 class="mb-0 fw-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                        </div>
                        <div class="wh-42 d-flex align-items-center justify-content-center rounded-3 bg-info bg-opacity-10">
                            <i class="material-icons-outlined text-info">payments</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-3">
        <!-- Recent Orders -->
        <div class="col-lg-12">
            <div class="card rounded-4 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 px-4 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Pesanan Terbaru</h5>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm rounded-3">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body p-4 pt-0">
                    @if($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No. Nota</th>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        <tr>
                                            <td><strong>{{ $order->nota }}</strong></td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                            <td>
                                                @if($order->status == 'pending')
                                                    <span class="badge bg-warning text-dark rounded-3">Pending</span>
                                                @elseif($order->status == 'processing')
                                                    <span class="badge bg-info text-white rounded-3">Diproses</span>
                                                @elseif($order->status == 'completed')
                                                    <span class="badge bg-success rounded-3">Selesai</span>
                                                @else
                                                    <span class="badge bg-danger rounded-3">Dibatalkan</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="btn btn-outline-primary btn-sm rounded-3">
                                                    <i class="material-icons-outlined fs-6">visibility</i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="material-icons-outlined text-muted" style="font-size: 48px;">shopping_bag</i>
                            <p class="text-muted mt-3">Belum ada pesanan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-3">
        <!-- Quick Actions -->
        <div class="col-lg-6">
            <div class="card rounded-4 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 px-4 py-3">
                    <h5 class="mb-0">Aksi Cepat</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary rounded-3">
                            <i class="material-icons-outlined me-2">add</i>Tambah Menu
                        </a>
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-primary rounded-3">
                            <i class="material-icons-outlined me-2">restaurant_menu</i>Kelola Menu
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-success rounded-3">
                            <i class="material-icons-outlined me-2">shopping_bag</i>Kelola Pesanan
                        </a>
                        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-info rounded-3">
                            <i class="material-icons-outlined me-2">language</i>Lihat Website
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Categories -->
        <div class="col-lg-6">
            <div class="card rounded-4 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 px-4 py-3">
                    <h5 class="mb-0">Kategori Menu</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    @php
                        $categories = \App\Models\Menu::select('category')->distinct()->whereNotNull('category')->pluck('category');
                    @endphp
                    @if($categories->count() > 0)
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($categories as $category)
                                <span class="badge bg-primary rounded-3 px-3 py-2">{{ $category }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Belum ada kategori</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection