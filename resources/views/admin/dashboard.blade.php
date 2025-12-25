@extends('layouts.admin')

@section('content')
<div class="mb-5">
    <h2 class="fw-bold">Dashboard</h2>
    <p style="color: var(--text-muted);">Selamat datang kembali, Admin.</p>
</div>

<div class="row g-4">
    <div class="col-12 col-md-4">
        <div class="card h-100 p-3">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 60px; height: 60px; background-color: rgba(197, 160, 40, 0.2);">
                    <i class="bi bi-calendar-check fs-3" style="color: var(--gold-primary);"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold mb-1" style="color: var(--text-muted);">Reservasi Hari Ini
                    </h6>
                    <h2 class="fw-bold m-0">{{ $reservasiHariIni ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card h-100 p-3">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 60px; height: 60px; background-color: rgba(13, 110, 253, 0.1);">
                    <i class="bi bi-scissors text-primary fs-3"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold mb-1" style="color: var(--text-muted);">Total Layanan</h6>
                    <h2 class="fw-bold m-0">{{ $totalLayanan ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card h-100 p-3">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 60px; height: 60px; background-color: rgba(25, 135, 84, 0.1);">
                    <i class="bi bi-people text-success fs-3"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold mb-1" style="color: var(--text-muted);">Total Barber</h6>
                    <h2 class="fw-bold m-0">{{ $totalBarber ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection