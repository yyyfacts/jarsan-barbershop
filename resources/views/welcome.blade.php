@extends('layouts.app')

@section('content')
@push('styles')
<style>
:root {
    --metallic-red: #a80017;
    --bright-red: #dc143c;
}

/* Hero Section dengan Gradient Gelap + Sedikit Merah */
.hero-vintage {
    height: 95vh;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(10, 5, 5, 1)),
    url('{{ asset('images/banner.webp') }}') fixed center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
}

/* Animasi Teks */
.text-reveal {
    overflow: hidden;
}

.text-reveal span {
    display: block;
    transform: translateY(100%);
    animation: reveal 1.2s cubic-bezier(0.77, 0, 0.175, 1) forwards;
}

@keyframes reveal {
    to {
        transform: translateY(0);
    }
}

/* Glass Card Transparan */
.glass-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 40px;
    transition: 0.5s;
    text-align: center;
    height: 100%;
}

/* Hover Card: Border Emas, Shadow Merah */
.glass-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(168, 0, 23, 0.2);
    /* Glow Merah */
}

/* Tombol Utama Merah */
.btn-red-pulse {
    background: linear-gradient(135deg, var(--metallic-red) 0%, #600000 100%);
    border: 1px solid var(--metallic-red);
    color: white;
    letter-spacing: 2px;
    font-weight: bold;
    transition: all 0.4s ease;
    box-shadow: 0 0 20px rgba(168, 0, 23, 0.4);
}

.btn-red-pulse:hover {
    background: var(--bright-red);
    box-shadow: 0 0 40px rgba(220, 20, 60, 0.8);
    transform: scale(1.05);
    color: white;
}
</style>
@endpush

<section class="hero-vintage">
    <div class="container">
        <div class="text-reveal">
            <span class="text-gold fw-bold letter-spacing-5 mb-3 d-block">ESTABLISHED 2025</span>
        </div>

        <h1 class="display-1 fw-bold text-white mb-4" data-aos="zoom-in">
            QUALITY <br>
            <span class="fst-italic"
                style="color: var(--bright-red); font-family: 'Playfair Display', serif;">Over</span>
            QUANTITY
        </h1>

        <p class="lead mb-5 text-white-50 mx-auto fs-5" style="max-width: 700px;" data-aos="fade-up">
            Grooming ritual premium untuk pria yang menghargai detail, presisi tinggi, dan gaya hidup eksklusif.
        </p>

        <div data-aos="fade-up" data-aos-delay="200">
            @auth
            <a href="{{ route('reservasi') }}" class="btn btn-red-pulse btn-lg px-5 py-3 rounded-0">
                MULAI RITUAL ANDA
            </a>
            @else
            <a href="{{ route('login') }}" class="btn btn-red-pulse btn-lg px-5 py-3 rounded-0">
                LOGIN UNTUK BOOKING
            </a>
            @endauth
        </div>
    </div>
</section>

<section class="py-5" style="background-color: #0a0a0a;">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <h5 class="text-gold letter-spacing-2">WHAT WE OFFER</h5>
            <h2 class="display-4 fw-bold text-white">EXCLUSIVE SERVICES</h2>
            <div class="mx-auto mt-3" style="width: 60px; height: 3px; background: var(--metallic-red);"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card">
                    <div class="mb-4 d-inline-block p-3 rounded-circle border border-danger">
                        <i class="bi bi-scissors fs-1 text-gold"></i>
                    </div>
                    <h4 class="fw-bold text-white">Expert Barber</h4>
                    <p class="text-white-50">Ditangani oleh seniman rambut berpengalaman tinggi dengan teknik fading
                        modern.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card">
                    <div class="mb-4 d-inline-block p-3 rounded-circle border border-danger">
                        <i class="bi bi-cup-hot fs-1 text-gold"></i>
                    </div>
                    <h4 class="fw-bold text-white">Luxury Lounge</h4>
                    <p class="text-white-50">Ruangan full AC, musik berkelas, dan kopi premium saat Anda menunggu.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card">
                    <div class="mb-4 d-inline-block p-3 rounded-circle border border-danger">
                        <i class="bi bi-gem fs-1 text-gold"></i>
                    </div>
                    <h4 class="fw-bold text-white">Premium Quality</h4>
                    <p class="text-white-50">Produk styling terbaik dan layanan bintang lima yang dapat dinikmati semua
                        kalangan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: linear-gradient(to top, #000000, #0a0a0a);">
    <div class="container py-5 text-center">
        <h3 class="mb-5 text-gold letter-spacing-2 fw-bold">VOICE OF GENTLEMEN</h3>

        <div id="testi" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center mb-4">
                        <i class="bi bi-quote fs-1 text-danger opacity-50"></i>
                    </div>
                    <p class="fs-2 fst-italic text-white fw-light">"Fade paling rapi yang pernah saya dapatkan.
                        Pelayanannya benar-benar next level."</p>
                    <footer class="mt-4">
                        <span class="text-white fw-bold text-uppercase letter-spacing-1">Zain</span>
                        <br>
                        <small class="text-danger">Entrepreneur</small>
                    </footer>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center mb-4">
                        <i class="bi bi-quote fs-1 text-danger opacity-50"></i>
                    </div>
                    <p class="fs-2 fst-italic text-white fw-light">"Vibes-nya dapet banget, serasa jadi bos setiap kali
                        cukur di sini."</p>
                    <footer class="mt-4">
                        <span class="text-white fw-bold text-uppercase letter-spacing-1">Aga</span>
                        <br>
                        <small class="text-danger">Creative Director</small>
                    </footer>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#testi" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testi" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
@endsection