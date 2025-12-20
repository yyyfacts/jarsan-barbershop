@extends('layouts.app')

@section('title', 'Tentang Kami - Jarsan Barbershop')

@section('content')

{{-- =========================
   HERO / BANNER
========================= --}}
<section class="hero-banner d-flex align-items-center text-center text-white position-relative w-100"
    style="background: url('{{ asset('images/banner-login.webp') }}') center/cover no-repeat; height: 60vh;">

    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.7); z-index: 1;">
    </div>

    <div class="position-relative z-2 w-100">
        <h1 class="fw-bold display-5 mb-3 text-shadow">Tentang Jarsan Barbershop</h1>
        <p class="lead mb-0 text-shadow">Gaya rambut terbaik dimulai dari tangan profesional</p>
    </div>
</section>

{{-- =========================
   SEJARAH KAMI (DINAMIS)
========================= --}}
@php
// Logika Background: Jika ada di DB pakai DB, jika tidak pakai Default
$bgHistory = $about->history_image ?? asset('images/banner.webp');
@endphp

<section class="position-relative text-white d-flex align-items-center"
    style="background: url('{{ $bgHistory }}') center/cover no-repeat; min-height: 70vh;">

    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.8);"></div>

    <div class="container position-relative z-2">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="fw-bold text-warning mb-4">Sejarah Kami</h2>
                <p class="lead text-light fs-5 lh-lg">
                    {{-- KONTEN DINAMIS --}}
                    {{ $about->history ?? 'Sejarah belum ditambahkan oleh admin.' }}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- =========================
   MISI KAMI (DINAMIS)
========================= --}}
@php
$bgMission = $about->mission_image ?? asset('images/banner-login.webp');
@endphp

<section class="position-relative text-white d-flex align-items-center"
    style="background: url('{{ $bgMission }}') center/cover no-repeat; min-height: 60vh;">

    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.8);"></div>

    <div class="container position-relative z-2">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="fw-bold text-warning mb-4">Misi Kami</h2>
                <p class="lead text-light fs-5 lh-lg">
                    {{-- KONTEN DINAMIS --}}
                    {{ $about->mission ?? 'Misi belum ditambahkan oleh admin.' }}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- =========================
   KENAPA PILIH KAMI (STATIC)
========================= --}}
<section class="py-5 position-relative bg-dark">
    <div class="container position-relative z-2 text-center text-light">
        <h2 class="fw-bold mb-5 text-uppercase text-warning text-shadow">Kenapa Pilih Kami?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 border border-secondary rounded-4 h-100">
                    <i class="bi bi-scissors display-4 text-warning mb-3"></i>
                    <h5 class="fw-bold text-light">Barber Berpengalaman</h5>
                    <p class="text-white-50 fs-6">
                        Tim kami terdiri dari barber berpengalaman dengan keahlian dalam berbagai gaya potongan modern
                        dan klasik.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border border-secondary rounded-4 h-100">
                    <i class="bi bi-star-fill display-4 text-warning mb-3"></i>
                    <h5 class="fw-bold text-light">Kualitas Premium</h5>
                    <p class="text-white-50 fs-6">
                        Kami menggunakan produk rambut terbaik untuk menjaga kesehatan dan tampilan rambut Anda.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border border-secondary rounded-4 h-100">
                    <i class="bi bi-clock-history display-4 text-warning mb-3"></i>
                    <h5 class="fw-bold text-light">Cepat & Tepat Waktu</h5>
                    <p class="text-white-50 fs-6">
                        Dengan sistem reservasi online dan pelayanan efisien, Anda tak perlu menunggu lama untuk tampil
                        keren.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================
   CTA SECTION
========================= --}}
<section class="py-5 bg-warning text-center text-dark">
    <div class="container">
        <h3 class="fw-bold mb-3">Ingin tampil lebih keren?</h3>
        <p class="mb-4">Pesan jadwal cukurmu sekarang dan rasakan pengalaman berbeda di Jarsan Barbershop.</p>
        <a href="{{ url('/reservasi') }}" class="btn btn-dark fw-semibold rounded-pill px-5 py-2 shadow-sm">
            Reservasi Sekarang
        </a>
    </div>
</section>
@endsection

@push('styles')
<style>
.hero-banner {
    background-position: center;
    background-size: cover;
    transition: background-size 1s ease;
}

.hero-banner:hover {
    background-size: 110%;
}

.text-shadow {
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
}

.overlay {
    background: rgba(0, 0, 0, 0.6);
}
</style>
@endpush