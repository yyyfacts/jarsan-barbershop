@extends('layouts.admin')

@section('content')
<div class="text-center mb-5">
    <h3 class="fw-bold m-0">Pengaturan Website</h3>
    <p class="small text-muted">Sesuaikan identitas dan logo aplikasi Anda di sini.</p>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4 col-md-6 mx-auto">
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<div class="row justify-content-center">
    <div class="col-12 col-md-6">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-transparent border-bottom py-3">
                <h6 class="fw-bold m-0 text-uppercase text-muted small"><i class="bi bi-gear-fill me-2"></i>Edit
                    Identitas</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-4 text-center">
                        <label class="form-label d-block small fw-bold mb-2 text-muted">LOGO SAAT INI</label>
                        <div class="d-inline-block p-3 border rounded bg-light position-relative">
                            @if($setting && $setting->logo_path)
                            <img src="{{ $setting->logo_path }}" class="img-fluid object-fit-contain"
                                style="max-height: 80px; max-width: 150px;">
                            @else
                            <img src="https://ui-avatars.com/api/?name=Jarsan&background=C5A028&color=fff"
                                class="img-fluid" style="max-height: 80px;">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">NAMA WEBSITE</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-globe"></i></span>
                            <input type="text" name="app_name" class="form-control border-start-0 ps-0"
                                value="{{ $setting->app_name ?? 'Jarsan Barbershop' }}" required
                                placeholder="Contoh: Jarsan Barbershop">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">UPLOAD LOGO BARU</label>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                        <div class="form-text small mt-1"><i class="bi bi-info-circle me-1"></i>Format JPG/PNG, Maksimal
                            2MB.</div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <button type="submit" class="btn btn-gold w-100 py-2 fw-bold shadow-sm">
                        <i class="bi bi-check2-circle me-2"></i> SIMPAN PERUBAHAN
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection