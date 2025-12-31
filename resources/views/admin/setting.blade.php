@extends('layouts.admin')

@section('content')
<div class="text-center mb-5">
    <h3 class="fw-bold m-0 text-dark">Pengaturan Website</h3>
    <p class="small text-muted">Sesuaikan identitas, logo, dan kontak media sosial aplikasi.</p>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4 col-md-8 mx-auto">
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold m-0 text-uppercase small text-muted">
                    <i class="bi bi-gear-fill me-2"></i>Form Pengaturan
                </h6>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    {{-- --- LOGO PREVIEW --- --}}
                    <div class="mb-4 text-center">
                        <label class="form-label d-block small fw-bold mb-3 text-muted">LOGO SAAT INI</label>
                        <div class="d-inline-block p-3 border rounded bg-light">
                            @if($setting && $setting->logo_path)
                            <img src="{{ $setting->logo_path }}" class="img-fluid object-fit-contain"
                                style="max-height: 80px; max-width: 150px;">
                            @else
                            <div class="fw-bold text-muted p-3">Belum ada logo</div>
                            @endif
                        </div>
                    </div>

                    {{-- --- IDENTITAS WEB --- --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">NAMA WEBSITE</label>
                            <input type="text" name="app_name" class="form-control"
                                value="{{ $setting->app_name ?? 'Jarsan Barbershop' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">UPLOAD LOGO BARU</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    {{-- --- SOSIAL MEDIA --- --}}
                    <h6 class="fw-bold text-uppercase small text-muted mb-3"><i class="bi bi-share me-1"></i> Sosial
                        Media</h6>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">LINK INSTAGRAM</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-instagram text-danger"></i></span>
                            <input type="url" name="instagram_link" class="form-control"
                                value="{{ $setting->instagram_link ?? '' }}"
                                placeholder="https://instagram.com/username">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">LINK TIKTOK</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-tiktok text-dark"></i></span>
                            <input type="url" name="tiktok_link" class="form-control"
                                value="{{ $setting->tiktok_link ?? '' }}" placeholder="https://tiktok.com/@username">
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    {{-- --- GOOGLE MAPS --- --}}
                    <h6 class="fw-bold text-uppercase small text-muted mb-3"><i class="bi bi-geo-alt me-1"></i> Lokasi
                        Peta</h6>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">GOOGLE MAPS EMBED CODE (HTML)</label>
                        <textarea name="maps_embed" class="form-control font-monospace small" rows="5"
                            placeholder='<iframe src="https://www.google.com/maps/embed?...'>{{ $setting->maps_embed ?? '' }}</textarea>

                        <div
                            class="alert alert-info d-flex align-items-start mt-2 py-2 px-3 small border-0 bg-light text-muted">
                            <i class="bi bi-info-circle-fill me-2 mt-1 text-primary"></i>
                            <div>
                                <strong>Cara mendapatkan kode:</strong><br>
                                1. Buka Google Maps di browser laptop/PC.<br>
                                2. Cari lokasi barbershop Anda.<br>
                                3. Klik tombol <strong>Share</strong> (Bagikan) -> Pilih tab <strong>Embed a
                                    map</strong> (Sematkan peta).<br>
                                4. Klik <strong>Copy HTML</strong> lalu paste di kolom di atas.
                            </div>
                        </div>
                    </div>

                    {{-- --- TOMBOL SIMPAN --- --}}
                    <button type="submit" class="btn btn-warning w-100 py-3 fw-bold text-dark mt-3 shadow-sm">
                        <i class="bi bi-save me-2"></i> SIMPAN SEMUA PENGATURAN
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection