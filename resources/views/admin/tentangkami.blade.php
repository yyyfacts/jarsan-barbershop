@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    {{-- ALERT SUKSES --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show fw-bold" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <h3 class="fw-bold mb-4">Edit Halaman Tentang Kami</h3>

    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="row g-4">
            {{-- KOLOM SEJARAH --}}
            <div class="col-md-6">
                <div class="card p-4 border-0 shadow-sm h-100">
                    <h5 class="fw-bold mb-3 text-primary">Bagian Sejarah</h5>

                    <label class="form-label fw-bold">Konten Sejarah</label>
                    <textarea name="history" rows="6" class="form-control mb-3">{{ $about->history ?? '' }}</textarea>

                    <label class="form-label fw-bold">Gambar Background Sejarah</label>
                    <input type="file" name="history_image" class="form-control mb-3" accept="image/*">

                    {{-- PREVIEW GAMBAR --}}
                    @if($about->history_image)
                    <div class="mt-2">
                        <small class="d-block text-muted mb-1">Gambar Saat Ini:</small>
                        <img src="{{ $about->history_image }}" class="img-fluid rounded shadow-sm"
                            style="max-height: 200px; width: 100%; object-fit: cover;">
                    </div>
                    @endif
                </div>
            </div>

            {{-- KOLOM MISI --}}
            <div class="col-md-6">
                <div class="card p-4 border-0 shadow-sm h-100">
                    <h5 class="fw-bold mb-3 text-warning">Bagian Misi</h5>

                    <label class="form-label fw-bold">Konten Misi</label>
                    <textarea name="mission" rows="6" class="form-control mb-3">{{ $about->mission ?? '' }}</textarea>

                    <label class="form-label fw-bold">Gambar Background Misi</label>
                    <input type="file" name="mission_image" class="form-control mb-3" accept="image/*">

                    {{-- PREVIEW GAMBAR --}}
                    @if($about->mission_image)
                    <div class="mt-2">
                        <small class="d-block text-muted mb-1">Gambar Saat Ini:</small>
                        <img src="{{ $about->mission_image }}" class="img-fluid rounded shadow-sm"
                            style="max-height: 200px; width: 100%; object-fit: cover;">
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-success px-5 fw-bold btn-lg">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection