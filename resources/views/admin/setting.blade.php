@extends('layouts.admin')

@section('content')
<div class="text-center mb-5">
    <h3 class="fw-bold m-0 text-dark">Pengaturan Website</h3>
    <p class="small text-muted">Sesuaikan identitas, tampilan beranda, layanan, dan kontak.</p>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4 col-md-8 mx-auto">
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<div class="row justify-content-center">
    <div class="col-12 col-md-10">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold m-0 text-uppercase small text-muted">
                    <i class="bi bi-gear-fill me-2"></i>Form Pengaturan Lengkap
                </h6>
            </div>

            <div class="card-body p-4">
                {{-- Form dengan Multipart untuk upload file --}}
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- ================================================= --}}
                    {{-- 1. IDENTITAS & LOGO --}}
                    {{-- ================================================= --}}
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-person-badge me-2"></i>Identitas Website</h6>

                    <div class="row g-4 mb-4">
                        <div class="col-md-4 text-center">
                            <label class="form-label d-block small fw-bold mb-2 text-muted">LOGO SAAT INI</label>
                            <div class="p-3 border rounded bg-light d-flex align-items-center justify-content-center"
                                style="height: 120px;">
                                @if($setting && $setting->logo_path)
                                {{-- Logo menggunakan Base64 --}}
                                <img src="{{ $setting->logo_path }}" class="img-fluid object-fit-contain"
                                    style="max-height: 80px;">
                                @else
                                <span class="text-muted small">Belum ada logo</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">NAMA WEBSITE</label>
                                <input type="text" name="app_name" class="form-control"
                                    value="{{ $setting->app_name ?? 'Jarsan Barbershop' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">GANTI LOGO</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <hr class="my-5 opacity-25">

                    {{-- ================================================= --}}
                    {{-- 2. HERO SECTION (SLIDER GAMBAR) --}}
                    {{-- ================================================= --}}
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-images me-2"></i>Banner Slider (Hero Section)
                    </h6>

                    <div class="row g-3 mb-4">

                        {{-- GAMBAR SLIDE 1 (UTAMA) --}}
                        <div class="col-12 mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">GAMBAR SLIDE 1
                                (UTAMA)</label>
                            @if($setting && $setting->hero_image)
                            <div class="mb-2">
                                <img src="{{ $setting->hero_image }}" alt="Slide 1" class="img-thumbnail w-100"
                                    style="height: 150px; object-fit: cover;">
                            </div>
                            @endif
                            <input type="file" name="hero_image" class="form-control" accept="image/*">
                            <div class="form-text small text-muted">Gambar wajib diisi. Format: JPG/PNG/WEBP.</div>
                        </div>

                        {{-- GAMBAR SLIDE 2 --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">GAMBAR SLIDE 2
                                (OPSIONAL)</label>
                            @if($setting && $setting->hero_image_2)
                            <div class="mb-2">
                                <img src="{{ $setting->hero_image_2 }}" alt="Slide 2" class="img-thumbnail w-100"
                                    style="height: 150px; object-fit: cover;">
                            </div>
                            @endif
                            <input type="file" name="hero_image_2" class="form-control" accept="image/*">
                        </div>

                        {{-- GAMBAR SLIDE 3 --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">GAMBAR SLIDE 3
                                (OPSIONAL)</label>
                            @if($setting && $setting->hero_image_3)
                            <div class="mb-2">
                                <img src="{{ $setting->hero_image_3 }}" alt="Slide 3" class="img-thumbnail w-100"
                                    style="height: 150px; object-fit: cover;">
                            </div>
                            @endif
                            <input type="file" name="hero_image_3" class="form-control" accept="image/*">
                        </div>

                        {{-- TEXT CONTENT (GLOBAL) --}}
                        <div class="col-12 mt-3">
                            <label class="form-label small fw-bold text-muted">JUDUL UTAMA (HERO TITLE)</label>
                            <input type="text" name="hero_title" class="form-control font-monospace"
                                value="{{ $setting->hero_title ?? '' }}"
                                placeholder="Contoh: QUALITY <span class='text-gold'>Over</span> QUANTITY">
                            <div class="form-text small text-muted">
                                <i class="bi bi-code-slash me-1"></i> Mendukung HTML.
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-muted">DESKRIPSI (HERO SUBTITLE)</label>
                            <textarea name="hero_subtitle" class="form-control"
                                rows="2">{{ $setting->hero_subtitle ?? '' }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">TEKS TOMBOL</label>
                            <input type="text" name="hero_btn_text" class="form-control"
                                value="{{ $setting->hero_btn_text ?? 'BOOK APPOINTMENT' }}">
                        </div>
                    </div>

                    <hr class="my-5 opacity-25">

                    {{-- ================================================= --}}
                    {{-- 3. SERVICES SECTION (LAYANAN) --}}
                    {{-- ================================================= --}}
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-scissors me-2"></i>Bagian Layanan (Services)
                    </h6>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">JUDUL KECIL (SUBTEXT)</label>
                            <input type="text" name="services_subtext" class="form-control"
                                value="{{ $setting->services_subtext ?? 'WHAT WE OFFER' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">JUDUL BESAR (MAIN TITLE)</label>
                            <input type="text" name="services_title" class="form-control"
                                value="{{ $setting->services_title ?? 'EXCLUSIVE SERVICES' }}">
                        </div>
                    </div>

                    {{-- CARD 1 --}}
                    <div class="card bg-light border-0 p-3 mb-3">
                        <label class="fw-bold small mb-2 text-dark">KARTU LAYANAN 1 (KIRI)</label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="service_1_title" class="form-control form-control-sm mb-1"
                                    placeholder="Judul" value="{{ $setting->service_1_title ?? '' }}">
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="service_1_desc" class="form-control form-control-sm"
                                    placeholder="Deskripsi Singkat" value="{{ $setting->service_1_desc ?? '' }}">
                            </div>
                        </div>
                    </div>

                    {{-- CARD 2 --}}
                    <div class="card bg-light border-0 p-3 mb-3">
                        <label class="fw-bold small mb-2 text-dark">KARTU LAYANAN 2 (TENGAH)</label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="service_2_title" class="form-control form-control-sm mb-1"
                                    placeholder="Judul" value="{{ $setting->service_2_title ?? '' }}">
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="service_2_desc" class="form-control form-control-sm"
                                    placeholder="Deskripsi Singkat" value="{{ $setting->service_2_desc ?? '' }}">
                            </div>
                        </div>
                    </div>

                    {{-- CARD 3 --}}
                    <div class="card bg-light border-0 p-3 mb-4">
                        <label class="fw-bold small mb-2 text-dark">KARTU LAYANAN 3 (KANAN)</label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="service_3_title" class="form-control form-control-sm mb-1"
                                    placeholder="Judul" value="{{ $setting->service_3_title ?? '' }}">
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="service_3_desc" class="form-control form-control-sm"
                                    placeholder="Deskripsi Singkat" value="{{ $setting->service_3_desc ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <hr class="my-5 opacity-25">

                    {{-- ================================================= --}}
                    {{-- 4. TESTIMONIAL & KONTAK --}}
                    {{-- ================================================= --}}
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-chat-quote me-2"></i>Testimonial & Kontak</h6>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">JUDUL TESTIMONIAL</label>
                        <input type="text" name="testimonial_title" class="form-control"
                            value="{{ $setting->testimonial_title ?? 'VOICE OF GENTLEMEN' }}">
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">WHATSAPP</label>
                            <div class="input-group">
                                <span class="input-group-text bg-success text-white"><i
                                        class="bi bi-whatsapp"></i></span>
                                <input type="number" name="whatsapp_number" class="form-control"
                                    value="{{ $setting->whatsapp_number ?? '' }}" placeholder="628xxx">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">INSTAGRAM</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i
                                        class="bi bi-instagram text-danger"></i></span>
                                <input type="url" name="instagram_link" class="form-control"
                                    value="{{ $setting->instagram_link ?? '' }}"
                                    placeholder="https://instagram.com/...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">TIKTOK</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-white"><i class="bi bi-tiktok"></i></span>
                                <input type="url" name="tiktok_link" class="form-control"
                                    value="{{ $setting->tiktok_link ?? '' }}" placeholder="https://tiktok.com/...">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">GOOGLE MAPS EMBED</label>
                        <textarea name="maps_embed" class="form-control font-monospace small"
                            rows="3">{{ $setting->maps_embed ?? '' }}</textarea>
                    </div>

                    {{-- TOMBOL SIMPAN --}}
                    <div class="sticky-bottom bg-white py-3 border-top">
                        <button type="submit" class="btn btn-warning w-100 py-3 fw-bold text-dark shadow-sm">
                            <i class="bi bi-save me-2"></i> SIMPAN SEMUA PERUBAHAN
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection