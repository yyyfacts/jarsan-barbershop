@extends('layouts.admin')

@section('content')
<div class="mb-5">
    <h2 class="fw-bold text-dark">Dashboard</h2>
    <p class="text-muted">Selamat datang kembali, Admin.</p>
</div>

<div class="row g-4">
    <div class="col-12 col-md-4">
        <div class="card h-100 border-0 shadow-sm p-3">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 60px; height: 60px; background-color: #FFF4E5;">
                    <i class="bi bi-calendar-check text-warning fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Reservasi Hari Ini</h6>
                    <h2 class="fw-bold text-dark m-0">{{ $reservasiHariIni ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card h-100 border-0 shadow-sm p-3">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 60px; height: 60px; background-color: #E3F2FD;">
                    <i class="bi bi-scissors text-primary fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Total Layanan</h6>
                    <h2 class="fw-bold text-dark m-0">{{ $totalLayanan ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card h-100 border-0 shadow-sm p-3">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 60px; height: 60px; background-color: #E8F5E9;">
                    <i class="bi bi-people text-success fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Total Barber</h6>
                    <h2 class="fw-bold text-dark m-0">{{ $totalBarber ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection