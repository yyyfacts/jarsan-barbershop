@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark m-0">Edit "Tentang Kami"</h3>
        <p class="text-muted small">Perbarui informasi sejarah dan visi misi barbershop.</p>
    </div>
    <button type="submit" form="aboutForm" class="btn btn-gold shadow-sm px-4">
        <i class="bi bi-save me-2"></i> Simpan Perubahan
    </button>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<form id="aboutForm" action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="fw-bold m-0 text-dark"><i class="bi bi-clock-history me-2 text-warning"></i>Sejarah</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Konten Teks</label>
                        <textarea name="history" rows="10" class="form-control"
                            placeholder="Tulis sejarah barbershop...">{{ $about->history ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Gambar Sejarah</label>
                        <input type="file" name="history_image" class="form-control mb-3">

                        @if($about->history_image)
                        <div class="p-2 border rounded bg-light text-center">
                            <img src="{{ $about->history_image }}" class="img-fluid rounded shadow-sm"
                                style="max-height: 200px;">
                            <div class="small text-muted mt-1">Gambar saat ini</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="fw-bold m-0 text-dark"><i class="bi bi-bullseye me-2 text-danger"></i>Visi & Misi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Konten Teks</label>
                        <textarea name="mission" rows="10" class="form-control"
                            placeholder="Tulis visi dan misi...">{{ $about->mission ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Gambar Visi Misi</label>
                        <input type="file" name="mission_image" class="form-control mb-3">

                        @if($about->mission_image)
                        <div class="p-2 border rounded bg-light text-center">
                            <img src="{{ $about->mission_image }}" class="img-fluid rounded shadow-sm"
                                style="max-height: 200px;">
                            <div class="small text-muted mt-1">Gambar saat ini</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection