@extends('layouts.admin')

@section('content')
<div class="text-center mb-5">
    <h2 class="display-5 fw-bold text-gold">Dashboard Overview</h2>
    <p class="text-secondary">Welcome back, Administrator.</p>
</div>

<div class="row g-4 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card h-100 p-4 text-center">
            <div class="card-body">
                <div class="mb-3 text-gold">
                    <i class="bi bi-calendar-check" style="font-size: 2.5rem;"></i>
                </div>
                <h6 class="text-uppercase text-white fw-bold" style="letter-spacing: 1px; opacity: 0.8;">Reservasi Hari
                    Ini</h6>
                <h1 class="display-3 fw-bold my-2 text-white">{{ $reservasiHariIni ?? 0 }}</h1>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card h-100 p-4 text-center">
            <div class="card-body">
                <div class="mb-3 text-gold">
                    <i class="bi bi-scissors" style="font-size: 2.5rem;"></i>
                </div>
                <h6 class="text-uppercase text-white fw-bold" style="letter-spacing: 1px; opacity: 0.8;">Total Layanan
                </h6>
                <h1 class="display-3 fw-bold my-2 text-white">{{ $totalLayanan ?? 0 }}</h1>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card h-100 p-4 text-center">
            <div class="card-body">
                <div class="mb-3 text-gold">
                    <i class="bi bi-people" style="font-size: 2.5rem;"></i>
                </div>
                <h6 class="text-uppercase text-white fw-bold" style="letter-spacing: 1px; opacity: 0.8;">Total Barber
                </h6>
                <h1 class="display-3 fw-bold my-2 text-white">{{ $totalBarber ?? 0 }}</h1>
            </div>
        </div>
    </div>
</div>
@endsection