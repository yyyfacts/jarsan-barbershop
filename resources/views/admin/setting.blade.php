@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Pengaturan Website</h3>
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
                        <label class="form-label d-block small fw-bold mb-3 text-uppercase"
                            style="color: var(--text-muted);">Logo Saat Ini</label>
                        <div class="d-inline-block p-3 border rounded" style="background-color: var(--bg-body);">
                            {{-- PERBAIKAN: Gunakan $setting (tunggal) --}}
                            @if($setting && $setting->logo_path)
                            <img src="{{ $setting->logo_path }}" class="shadow-sm object-fit-contain"
                                style="max-height: 100px; max-width: 100%;">
                            @else
                            <img src="https://ui-avatars.com/api/?name=Jarsan&background=C5A028&color=fff"
                                class="shadow-sm" style="max-height: 100px;">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small" style="color: var(--text-muted);">Nama Website</label>
                        {{-- PERBAIKAN: Gunakan $setting (tunggal) --}}
                        <input type="text" name="app_name" class="form-control"
                            value="{{ $setting->app_name ?? 'Jarsan Barbershop' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small" style="color: var(--text-muted);">Upload Logo
                            Baru</label>
                        <input type="file" name="logo" class="form-control">
                        <div class="form-text" style="color: var(--text-muted);">Format: JPG, PNG. Maksimal 2MB.</div>
                    </div>

                    <hr class="my-4" style="border-color: var(--border-color);">

                    <button type="submit" class="btn btn-gold w-100">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection