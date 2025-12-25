@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">

        <div class="mb-4">
            <h3 class="fw-bold m-0">Pengaturan Website</h3>
            <p class="small" style="color: var(--text-muted);">Kelola identitas aplikasi dan logo.</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
        @endif

        <div class="card border-0">
            <div class="card-header border-bottom py-3" style="background-color: var(--bg-card);">
                <h5 class="fw-bold m-0">Identitas & Logo</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-4 text-center">
                        <label class="form-label d-block small fw-bold mb-3 text-uppercase"
                            style="color: var(--text-muted);">Logo Saat Ini</label>
                        <div class="d-inline-block p-3 border rounded" style="background-color: var(--bg-body);">
                            @if($settings && $settings->logo_path)
                            <img src="{{ $settings->logo_path }}"
                                style="max-height: 100px; width: auto; object-fit: contain;">
                            @else
                            <img src="https://ui-avatars.com/api/?name=Jarsan&background=C5A028&color=fff"
                                style="max-height: 100px;">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase" style="color: var(--text-muted);">Upload
                            Logo Baru</label>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                        <div class="form-text" style="color: var(--text-muted);">Format: PNG, JPG. Maksimal 2MB.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase" style="color: var(--text-muted);">Nama
                            Website</label>
                        <input type="text" name="app_name" class="form-control"
                            value="{{ $settings->app_name ?? 'Jarsan Barbershop' }}" required>
                    </div>

                    <hr class="my-4" style="border-color: var(--border-color);">

                    <button type="submit" class="btn btn-gold w-100 py-2">
                        <i class="bi bi-save me-2"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection