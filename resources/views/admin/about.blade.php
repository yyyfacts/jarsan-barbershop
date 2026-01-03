@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold m-0 text-dark">Edit Halaman "About Us"</h3>
        <p class="small text-muted">Kelola semua teks dan gambar yang tampil di halaman Tentang Kami.</p>
    </div>
    {{-- Tombol Save untuk submit form di bawah --}}
    <button type="submit" form="aboutForm" class="btn btn-warning fw-bold shadow-sm px-4">
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

    {{-- 1. HERO SECTION (BANNER ATAS) --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="fw-bold m-0 text-dark"><i class="bi bi-image me-2"></i>1. Banner Atas (Hero Section)</h6>
        </div>
        <div class="card-body p-4 row g-3">
            <div class="col-md-6">
                <label class="form-label small fw-bold text-muted">JUDUL KECIL (TAGLINE)</label>
                <input type="text" name="hero_subtitle" class="form-control"
                    value="{{ $about->hero_subtitle ?? 'THE HERITAGE' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-bold text-muted">JUDUL BESAR (HERO TITLE)</label>
                <input type="text" name="hero_title" class="form-control"
                    value="{{ $about->hero_title ?? 'CRAFTING CONFIDENCE' }}">
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        {{-- 2. HISTORY SECTION --}}
        <div class="col-12 col-lg-6">
            <div class="card h-100 border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold m-0 text-primary"><i class="bi bi-clock-history me-2"></i>2. Sejarah (History)
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">CERITA SEJARAH</label>
                        <textarea name="history" rows="6" class="form-control">{{ $about->history ?? '' }}</textarea>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">TAHUN BERDIRI</label>
                            <input type="text" name="founded_year" class="form-control"
                                value="{{ $about->founded_year ?? 'Est. 2024' }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">TEKS KECIL</label>
                            <input type="text" name="founded_text" class="form-control"
                                value="{{ $about->founded_text ?? 'FOUNDED IN EXCELLENCE' }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">FOTO SEJARAH</label>
                        <input type="file" name="history_image" class="form-control" accept="image/*">

                        @if($about && $about->history_image)
                        <div class="mt-2 text-center p-2 bg-light border rounded">
                            <small class="d-block text-muted mb-1">Gambar Saat Ini:</small>
                            <img src="{{ $about->history_image }}" class="img-fluid rounded" style="max-height: 120px;">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. PHILOSOPHY SECTION --}}
        <div class="col-12 col-lg-6">
            <div class="card h-100 border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold m-0 text-danger"><i class="bi bi-bullseye me-2"></i>3. Filosofi & Misi</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">JUDUL KECIL</label>
                        <input type="text" name="philosophy_title" class="form-control"
                            value="{{ $about->philosophy_title ?? 'OUR PHILOSOPHY' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">KUTIPAN UTAMA (QUOTE)</label>
                        <input type="text" name="philosophy_quote" class="form-control"
                            value="{{ $about->philosophy_quote ?? 'Misi Kami Adalah Presisi' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">ISI MISI / PENJELASAN</label>
                        <textarea name="mission" rows="4" class="form-control">{{ $about->mission ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">BACKGROUND IMAGE</label>
                        <input type="file" name="mission_image" class="form-control" accept="image/*">

                        @if($about && $about->mission_image)
                        <div class="mt-2 text-center p-2 bg-light border rounded">
                            <small class="d-block text-muted mb-1">Gambar Saat Ini:</small>
                            <img src="{{ $about->mission_image }}" class="img-fluid rounded" style="max-height: 120px;">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. WHY CHOOSE US --}}
    <div class="card border-0 shadow-sm rounded-3 mb-5">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="fw-bold m-0 text-dark"><i class="bi bi-star me-2"></i>4. Bagian "Why Choose Us"</h6>
        </div>
        <div class="card-body p-4">
            <div class="mb-4">
                <label class="form-label small fw-bold text-muted">JUDUL BAGIAN</label>
                <input type="text" name="why_title" class="form-control fw-bold"
                    value="{{ $about->why_title ?? 'WHY CHOOSE THE BEST?' }}">
            </div>

            <div class="row g-3">
                {{-- CARD 1 --}}
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded border h-100">
                        <span class="badge bg-secondary mb-2">KARTU 1</span>
                        <input type="text" name="why_1_title" class="form-control form-control-sm mb-2 fw-bold"
                            placeholder="Judul Kartu 1" value="{{ $about->why_1_title ?? '' }}">
                        <textarea name="why_1_desc" class="form-control form-control-sm" rows="3"
                            placeholder="Deskripsi Kartu 1">{{ $about->why_1_desc ?? '' }}</textarea>
                    </div>
                </div>
                {{-- CARD 2 --}}
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded border h-100">
                        <span class="badge bg-secondary mb-2">KARTU 2</span>
                        <input type="text" name="why_2_title" class="form-control form-control-sm mb-2 fw-bold"
                            placeholder="Judul Kartu 2" value="{{ $about->why_2_title ?? '' }}">
                        <textarea name="why_2_desc" class="form-control form-control-sm" rows="3"
                            placeholder="Deskripsi Kartu 2">{{ $about->why_2_desc ?? '' }}</textarea>
                    </div>
                </div>
                {{-- CARD 3 --}}
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded border h-100">
                        <span class="badge bg-secondary mb-2">KARTU 3</span>
                        <input type="text" name="why_3_title" class="form-control form-control-sm mb-2 fw-bold"
                            placeholder="Judul Kartu 3" value="{{ $about->why_3_title ?? '' }}">
                        <textarea name="why_3_desc" class="form-control form-control-sm" rows="3"
                            placeholder="Deskripsi Kartu 3">{{ $about->why_3_desc ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection