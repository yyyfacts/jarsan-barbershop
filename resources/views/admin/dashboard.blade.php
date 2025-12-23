@extends('layouts.admin')

@section('content')
<div class="mb-4 text-center text-md-start">
    <h2 class="fw-bold">Dashboard Admin</h2>
    <p class="text-muted">Ringkasan aktivitas barbershop Anda hari ini.</p>
</div>

<div class="row g-4 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100 py-3">
            <div class="card-body text-center">
                <div class="mb-2 text-primary">
                    <i class="bi bi-calendar-check fs-1"></i>
                </div>
                <h5 class="text-muted mb-2">Reservasi Hari Ini</h5>
                <h1 class="fw-bold display-4 mb-0">{{ $reservasiHariIni ?? 0 }}</h1>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100 py-3">
            <div class="card-body text-center">
                <div class="mb-2 text-success">
                    <i class="bi bi-scissors fs-1"></i>
                </div>
                <h5 class="text-muted mb-2">Total Layanan</h5>
                <h1 class="fw-bold display-4 mb-0">{{ $totalLayanan ?? 0 }}</h1>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100 py-3">
            <div class="card-body text-center">
                <div class="mb-2 text-warning">
                    <i class="bi bi-people-fill fs-1"></i>
                </div>
                <h5 class="text-muted mb-2">Total Barber</h5>
                <h1 class="fw-bold display-4 mb-0">{{ $totalBarber ?? 0 }}</h1>
            </div>
        </div>
    </div>
</div>
@endsection