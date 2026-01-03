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

/* --- CAROUSEL (SLIDING EFFECT) --- */
/* Menghapus animasi Ken Burns (Zoom) dan menggunakan Slide bawaan Bootstrap */
.carousel,
.carousel-inner,
.carousel-item {
    height: 100%;
    width: 100%;
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* Filter brightness agar tulisan putih tetap kontras */
    filter: brightness(0.5);
}

/* --- HERO CONTENT LAYOUT --- */
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
    /* Biar klik tembus ke tombol */
}

/* ==========================================================================
   PILIHAN GAYA TULISAN (PILIH SALAH SATU STYLE DI BAWAH)
   ========================================================================== */

/* --- STYLE A: GLASS BOX (DEFAULT - KOTAK KACA MEWAH) --- */
.hero-content-style {
    background: rgba(0, 0, 0, 0.3);
    /* Hitam transparan */
    backdrop-filter: blur(8px);
    /* Efek blur background */
    -webkit-backdrop-filter: blur(8px);
    padding: 60px 40px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-top: 1px solid rgba(212, 175, 55, 0.5);
    /* Garis emas atas */
    border-bottom: 1px solid rgba(212, 175, 55, 0.5);
    /* Garis emas bawah */
    max-width: 900px;
    text-align: center;
    pointer-events: auto;
    border-radius: 0;
    /* Kotak tegas */
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
}

/* --- STYLE B: GRADIENT TEXT (JIKA MAU LEBIH CLEAN/CINEMATIC) --- */
/* Uncomment (hilangkan tanda komentar) bagian ini jika ingin mencoba Style B
   dan Comment (tutup) bagian .hero-content-style di atas */
/*
.hero-content-style {
    background: radial-gradient(circle, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0) 70%);
    padding: 40px;
    max-width: 1000px;
    text-align: center;
    pointer-events: auto;
    text-shadow: 0 4px 10px rgba(0,0,0,0.8);
}
*/
/* ========================================================================== */

/* --- TYPOGRAPHY --- */
/* Efek Teks Emas Berkilau */
.text-gradient-gold {
    background: linear-gradient(to right, #bf953f, #fcf6ba, #b38728, #fbf5b7, #aa771c);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    background-size: 200% auto;
    animation: shine 4s linear infinite;
}

@keyframes shine {
    to {
        background-position: 200% center;
    }
}

.hero-title {
    font-family: 'Playfair Display', serif;
    font-weight: 800;
    font-size: 4.5rem;
    color: #fff;
    line-height: 1.1;
    margin-bottom: 25px;
    text-transform: uppercase;
    letter-spacing: -1px;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #ddd;
    font-weight: 300;
    margin-bottom: 40px;
    letter-spacing: 2px;
    text-transform: uppercase;
}

/* --- BUTTONS --- */
.btn-gold-solid {
    background: linear-gradient(45deg, var(--luxury-gold), #b38728);
    color: #000;
    font-weight: 700;
    padding: 18px 50px;
    text-transform: uppercase;
    border: none;
    transition: all 0.3s ease;
    letter-spacing: 2px;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn-gold-solid:hover {
    transform: scale(1.05);
    box-shadow: 0 0 30px rgba(212, 175, 55, 0.5);
    color: #fff;
}

/* --- SERVICES (GLASS CARDS) --- */
.glass-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 40px 30px;
    transition: all 0.4s ease;
    height: 100%;
}

.glass-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.08);
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
    transition: 0.5s ease;
    font-size: 2rem;
}

.glass-card:hover .icon-circle {
    background: var(--luxury-gold);
    color: #000;
    transform: rotate(360deg);
    box-shadow: 0 0 20px var(--luxury-gold);
}
</style>
@endpush

{{-- 1. HERO SECTION --}}
<section class="hero-wrapper">

    {{-- A. SLIDER GAMBAR (GESER / SLIDE) --}}
    {{-- Hapus class 'carousel-fade' jika ingin efek geser murni, atau biarkan untuk crossfade --}}
    {{-- Saya hapus 'carousel-fade' agar efeknya GESER (Slide) seperti permintaan --}}
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

        {{-- Indikator Slide (Opsional, biar tau ada slide lain) --}}
        <div class="carousel-indicators mb-5">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            @if($setting && $setting->hero_image_2)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            @endif
            @if($setting && $setting->hero_image_3)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            @endif
        </div>

        <div class="carousel-inner">
            {{-- Slide 1 --}}
            <div class="carousel-item active">
                <img src="{{ $setting && $setting->hero_image ? $setting->hero_image : asset('images/banner.webp') }}"
                    class="d-block w-100" alt="Slide 1">
            </div>

            {{-- Slide 2 --}}
            @if($setting && $setting->hero_image_2)
            <div class="carousel-item">
                <img src="{{ $setting->hero_image_2 }}" class="d-block w-100" alt="Slide 2">
            </div>
            @endif

            {{-- Slide 3 --}}
            @if($setting && $setting->hero_image_3)
            <div class="carousel-item">
                <img src="{{ $setting->hero_image_3 }}" class="d-block w-100" alt="Slide 3">
            </div>
            @endif
        </div>

        {{-- Tombol Next/Prev (Opsional) --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- B. KONTEN TENGAH (MENGGUNAKAN STYLE YANG DIPILIH DI CSS) --}}
    <div class="hero-content-overlay">
        <div class="hero-content-style" data-aos="zoom-in" data-aos-duration="1000">

            {{-- Judul --}}
            <h1 class="hero-title">
                {!! $setting->hero_title ?? '<span class="text-gradient-gold">QUALITY</span> <span
                    style="font-style:italic; font-size: 0.6em; color:#ccc;">Over</span> <span
                    class="text-gradient-gold">QUANTITY</span>' !!}
            </h1>

            {{-- Garis Emas --}}
            <div
                style="width: 100px; height: 2px; background: linear-gradient(90deg, transparent, var(--luxury-gold), transparent); margin: 30px auto;">
            </div>

            {{-- Subtitle --}}
            <p class="hero-subtitle">
                {{ $setting->hero_subtitle ?? 'Rasakan sensasi cukur kelas atas dengan detail presisi.' }}
            </p>

            {{-- Tombol Action --}}
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