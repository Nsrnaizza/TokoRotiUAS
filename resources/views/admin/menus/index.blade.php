@extends('layouts.admin')

@section('title', 'Kelola Menu - BreadSMG Admin')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Menu</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Kelola Menu</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary rounded-3">
            <i class="material-icons-outlined me-2">add</i>Tambah Menu
        </a>
    </div>
</div>
<!--end breadcrumb-->

<div class="card rounded-4 shadow-sm border-0">
    <div class="card-header bg-transparent border-0 px-4 py-3">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Daftar Menu</h5>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm rounded-3" id="categoryFilter" onchange="filterByCategory()">
                    <option value="">Semua Kategori</option>
                    <option value="Roti" {{ request()->category == 'Roti' ? 'selected' : '' }}>Roti</option>
                    <option value="Kue" {{ request()->category == 'Kue' ? 'selected' : '' }}>Kue</option>
                    <option value="Cookies" {{ request()->category == 'Cookies' ? 'selected' : '' }}>Cookies</option>
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

        @if($menus->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="menusTable">
                <thead class="table-light">
                    <tr>
                        <th width="80">Gambar</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td>
                            @if($menu->image)
                                <img src="{{ asset('images/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="rounded-3" width="60" height="60" style="object-fit: cover;">
                            @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="material-icons-outlined text-muted">restaurant_menu</i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $menu->name }}</strong></td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-3">{{ $menu->category ?? '-' }}</span>
                        </td>
                        <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="text-muted">{{ Str::limit($menu->description, 50) }}</span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-outline-primary btn-sm rounded-3" title="Edit">
                                    <i class="material-icons-outlined fs-6">edit</i>
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-3" title="Hapus" onclick="confirmDelete({{ $menu->id }}, '{{ $menu->name }}')">
                                    <i class="material-icons-outlined fs-6">delete</i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $menu->id }}" action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $menus->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="material-icons-outlined text-muted" style="font-size: 64px;">restaurant_menu</i>
            <p class="text-muted mt-3 mb-4">Belum ada menu</p>
            <a href="{{ route('admin.menus.create') }}" class="btn btn-primary rounded-3">
                <i class="material-icons-outlined me-2">add</i>Tambah Menu Pertama
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus menu <strong id="deleteMenuName"></strong>?</p>
                <p class="text-muted mb-0">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger rounded-3" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function filterByCategory() {
        const category = document.getElementById('categoryFilter').value;
        window.location.href = '{{ route('admin.menus.index') }}' + (category ? '?category=' + category : '');
    }

    let deleteId = null;

    function confirmDelete(id, name) {
        deleteId = id;
        document.getElementById('deleteMenuName').textContent = name;
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteId) {
            document.getElementById('delete-form-' + deleteId).submit();
        }
    });
</script>
@endpush
@endsection
