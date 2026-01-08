@extends('layouts.admin')

@section('title', 'Kelola Pesanan - BreadSMG Admin')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Pesanan</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Kelola Pesanan</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card rounded-4 shadow-sm border-0">
    <div class="card-header bg-transparent border-0 px-4 py-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <h5 class="mb-0">Daftar Pesanan</h5>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm rounded-3" id="statusFilter" onchange="filterByStatus()">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request()->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                    <option value="completed" {{ request()->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request()->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body p-4 pt-0">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="material-icons-outlined me-2">check_circle</i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No. Nota</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td><strong>{{ $order->nota }}</strong></td>
                        <td>
                            <div>
                                <strong>{{ $order->customer_name }}</strong>
                                @if($order->phone)
                                <br><small class="text-muted">{{ $order->phone }}</small>
                                @endif
                            </div>
                        </td>
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
                        <td>{{ $order->payment_method ?? '-' }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm rounded-3" title="Lihat Detail">
                                    <i class="material-icons-outlined fs-6">visibility</i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="material-icons-outlined text-muted" style="font-size: 64px;">shopping_bag</i>
            <p class="text-muted mt-3">Belum ada pesanan</p>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function filterByStatus() {
        const status = document.getElementById('statusFilter').value;
        window.location.href = '{{ route('admin.orders.index') }}' + (status ? '?status=' + status : '');
    }
</script>
@endpush
@endsection
