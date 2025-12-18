@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
{{-- HERO / BANNER SECTION --}}
<section
    class="hero-banner d-flex align-items-center justify-content-center text-center text-white position-relative w-100"
    style="background: url('{{ asset('images/banner.webp') }}') center/cover no-repeat; min-height: 90vh;">

    {{-- Overlay Gelap --}}
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.65);"></div>

    {{-- Teks di Atas Banner --}}
    <div class="position-relative container z-2">
        <span class="d-block text-uppercase letter-spacing-2 mb-2 text-warning fw-bold">Professional Grooming</span>
        <h1 class="fw-bold display-3 mb-3 text-shadow font-playfair">Quality, Over Quantity</h1>
        <p class="lead mb-5 text-light opacity-75 mx-auto" style="max-width: 600px;">
            Rasakan pengalaman potong rambut premium di <strong>Jarsan Barbershop</strong>. Kami tidak hanya memotong
            rambut, kami meningkatkan gaya Anda.
        </p>
        <a href="{{ url('/reservasi') }}"
            class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg btn-reservasi">
            Booking Sekarang <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>
</section>

{{-- LAYANAN --}}
<section class="py-5">
    <div class="container py-5 text-center">
        <h6 class="text-primary fw-bold text-uppercase mb-2">Our Services</h6>
        <h2 class="fw-bold mb-5 font-playfair display-6">Layanan Unggulan</h2>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-sm-6">
                <div class="card service-card border-0 shadow-sm h-100">
                    <div class="overflow-hidden rounded-top-3">
                        <img src="{{ asset('images/haircut.jpg') }}" class="card-img-top zoom-effect"
                            alt="Potong Rambut">
                    </div>
                    <div class="card-body p-4">
                        <h4 class="card-title fw-bold mb-3">Haircut Premium</h4>
                        <p class="card-text text-muted">Potongan modern, klasik, atau sesuai gaya kamu — semua dengan
                            presisi tinggi dan hot towel finish.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card service-card border-0 shadow-sm h-100">
                    <div class="overflow-hidden rounded-top-3">
                        <img src="{{ asset('images/coloring.webp') }}" class="card-img-top zoom-effect"
                            alt="Hair Coloring">
                    </div>
                    <div class="card-body p-4">
                        <h4 class="card-title fw-bold mb-3">Hair Coloring</h4>
                        <p class="card-text text-muted">Transformasi warna rambutmu dengan produk premium untuk hasil
                            yang menawan, trendy, dan tahan lama.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card service-card border-0 shadow-sm h-100">
                    <div class="overflow-hidden rounded-top-3">
                        <img src="{{ asset('images/shaving.jpg') }}" class="card-img-top zoom-effect" alt="Shaving">
                    </div>
                    <div class="card-body p-4">
                        <h4 class="card-title fw-bold mb-3">Hot Towel Shave</h4>
                        <p class="card-text text-muted">Nikmati sensasi cukur jenggot dan kumis yang bersih dan rileks
                            dengan handuk hangat aromaterapi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-5 bg-dark text-white text-center">
    <div class="container py-4">
        <h2 class="mb-3 font-playfair">Siap Tampil Lebih Ganteng?</h2>
        <p class="text-white-50 mb-4">Jangan tunggu antrian, amankan jadwalmu sekarang juga.</p>
        <a href="{{ url('/reservasi') }}" class="btn btn-primary btn-lg rounded-pill px-5">Reservasi Online</a>
    </div>
</section>

@endsection

@push('styles')
<style>
/* Fonts */
.font-playfair {
    font-family: 'Playfair Display', serif;
}

.letter-spacing-2 {
    letter-spacing: 2px;
}

/* Banner */
.text-shadow {
    text-shadow: 0 4px 30px rgba(0, 0, 0, 0.8);
}

/* Service Cards */
.service-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.zoom-effect {
    height: 250px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.service-card:hover .zoom-effect {
    transform: scale(1.1);
}
</style>
@endpush