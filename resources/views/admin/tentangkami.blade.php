@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold">Edit Halaman Tentang Kami</h3>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show fw-bold shadow-sm" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="row g-4">
        {{-- KOLOM SEJARAH --}}
        <div class="col-12 col-md-6">
            <div class="card p-4 border-0 shadow-sm h-100">
                <div class="d-flex align-items-center mb-3 text-primary">
                    <i class="bi bi-clock-history fs-4 me-2"></i>
                    <h5 class="fw-bold m-0">Bagian Sejarah</h5>
                </div>

                <label class="form-label fw-bold">Konten Sejarah</label>
                <textarea name="history" rows="8" class="form-control mb-3"
                    placeholder="Tulis sejarah barbershop...">{{ $about->history ?? '' }}</textarea>

                <label class="form-label fw-bold">Gambar Background Sejarah</label>
                <input type="file" name="history_image" class="form-control mb-3" accept="image/*">

                @if($about->history_image)
                <div class="mt-2 p-2 border rounded">
                    <small class="d-block text-muted mb-1">Gambar Saat Ini:</small>
                    <img src="{{ $about->history_image }}" class="img-fluid rounded"
                        style="max-height: 200px; width: 100%; object-fit: cover;">
                </div>
                @endif
            </div>
        </div>

        {{-- KOLOM MISI --}}
        <div class="col-12 col-md-6">
            <div class="card p-4 border-0 shadow-sm h-100">
                <div class="d-flex align-items-center mb-3 text-warning">
                    <i class="bi bi-bullseye fs-4 me-2"></i>
                    <h5 class="fw-bold m-0">Bagian Misi</h5>
                </div>

                <label class="form-label fw-bold">Konten Misi</label>
                <textarea name="mission" rows="8" class="form-control mb-3"
                    placeholder="Tulis misi barbershop...">{{ $about->mission ?? '' }}</textarea>

                <label class="form-label fw-bold">Gambar Background Misi</label>
                <input type="file" name="mission_image" class="form-control mb-3" accept="image/*">

                @if($about->mission_image)
                <div class="mt-2 p-2 border rounded">
                    <small class="d-block text-muted mb-1">Gambar Saat Ini:</small>
                    <img src="{{ $about->mission_image }}" class="img-fluid rounded"
                        style="max-height: 200px; width: 100%; object-fit: cover;">
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-4 text-end">
        <button type="submit" class="btn btn-success px-5 fw-bold btn-lg w-100 w-md-auto shadow-sm">Simpan
            Perubahan</button>
    </div>
</form>
@endsection