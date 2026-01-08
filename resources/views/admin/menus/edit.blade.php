@extends('layouts.admin')

@section('title', 'Edit Menu - BreadSMG Admin')

@push('styles')
    <style>
        .image-preview {
            width: 100%;
            max-width: 300px;
            height: 200px;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            overflow: hidden;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Menu</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.menus.index') }}">Kelola Menu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Menu</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card rounded-4 shadow-sm border-0">
        <div class="card-header bg-transparent border-0 px-4 py-3">
            <h5 class="mb-0">Edit Menu</h5>
        </div>
        <div class="card-body p-4 pt-0">
            <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Gambar Menu</label>
                            <div class="image-preview mb-2" id="imagePreview">
                                @if($menu->image)
                                    <img src="{{ asset('images/menus/' . $menu->image) }}" alt="{{ $menu->name }}">
                                @else
                                    <i class="material-icons-outlined text-muted"
                                        style="font-size: 48px;">add_photo_alternate</i>
                                @endif
                            </div>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                                id="imageInput" accept="image/*" onchange="previewImage(event)">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB. Biarkan kosong jika tidak ingin
                                mengubah gambar.</small>

                            @if($menu->image)
                                <div class="mt-2">
                                    <input type="checkbox" name="remove_image" id="remove_image" value="1">
                                    <label for="remove_image" class="text-danger">Hapus gambar</label>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label">Nama Menu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3 @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $menu->name) }}" placeholder="例: Roti Tawar" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3 @error('category') is-invalid @enderror" name="category"
                                required>
                                <option value="">Pilih Kategori</option>
                                <option value="Roti" {{ old('category', $menu->category) == 'Roti' ? 'selected' : '' }}>Roti
                                </option>
                                <option value="Kue" {{ old('category', $menu->category) == 'Kue' ? 'selected' : '' }}>Kue
                                </option>
                                <option value="Cookies" {{ old('category', $menu->category) == 'Cookies' ? 'selected' : '' }}>
                                    Cookies</option>
                                <option value="Lainnya" {{ old('category', $menu->category) == 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3">Rp</span>
                                <input type="number" class="form-control rounded-end-3 @error('price') is-invalid @enderror"
                                    name="price" value="{{ old('price', $menu->price) }}" min="0" step="100" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control rounded-3 @error('description') is-invalid @enderror"
                                name="description" rows="4"
                                placeholder="Deskripsi menu...">{{ old('description', $menu->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary rounded-3">
                        <i class="material-icons-outlined me-2">arrow_back</i>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary rounded-3">
                        <i class="material-icons-outlined me-2">save</i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(event) {
                const preview = document.getElementById('imagePreview');
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
                    };
                    reader.readAsDataURL(file);
                } else {
                    @if($menu->image)
                        preview.innerHTML = '<img src="{{ asset('images/menus/' . $menu->image) }}" alt="{{ $menu->name }}">';
                    @else
                        preview.innerHTML = '<i class="material-icons-outlined text-muted" style="font-size: 48px;">add_photo_alternate</i>';
                    @endif
                }
            }
        </script>
    @endpush
@endsection