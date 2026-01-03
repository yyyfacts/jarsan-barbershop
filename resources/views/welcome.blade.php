@extends('layouts.app')

@section('content')
@push('styles')
<style>
/* --- THEME VARIABLES --- */
:root {
    --luxury-gold: #D4AF37;
    --gold-dim: #c5a028;
}

/* --- 1. HERO SECTION ANIMATION --- */
.hero-wrapper {
    position: relative;
    height: 100vh;
    /* Full layar */
    overflow: hidden;
    background: #000;
}

/* Background Image Dinamis dengan Efek Zoom */
.hero-bg-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* Logic: Cek gambar dari database (Storage), kalau kosong pakai default */
    background-image: url('{{ $setting && $setting->hero_image ? asset("storage/" . $setting->hero_image) : asset("images/banner.webp") }}');
    background-size: cover;
    background-position: center;
    /* Fokus tengah */
    z-index: 0;
    /* Animasi Zoom Perlahan */
    animation: zoomEffect 25s infinite alternate;
}

@keyframes zoomEffect {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(1.15);
    }
}

/* Overlay Gradasi Hitam (Agar tulisan terbaca tapi gambar di kanan tetap terlihat) */
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* Gradasi dari Hitam Pekat (Kiri) ke Transparan (Kanan) */
    background: linear-gradient(90deg,
            rgba(0, 0, 0, 1) 0%,
            rgba(0, 0, 0, 0.8) 40%,
            rgba(0, 0, 0, 0.1) 100%);
    z-index: 1;
}

/* Animasi Alat Cukur (Gunting) Melayang */
.floating-icon {
    position: absolute;
    right: 5%;
    top: 15%;
    z-index: 2;
    opacity: 0.05;
    /* Transparan samar-samar */
    font-size: 20rem;
    /* Ukuran sangat besar */
    color: var(--luxury-gold);
    transform: rotate(-15deg);
    /* Animasi gerak */
    animation: floatIcon 8s ease-in-out infinite;
    pointer-events: none;
    /* Agar tidak menghalangi klik */
}

@keyframes floatIcon {

    0%,
    100% {
        transform: translateY(0) rotate(-15deg);
    }

    50% {
        transform: translateY(-40px) rotate(-5deg);
    }
}

/* Konten Teks Hero */
.hero-content-wrapper {
    position: relative;
    z-index: 10;
    /* Di atas overlay */
    height: 100vh;
    display: flex;
    align-items: center;
    padding-left: 2%;
    /* Padding kiri */
}

/* Typography */
.hero-title {
    font-family: 'Playfair Display', serif;
    font-weight: 800;
    line-height: 1.1;
    text-shadow: 0 10px 30px rgba(0, 0, 0, 0.9);
}

/* Tombol Emas Mewah */
.btn-gold-hero {
    background: linear-gradient(135deg, var(--luxury-gold) 0%, #8a7018 100%);
    border: 1px solid var(--luxury-gold);
    color: #000;
    letter-spacing: 3px;
    font-weight: 700;
    padding: 18px 50px;
    position: relative;
    overflow: hidden;
    z-index: 1;
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
    transition: 0.4s;
    text-transform: uppercase;
}

.btn-gold-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: 0.5s;
}

.btn-gold-hero:hover::before {
    left: 100%;
}

.btn-gold-hero:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(212, 175, 55, 0.4);
    color: #fff;
}

/* --- 2. GLASS CARDS (SERVICES) --- */
.glass-card {
    background: rgba(255, 255, 255, 0.03);
    /* Efek Buram (Blur) di belakang kartu */
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 40px 30px;
    transition: 0.4s;
    height: 100%;
    position: relative;
    overflow: hidden;
}

/* Efek Sorot Cahaya saat Hover */
.glass-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
    opacity: 0;
    transition: 0.6s;
    transform: scale(0.5);
}

.glass-card:hover::before {
    opacity: 1;
    transform: scale(1);
}

.glass-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-15px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
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
    transition: 0.4s;
    background: rgba(0, 0, 0, 0.3);
}

.glass-card:hover .icon-circle {
    background: var(--luxury-gold);
    border-color: var(--luxury-gold);
    color: #000;
    transform: scale(1.1);
}

.glass-card:hover .icon-circle i {
    color: #000 !important;
}
</style>
@endpush

{{-- ==================================================== --}}
{{-- 1. HERO SECTION (BANNER UTAMA) --}}
{{-- ==================================================== --}}
<section class="hero-wrapper">

    {{-- Background Image dengan Animasi Zoom --}}
    <div class="hero-bg-image"></div>

    {{-- Overlay Gradasi (Agar teks terbaca, gambar kanan terlihat) --}}
    <div class="hero-overlay"></div>

    {{-- Elemen Dekorasi Bergerak (Gunting Raksasa) --}}
    <div class="floating-icon">
        <i class="bi bi-scissors"></i>
    </div>

    <div class="container position-relative">
        <div class="row">
            {{-- KOLOM TEKS (Lebar 7 kolom, sisanya untuk gambar background) --}}
            <div class="col-lg-7 hero-content-wrapper">
                <div class="position-relative">

                    {{-- Judul Utama Dinamis --}}
                    <h1 class="hero-title display-2 text-white mb-4" data-aos="fade-right" data-aos-duration="1200">
                        {!! $setting->hero_title ?? 'QUALITY <span class="text-gold fst-italic">Over</span> QUANTITY'
                        !!}
                    </h1>

                    {{-- Subtitle Dinamis --}}
                    <p class="text-white-50 fs-5 mb-5 lh-lg pe-lg-5" data-aos="fade-up" data-aos-delay="200"
                        style="border-left: 3px solid var(--luxury-gold); padding-left: 20px;">
                        {{ $setting->hero_subtitle ?? 'Rasakan sensasi cukur kelas atas dengan detail presisi. Lebih dari sekadar potong rambut, ini adalah ritual pria sejati.' }}
                    </p>

                    {{-- Tombol Booking --}}
                    <div data-aos="fade-up" data-aos-delay="400">
                        @auth
                        <a href="{{ route('reservasi') }}" class="btn btn-gold-hero rounded-0 text-decoration-none">
                            {{ $setting->hero_btn_text ?? 'BOOK APPOINTMENT' }}
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-gold-hero rounded-0 text-decoration-none">
                            {{ $setting->hero_btn_text ?? 'LOGIN TO BOOK' }}
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==================================================== --}}
{{-- 2. SERVICES SECTION (LAYANAN) --}}
{{-- ==================================================== --}}
<section class="py-5" style="background-color: #050505;">
    <div class="container py-5">
        <div class="row align-items-end mb-5" data-aos="fade-up">
            <div class="col-lg-6">
                <h6 class="text-gold letter-spacing-3 small fw-bold mb-2">
                    {{ $setting->services_subtext ?? 'OUR EXPERTISE' }}
                </h6>
                <h2 class="display-5 fw-bold text-white" style="font-family: 'Playfair Display', serif;">
                    {{ $setting->services_title ?? 'EXCLUSIVE SERVICES' }}
                </h2>
            </div>
            <div class="col-lg-6 text-lg-end text-white-50 small mt-3 mt-lg-0">
                <p class="mb-0" style="max-width: 400px; margin-left: auto;">
                    Pengalaman grooming premium dengan teknik modern, atmosfer relaksasi, dan produk terbaik.
                </p>
            </div>
        </div>

        <div class="row g-4">
            {{-- CARD 1 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-scissors fs-3 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">{{ $setting->service_1_title ?? 'Expert Barber' }}</h4>
                    <p class="text-white-50 small mb-0 lh-base">
                        {{ $setting->service_1_desc ?? 'Ditangani oleh seniman rambut berpengalaman tinggi dengan teknik fading presisi.' }}
                    </p>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-cup-hot fs-3 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">{{ $setting->service_2_title ?? 'Luxury Lounge' }}</h4>
                    <p class="text-white-50 small mb-0 lh-base">
                        {{ $setting->service_2_desc ?? 'Nikmati kopi premium di ruang tunggu ber-AC dengan atmosfer yang menenangkan.' }}
                    </p>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-gem fs-3 text-white"></i>
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

{{-- ==================================================== --}}
{{-- 3. TESTIMONIALS (GOOGLE REVIEWS WIDGET) --}}
{{-- ==================================================== --}}
<section class="py-5 position-relative"
    style="background: radial-gradient(circle at center, #151515 0%, #000000 100%); overflow: hidden;">

    {{-- Dekorasi Garis Emas --}}
    <div
        style="position: absolute; top: 0; left: 0; width: 100%; height: 1px; background: linear-gradient(90deg, transparent, var(--luxury-gold), transparent); opacity: 0.3;">
    </div>

    <div class="container py-5 text-center">
        <h3 class="mb-5 text-gold letter-spacing-3 fw-bold fs-6" data-aos="fade-down">
            {{ $setting->testimonial_title ?? 'VOICE OF GENTLEMEN' }}
        </h3>

        <div class="row justify-content-center">
            <div class="col-md-10" data-aos="zoom-in">
                {{-- Widget Review Elfsight --}}
                <script src="https://elfsightcdn.com/platform.js" async></script>
                <div class="elfsight-app-93067b61-ef61-4ae5-9ee5-08877c5d93c9" data-elfsight-app-lazy></div>
            </div>
        </div>
    </div>
</section>
@endsection