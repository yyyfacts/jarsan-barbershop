@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold m-0">Edit "Tentang Kami"</h3>
        <p class="small" style="color: var(--text-muted);">Perbarui konten profil perusahaan.</p>
    </div>
    <button type="submit" form="aboutForm" class="btn btn-gold shadow-sm px-4">
        <i class="bi bi-save me-2"></i> Simpan Perubahan
    </button>
</div>

<form id="aboutForm" action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="card h-100 border-0">
                <div class="card-header border-bottom py-3"
                    style="background-color: var(--bg-card); border-color: var(--border-color);">
                    <h5 class="fw-bold m-0"><i class="bi bi-clock-history me-2 text-warning"></i>Sejarah</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold" style="color: var(--text-muted);">KONTEN TEKS</label>
                        <textarea name="history" rows="10" class="form-control"
                            placeholder="Tulis sejarah barbershop...">{{ $about->history ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold" style="color: var(--text-muted);">GAMBAR SEJARAH</label>
                        <input type="file" name="history_image" class="form-control mb-3">

                        @if($about->history_image)
                        <div class="p-2 border rounded text-center"
                            style="background-color: var(--bg-body); border-color: var(--border-color) !important;">
                            <img src="{{ $about->history_image }}" class="img-fluid rounded shadow-sm"
                                style="max-height: 200px;">
                            <div class="small mt-1" style="color: var(--text-muted);">Gambar saat ini</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 border-0">
                <div class="card-header border-bottom py-3"
                    style="background-color: var(--bg-card); border-color: var(--border-color);">
                    <h5 class="fw-bold m-0"><i class="bi bi-bullseye me-2 text-danger"></i>Visi & Misi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold" style="color: var(--text-muted);">KONTEN TEKS</label>
                        <textarea name="mission" rows="10" class="form-control"
                            placeholder="Tulis visi dan misi...">{{ $about->mission ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold" style="color: var(--text-muted);">GAMBAR VISI
                            MISI</label>
                        <input type="file" name="mission_image" class="form-control mb-3">

                        @if($about->mission_image)
                        <div class="p-2 border rounded text-center"
                            style="background-color: var(--bg-body); border-color: var(--border-color) !important;">
                            <img src="{{ $about->mission_image }}" class="img-fluid rounded shadow-sm"
                                style="max-height: 200px;">
                            <div class="small mt-1" style="color: var(--text-muted);">Gambar saat ini</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection