@extends('layouts.app')

@section('content')
@push('styles')
<style>
/* --- THEME VARIABLES --- */
:root {
    --luxury-gold: #D4AF37;
    --gold-dim: #c5a028;
}

/* --- HERO SECTION UTAMA --- */
.hero-wrapper {
    position: relative;
    height: 100vh;
    /* Full layar */
    width: 100%;
    overflow: hidden;
    background: #000;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    /* Konten ditaruh di bawah */
}

/* Background Image Dinamis */
.hero-bg-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* FIX VERCEL: Menggunakan logic Base64 (tanpa 'storage/') */
    background-image: url('{{ $setting && $setting->hero_image ? $setting->hero_image : asset("images/banner.webp") }}');
    background-size: cover;
    background-position: center top;
    z-index: 0;
    /* Efek Zoom Perlahan */
    animation: zoomEffect 30s infinite alternate;
}

@keyframes zoomEffect {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(1.1);
    }
}

/* Overlay Gelap Biasa */
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom,
            rgba(0, 0, 0, 0.2) 0%,
            rgba(0, 0, 0, 0.1) 40%,
            rgba(0, 0, 0, 0.6) 75%,
            rgba(0, 0, 0, 0.95) 100%);
    z-index: 1;
}

/* EFEK BARU: Frosted Blur di Bagian Bawah */
/* Ini bikin gambar jadi blur cuma di bagian bawah tempat tulisan berada */
.hero-blur-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50%;
    /* Setengah layar ke bawah */
    z-index: 1;
    backdrop-filter: blur(8px);
    /* Efek Blur Kaca */
    -webkit-backdrop-filter: blur(8px);
    /* Masking biar blurnya gradasi (ilang pelan-pelan ke atas) */
    mask-image: linear-gradient(to bottom, transparent, black 60%);
    -webkit-mask-image: linear-gradient(to bottom, transparent, black 60%);
    pointer-events: none;
}

/* Dekorasi Garis Emas Vertikal */
.vertical-line-decor {
    position: absolute;
    left: 50%;
    bottom: 0;
    width: 1px;
    height: 150px;
    background: linear-gradient(to top, var(--luxury-gold), transparent);
    z-index: 2;
    transform: translateX(-50%);
    box-shadow: 0 0 15px var(--luxury-gold);
}

/* Konten Teks */
.hero-content-wrapper {
    position: relative;
    z-index: 10;
    text-align: center;
    padding-bottom: 80px;
    max-width: 900px;
    margin: 0 auto;
}

/* Typography Judul */
.hero-title {
    font-family: 'Playfair Display', serif;
    font-weight: 800;
    font-size: 4.5rem;
    line-height: 1;
    color: #fff;
    text-shadow: 0 10px 40px rgba(0, 0, 0, 0.8);
    letter-spacing: -2px;
    margin-bottom: 20px;
    text-transform: uppercase;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.8rem;
    }
}

/* Garis pemisah */
.separator-gold {
    width: 60px;
    height: 4px;
    background: var(--luxury-gold);
    margin: 0 auto 30px auto;
    border-radius: 2px;
    box-shadow: 0 0 10px rgba(212, 175, 55, 0.5);
}

/* Subtitle */
.hero-subtitle {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.85);
    /* Lebih terang dikit */
    margin-bottom: 40px;
    font-weight: 400;
    letter-spacing: 1px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 1);
}

/* Tombol Minimalis Mewah */
.btn-gold-minimal {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(212, 175, 55, 0.5);
    color: #fff;
    letter-spacing: 3px;
    font-weight: 600;
    padding: 16px 50px;
    text-transform: uppercase;
    font-size: 0.85rem;
    transition: 0.4s;
    backdrop-filter: blur(5px);
    border-radius: 50px;
}

.btn-gold-minimal:hover {
    border-color: var(--luxury-gold);
    color: #000;
    background: var(--luxury-gold);
    box-shadow: 0 0 40px rgba(212, 175, 55, 0.4);
    transform: translateY(-3px);
}

/* Ikon Mouse Scroll Animasi */
.scroll-indicator {
    position: absolute;
    bottom: 25px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    opacity: 0.6;
    animation: bounce 2s infinite;
}

@keyframes bounce {

    0%,
    20%,
    50%,
    80%,
    100% {
        transform: translateX(-50%) translateY(0);
    }

    40% {
        transform: translateX(-50%) translateY(-10px);
    }

    60% {
        transform: translateX(-50%) translateY(-5px);
    }
}

/* --- GLASS CARDS (SERVICES) --- */
.glass-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 40px 30px;
    transition: 0.4s;
    height: 100%;
}

.glass-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.06);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
}

.icon-circle {
    width: 70px;
    height: 70px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
    color: var(--luxury-gold);
    transition: 0.4s;
}

.glass-card:hover .icon-circle {
    background: var(--luxury-gold);
    color: #000;
    border-color: var(--luxury-gold);
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
}
</style>
@endpush

{{-- 1. HERO SECTION (BANNER UTAMA) --}}
<section class="hero-wrapper">

    {{-- Background Image --}}
    <div class="hero-bg-image"></div>

    {{-- Overlay Gradasi --}}
    <div class="hero-overlay"></div>

    {{-- EFEK BARU: BLUR DI BAWAH --}}
    <div class="hero-blur-bottom"></div>

    {{-- Dekorasi Garis Vertikal --}}
    <div class="vertical-line-decor"></div>

    {{-- KONTEN UTAMA (POSISI DI BAWAH) --}}
    <div class="container hero-content-wrapper">

        {{-- Judul Utama Besar --}}
        <h1 class="hero-title" data-aos="fade-up" data-aos-duration="1200">
            {!! $setting->hero_title ?? 'QUALITY <span class="text-gold fst-italic">Over</span> QUANTITY' !!}
        </h1>

        {{-- Garis Pemisah Emas --}}
        <div class="separator-gold" data-aos="zoom-in" data-aos-delay="300"></div>

        {{-- Subtitle --}}
        <p class="hero-subtitle mx-auto" style="max-width: 600px;" data-aos="fade-up" data-aos-delay="500">
            {{ $setting->hero_subtitle ?? 'Rasakan sensasi cukur kelas atas dengan detail presisi. Ritual grooming untuk pria sejati.' }}
        </p>

        {{-- Tombol --}}
        <div data-aos="fade-up" data-aos-delay="700">
            @auth
            <a href="{{ route('reservasi') }}" class="btn btn-gold-minimal rounded-pill text-decoration-none">
                {{ $setting->hero_btn_text ?? 'BOOK NOW' }}
            </a>
            @else
            <a href="{{ route('login') }}" class="btn btn-gold-minimal rounded-pill text-decoration-none">
                {{ $setting->hero_btn_text ?? 'LOGIN MEMBER' }}
            </a>
            @endauth
        </div>

    </div>

    {{-- Indikator Scroll Mouse --}}
    <div class="scroll-indicator text-white small">
        <i class="bi bi-mouse fs-4"></i>
    </div>
</section>

{{-- 2. SERVICES SECTION --}}
<section class="py-5" style="background-color: #050505;">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-gold letter-spacing-3 small fw-bold mb-2">
                {{ $setting->services_subtext ?? 'OUR EXPERTISE' }}
            </h6>
            <h2 class="display-5 fw-bold text-white" style="font-family: 'Playfair Display', serif;">
                {{ $setting->services_title ?? 'EXCLUSIVE SERVICES' }}
            </h2>
        </div>

        <div class="row g-4">
            {{-- CARD 1 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card text-center">
                    <div class="icon-circle mx-auto">
                        <i class="bi bi-scissors fs-3"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">{{ $setting->service_1_title ?? 'Expert Barber' }}</h4>
                    <p class="text-white-50 small mb-0 lh-base">
                        {{ $setting->service_1_desc ?? 'Ditangani oleh seniman rambut berpengalaman tinggi dengan teknik fading presisi.' }}
                    </p>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card text-center">
                    <div class="icon-circle mx-auto">
                        <i class="bi bi-cup-hot fs-3"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">{{ $setting->service_2_title ?? 'Luxury Lounge' }}</h4>
                    <p class="text-white-50 small mb-0 lh-base">
                        {{ $setting->service_2_desc ?? 'Nikmati kopi premium di ruang tunggu ber-AC dengan atmosfer yang menenangkan.' }}
                    </p>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card text-center">
                    <div class="icon-circle mx-auto">
                        <i class="bi bi-gem fs-3"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">{{ $setting->service_3_title ?? 'Premium Products' }}</h4>
                    <p class="text-white-50 small mb-0 lh-base">
                        {{ $setting->service_3_desc ?? 'Hanya menggunakan produk grooming terbaik untuk kesehatan rambut dan kulit kepala Anda.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. TESTIMONIALS --}}
<section class="py-5" style="background: radial-gradient(circle at center, #151515 0%, #000000 100%);">
    <div class="container py-5 text-center">
        <h3 class="mb-5 text-gold letter-spacing-3 fw-bold fs-6">
            {{ $setting->testimonial_title ?? 'VOICE OF GENTLEMEN' }}
        </h3>
        <div class="row justify-content-center">
            <div class="col-md-10" data-aos="zoom-in">
                <script src="https://elfsightcdn.com/platform.js" async></script>
                <div class="elfsight-app-93067b61-ef61-4ae5-9ee5-08877c5d93c9" data-elfsight-app-lazy></div>
            </div>
        </div>
    </div>
</section>
@endsection