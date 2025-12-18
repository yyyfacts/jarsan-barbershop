@extends('layouts.app')

@section('title', 'Beranda - Jarsan Barbershop')

@section('content')
{{-- HERO / BANNER SECTION --}}
<section class="hero-banner d-flex align-items-center text-center text-white position-relative w-100"
    style="background: url('{{ asset('images/banner.webp') }}') center/cover no-repeat; height: 85vh;">

    {{-- Overlay --}}
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.6); z-index: 1;">
    </div>

    {{-- Text --}}
    <div class="position-relative z-2 w-100">
        <h1 class="fw-bold display-4 mb-3 text-shadow">Quality, Over Quantity</h1>
        <p class="lead mb-4 text-shadow">
            Rasakan pengalaman potong rambut premium di <strong>Jarsan Barbershop</strong>.
        </p>
        <a href="{{ route('reservasi.create') }}"
            class="btn btn-outline-light btn-lg text-white shadow-sm px-5 py-2 btn-reservasi">
            Reservasi Sekarang
        </a>
    </div>
</section>

{{-- TESTIMONI --}}
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4 text-uppercase">Apa Kata Pelanggan Kami</h2>
        <blockquote class="blockquote mx-auto" style="max-width: 700px;">
            <p class="mb-3 fst-italic fs-5 text-muted">
                “Pelayanan luar biasa! Barber-nya ramah dan hasil potongannya top banget.”
            </p>
            <footer class="blockquote-footer">Andi, Pelanggan Setia</footer>
        </blockquote>
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

.btn-reservasi {
    border: 2px solid #fff;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
}

.btn-reservasi:hover {
    background-color: #fff;
    color: #000 !important;
    transform: scale(1.05);
}
</style>
@endpush