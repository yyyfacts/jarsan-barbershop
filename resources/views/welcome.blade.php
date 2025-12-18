@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
{{-- HERO BANNER --}}
<section
    class="hero-banner d-flex align-items-center justify-content-center text-center text-white position-relative w-100"
    style="background: url('{{ asset('images/banner-login.webp') }}') center/cover no-repeat; min-height: 90vh;">

    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.6);"></div>

    <div class="position-relative container z-2">
        <span class="d-block text-uppercase letter-spacing-2 mb-2 text-warning fw-bold">Professional Grooming</span>
        <h1 class="fw-bold display-3 mb-3">Quality, Over Quantity</h1>
        <p class="lead mb-5 text-light opacity-75 mx-auto" style="max-width: 600px;">
            Rasakan pengalaman potong rambut premium di Jarsan Barbershop.
        </p>

        {{-- TOMBOL RESERVASI --}}
        {{-- Logika di Route: Jika belum login, dilempar ke login. Jika sudah, masuk form. --}}
        <a href="{{ route('reservasi') }}" class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg">
            Reservasi Sekarang <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>
</section>

{{-- SEKSI PROMOSI SINGKAT --}}
<section class="py-5 bg-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Kenapa Jarsan?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 border rounded-4 h-100 shadow-sm">
                    <i class="bi bi-scissors fs-1 text-primary mb-3"></i>
                    <h4>Expert Barber</h4>
                    <p class="text-muted">Ditangani oleh kapster berpengalaman tinggi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded-4 h-100 shadow-sm">
                    <i class="bi bi-shop fs-1 text-primary mb-3"></i>
                    <h4>Tempat Nyaman</h4>
                    <p class="text-muted">Ruangan ber-AC, bersih, dan free WiFi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded-4 h-100 shadow-sm">
                    <i class="bi bi-wallet2 fs-1 text-primary mb-3"></i>
                    <h4>Harga Terjangkau</h4>
                    <p class="text-muted">Kualitas premium dengan harga mahasiswa.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection