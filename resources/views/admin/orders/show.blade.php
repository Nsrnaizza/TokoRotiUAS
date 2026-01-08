@extends('layouts.admin')

@section('title', 'Detail Pesanan - BreadSMG Admin')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pesanan</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Kelola Pesanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary rounded-3">
                <i class="material-icons-outlined me-2">arrow_back</i>Kembali
            </a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row g-3">
        <!-- Order Details -->
        <div class="col-lg-8">
            <div class="card rounded-4 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 px-4 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Pesanan #{{ $order->nota }}</h5>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark rounded-3">Pending</span>
                        @elseif($order->status == 'processing')
                            <span class="badge bg-info text-white rounded-3">Diproses</span>
                        @elseif($order->status == 'completed')
                            <span class="badge bg-success rounded-3">Selesai</span>
                        @else
                            <span class="badge bg-danger rounded-3">Dibatalkan</span>
                        @endif
                    </div>
                </div>
                <div class="card-body p-4 pt-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Qty</th>
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
                                                <div>
                                                    <strong>{{ $item->product ? $item->product->name : 'Produk Dihapus' }}</strong>
                                                    @if($item->product && $item->product->category)
                                                        <br><small class="text-muted">{{ $item->product->category }}</small>
                                                    @endif
                                                </div>
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
                                    <td class="text-end"><strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Info & Actions -->
        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="card rounded-4 shadow-sm border-0 mb-3">
                <div class="card-header bg-transparent border-0 px-4 py-3">
                    <h5 class="mb-0">Informasi Pelanggan</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <div class="d-flex flex-column gap-3">
                        <div>
                            <label class="text-muted small mb-1">Nama</label>
                            <p class="mb-0 fw-semibold">{{ $order->customer_name }}</p>
                        </div>
                        @if($order->email)
                            <div>
                                <label class="text-muted small mb-1">Email</label>
                                <p class="mb-0">{{ $order->email }}</p>
                            </div>
                        @endif
                        @if($order->phone)
                            <div>
                                <label class="text-muted small mb-1">Telepon</label>
                                <p class="mb-0">{{ $order->phone }}</p>
                            </div>
                        @endif
                        @if($order->address)
                            <div>
                                <label class="text-muted small mb-1">Alamat</label>
                                <p class="mb-0">{{ $order->address }}</p>
                            </div>
                        @endif
                        <div>
                            <label class="text-muted small mb-1">Tanggal Pesan</label>
                            <p class="mb-0">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        @if($order->payment_method)
                            <div>
                                <label class="text-muted small mb-1">Metode Pembayaran</label>
                                <p class="mb-0">{{ $order->payment_method }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Update Status -->
            <div class="card rounded-4 shadow-sm border-0 mb-3">
                <div class="card-header bg-transparent border-0 px-4 py-3">
                    <h5 class="mb-0">Update Status</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Status Pesanan</label>
                            <select class="form-select rounded-3 @error('status') is-invalid @enderror" name="status"
                                required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses
                                </option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : 'cancelled' }}>
                                    Dibatalkan</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control rounded-3" name="notes" rows="3"
                                placeholder="Catatan pesanan...">{{ $order->notes ?? '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-3">
                            <i class="material-icons-outlined me-2">save</i>Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Print Invoice -->
            <div class="card rounded-4 shadow-sm border-0">
                <div class="card-body p-4 pt-0">
                    <button type="button" class="btn btn-outline-primary w-100 rounded-3" onclick="window.print()">
                        <i class="material-icons-outlined me-2">print</i>Cetak Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection