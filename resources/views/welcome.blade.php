@extends('layouts.app')

@section('content')
@push('styles')
<style>
/* --- THEME VARIABLES --- */
:root {
    --luxury-gold: #D4AF37;
    --gold-light: #FEE140;
}

/* --- HERO WRAPPER --- */
.hero-wrapper {
    position: relative;
    height: 100vh;
    width: 100%;
    overflow: hidden;
    background: #000;
}

/* --- CAROUSEL & KEN BURNS EFFECT --- */
.carousel,
.carousel-inner,
.carousel-item {
    height: 100%;
    width: 100%;
}

/* EFEK BARU: Ken Burns (Zoom Perlahan pada Gambar Slider) */
.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.4) contrast(1.1);
    transform-origin: center;
    animation: kenBurns 20s infinite alternate;
    /* Gambar bergerak zoom */
}

@keyframes kenBurns {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(1.15);
    }
}

/* --- GLASS BOX TENGAH --- */
.hero-content-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    pointer-events: none;
    /* Klik tembus ke bawah */
}

.glass-box {
    background: rgba(0, 0, 0, 0.25);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    padding: 60px 40px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-top: 1px solid rgba(212, 175, 55, 0.3);
    /* Aksen emas tipis di atas */
    border-bottom: 1px solid rgba(212, 175, 55, 0.3);
    /* Aksen emas tipis di bawah */
    max-width: 900px;
    text-align: center;
    pointer-events: auto;
    border-radius: 4px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
    transition: transform 0.3s ease;
}

.glass-box:hover {
    transform: translateY(-5px);
    /* Sedikit naik saat dihover */
    border-color: var(--luxury-gold);
}

/* EFEK BARU: Teks Emas Berkilau (Shining Gradient) */
.text-gradient-gold {
    background: linear-gradient(to right, #bf953f, #fcf6ba, #b38728, #fbf5b7, #aa771c);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    background-size: 200% auto;
    animation: shine 5s linear infinite;
}

@keyframes shine {
    to {
        background-position: 200% center;
    }
}

.hero-title {
    font-family: 'Playfair Display', serif;
    font-weight: 800;
    font-size: 4rem;
    color: #fff;
    /* Fallback color */
    line-height: 1.1;
    margin-bottom: 20px;
    text-transform: uppercase;
    text-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #e0e0e0;
    font-weight: 300;
    margin-bottom: 35px;
    letter-spacing: 1px;
    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.8);
}

.btn-gold-solid {
    background: linear-gradient(45deg, var(--luxury-gold), #b38728);
    color: #000;
    font-weight: 700;
    padding: 16px 50px;
    text-transform: uppercase;
    border: none;
    transition: all 0.4s ease;
    letter-spacing: 2px;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

/* Efek Kilatan pada Tombol */
.btn-gold-solid::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: 0.5s;
    z-index: -1;
}

.btn-gold-solid:hover::before {
    left: 100%;
}

.btn-gold-solid:hover {
    color: #fff;
    box-shadow: 0 0 25px rgba(212, 175, 55, 0.6);
    transform: scale(1.05);
}

/* --- SERVICES (GLASS) --- */
.glass-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 40px 30px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    /* Bouncy effect */
    height: 100%;
}

.glass-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-15px);
    /* Naik lebih tinggi */
    background: rgba(255, 255, 255, 0.08);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
}

.icon-circle {
    width: 80px;
    height: 80px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
    color: var(--luxury-gold);
    transition: 0.6s ease;
    font-size: 2rem;
}

/* EFEK BARU: Ikon Berputar saat Hover */
.glass-card:hover .icon-circle {
    background: var(--luxury-gold);
    color: #000;
    border-color: var(--luxury-gold);
    transform: rotate(360deg) scale(1.1);
    /* Muter 360 derajat */
    box-shadow: 0 0 20px var(--luxury-gold);
}
</style>
@endpush

{{-- 1. HERO SECTION --}}
<section class="hero-wrapper">

    {{-- A. SLIDER GAMBAR (Dengan Efek Ken Burns / Zoom) --}}
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
        <div class="carousel-inner">

            {{-- Slide 1 --}}
            <div class="carousel-item active">
                <img src="{{ $setting && $setting->hero_image ? $setting->hero_image : asset('images/banner.webp') }}"
                    alt="Slide 1">
            </div>

            {{-- Slide 2 --}}
            @if($setting && $setting->hero_image_2)
            <div class="carousel-item">
                <img src="{{ $setting->hero_image_2 }}" alt="Slide 2">
            </div>
            @endif

            {{-- Slide 3 --}}
            @if($setting && $setting->hero_image_3)
            <div class="carousel-item">
                <img src="{{ $setting->hero_image_3 }}" alt="Slide 3">
            </div>
            @endif

        </div>
    </div>

    {{-- B. KONTEN TENGAH (Glass Box) --}}
    <div class="hero-content-overlay">
        <div class="glass-box" data-aos="zoom-in" data-aos-duration="1200">

            {{-- Judul dengan Efek Gradasi Emas Mengkilap --}}
            <h1 class="hero-title">
                {!! $setting->hero_title ?? '<span class="text-gradient-gold">QUALITY</span> <span
                    style="font-style:italic; font-size: 0.7em;">Over</span> <span
                    class="text-gradient-gold">QUANTITY</span>' !!}
            </h1>

            <div
                style="width: 80px; height: 3px; background: linear-gradient(90deg, transparent, var(--luxury-gold), transparent); margin: 25px auto;">
            </div>

            <p class="hero-subtitle">
                {{ $setting->hero_subtitle ?? 'Rasakan sensasi cukur kelas atas dengan detail presisi.' }}
            </p>

            @auth
            <a href="{{ route('reservasi') }}" class="btn btn-gold-solid rounded-pill text-decoration-none">
                {{ $setting->hero_btn_text ?? 'BOOK NOW' }}
            </a>
            @else
            <a href="{{ route('login') }}" class="btn btn-gold-solid rounded-pill text-decoration-none">
                {{ $setting->hero_btn_text ?? 'LOGIN MEMBER' }}
            </a>
            @endauth
        </div>
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
                        <i class="bi bi-scissors"></i>
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
                        <i class="bi bi-cup-hot"></i>
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
                        <i class="bi bi-gem"></i>
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