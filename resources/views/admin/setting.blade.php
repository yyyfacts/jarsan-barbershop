@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark m-0">Pengaturan Website</h3>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<div class="row">
    <div class="col-12 col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-4 text-center">
                        <label class="form-label d-block text-muted small fw-bold mb-3">LOGO SAAT INI</label>
                        <div class="d-inline-block p-3 border rounded bg-light">
                            @if($setting && $setting->logo_path)
                            <img src="{{ $setting->logo_path }}" class="object-fit-contain shadow-sm"
                                style="max-height: 100px; max-width: 100%;">
                            @else
                            <img src="https://ui-avatars.com/api/?name=Jarsan&background=C5A028&color=fff"
                                class="shadow-sm" style="max-height: 100px;">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Website</label>
                        <input type="text" name="app_name" class="form-control"
                            value="{{ $setting->app_name ?? 'Jarsan Barbershop' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Logo Baru</label>
                        <input type="file" name="logo" class="form-control">
                        <div class="form-text text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB.</div>
                    </div>

                    <hr class="my-4">

                    <button type="submit" class="btn btn-gold w-100">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection