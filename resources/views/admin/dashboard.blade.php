@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-end justify-content-between mb-5">
    <div>
        <h6 class="text-gold small-caps mb-1">Overview</h6>
        <h2 class="display-6 fw-bold text-white mb-0">Dashboard</h2>
    </div>
    <span class="text-muted small">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</span>
</div>

<div class="row g-4">
    <div class="col-12 col-md-4">
        <div class="card h-100 p-4 border-0 position-relative overflow-hidden"
            style="background: linear-gradient(145deg, #1a1a1a 0%, #0f0f0f 100%); border: 1px solid #2a2a2a;">
            <div class="position-absolute top-0 end-0 p-3 opacity-25">
                <i class="bi bi-calendar-check text-gold" style="font-size: 5rem; transform: rotate(-20deg);"></i>
            </div>
            <div class="position-relative z-1">
                <h6 class="text-muted small-caps mb-3">Reservasi Hari Ini</h6>
                <h1 class="display-4 fw-bold text-white mb-0">{{ $reservasiHariIni ?? 0 }}</h1>
                <p class="text-secondary small mt-2 mb-0">Jadwal menunggu konfirmasi</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card h-100 p-4 border-0 position-relative overflow-hidden"
            style="background: linear-gradient(145deg, #1a1a1a 0%, #0f0f0f 100%); border: 1px solid #2a2a2a;">
            <div class="position-absolute top-0 end-0 p-3 opacity-25">
                <i class="bi bi-scissors text-gold" style="font-size: 5rem; transform: rotate(-20deg);"></i>
            </div>
            <div class="position-relative z-1">
                <h6 class="text-muted small-caps mb-3">Total Layanan</h6>
                <h1 class="display-4 fw-bold text-white mb-0">{{ $totalLayanan ?? 0 }}</h1>
                <p class="text-secondary small mt-2 mb-0">Jenis potongan & servis tersedia</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card h-100 p-4 border-0 position-relative overflow-hidden"
            style="background: linear-gradient(145deg, #1a1a1a 0%, #0f0f0f 100%); border: 1px solid #2a2a2a;">
            <div class="position-absolute top-0 end-0 p-3 opacity-25">
                <i class="bi bi-people text-gold" style="font-size: 5rem; transform: rotate(-20deg);"></i>
            </div>
            <div class="position-relative z-1">
                <h6 class="text-muted small-caps mb-3">Total Barber</h6>
                <h1 class="display-4 fw-bold text-white mb-0">{{ $totalBarber ?? 0 }}</h1>
                <p class="text-secondary small mt-2 mb-0">Profesional yang aktif</p>
            </div>
        </div>
    </div>
</div>
@endsection