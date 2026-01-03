@extends('layouts.app')

@section('title', 'Our Legacy')

@section('content')
@push('styles')
<style>
/* --- 1. CORE VARIABLES --- */
:root {
    --gold-primary: #D4AF37;
    --bg-dark: #050505;
}

/* --- 2. GLOBAL DECORATION (PARTICLES) --- */
.gold-particle {
    position: fixed;
    width: 3px;
    height: 3px;
    background: var(--gold-primary);
    border-radius: 50%;
    animation: floatUp 8s infinite linear;
    z-index: 1;
    pointer-events: none;
    opacity: 0.6;
}

@keyframes floatUp {
    0% {
        transform: translateY(100vh) scale(0.5);
        opacity: 0;
    }

    50% {
        opacity: 0.8;
    }

    100% {
        transform: translateY(-10vh) scale(1);
        opacity: 0;
    }
}

/* --- 3. HERO SECTION (CINEMATIC) --- */
.about-hero {
    position: relative;
    height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: #000;
}

/* Background Image with Slow Zoom */
.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    filter: brightness(0.4) contrast(1.2);
    animation: slowZoom 20s infinite alternate;
}

@keyframes slowZoom {
    from {
        transform: scale(1);
    }

    to {
        transform: scale(1.1);
    }
}

/* Giant Background Text (Efek Mahal) */
.giant-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-family: 'Playfair Display', serif;
    font-size: 15vw;
    font-weight: 900;
    color: transparent;
    -webkit-text-stroke: 1px rgba(212, 175, 55, 0.15);
    /* Outline Emas Tipis */
    z-index: 2;
    white-space: nowrap;
    letter-spacing: 20px;
    pointer-events: none;
}

/* Content Box (Glass with Gold Border) */
.hero-content {
    position: relative;
    z-index: 10;
    text-align: center;
    padding: 60px 40px;
    border: 1px solid rgba(212, 175, 55, 0.3);
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(10px);
}

/* Double Border Effect */
.hero-content::before {
    content: '';
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border: 1px solid rgba(212, 175, 55, 0.1);
    pointer-events: none;
}

/* --- 4. HISTORY SECTION (ASYMMETRICAL) --- */
.history-section {
    background: var(--bg-dark);
    position: relative;
    padding: 100px 0;
}

.img-frame-luxury {
    position: relative;
    padding: 15px;
    border: 1px solid var(--gold-primary);
}

.img-frame-luxury img {
    display: block;
    width: 100%;
    filter: grayscale(100%);
    transition: 0.5s;
}

.img-frame-luxury:hover img {
    filter: grayscale(0%);
}

/* --- 5. PHILOSOPHY (PARALLAX) --- */
.philosophy-section {
    position: relative;
    padding: 120px 0;
    background-attachment: fixed;
    /* Parallax Effect */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.philosophy-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
}

/* --- 6. WHY US (3D CARDS) --- */
.why-card {
    background: #0f0f0f;
    padding: 40px 30px;
    border: 1px solid #222;
    transition: 0.4s;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.why-card:hover {
    transform: translateY(-10px) scale(1.02);
    border-color: var(--gold-primary);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.1);
}

.why-icon {
    font-size: 3rem;
    color: var(--gold-primary);
    margin-bottom: 20px;
    text-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
}

.why-num {
    position: absolute;
    top: 0;
    right: 10px;
    font-size: 5rem;
    font-weight: 900;
    color: rgba(255, 255, 255, 0.03);
    font-family: 'Playfair Display', serif;
}
</style>
@endpush

{{-- PARTIKEL EMAS (Hiasan Background) --}}
<div class="gold-particle" style="left: 10%; animation-duration: 7s;"></div>
<div class="gold-particle" style="left: 30%; animation-duration: 9s;"></div>
<div class="gold-particle" style="left: 70%; animation-duration: 6s;"></div>
<div class="gold-particle" style="left: 90%; animation-duration: 8s;"></div>

{{-- 1. HERO SECTION --}}
<section class="about-hero">
    {{-- Gambar BG --}}
    <div class="hero-bg"
        style="background-image: url('{{ $about->hero_bg ? $about->hero_bg : asset('images/banner-login.webp') }}');">
    </div>

    {{-- Teks Raksasa di Belakang --}}
    <div class="giant-text">THE LEGACY</div>

    <div class="hero-content" data-aos="fade-up">
        <h6 class="text-gold letter-spacing-3 small mb-3">{{ $about->hero_subtitle ?? 'ESTABLISHED 2024' }}</h6>
        <h1 class="display-3 fw-bold text-white mb-0"
            style="font-family: 'Playfair Display', serif; text-shadow: 0 5px 15px rgba(0,0,0,0.5);">
            {{ $about->hero_title ?? 'CRAFTING CONFIDENCE' }}
        </h1>
    </div>
</section>

{{-- 2. HISTORY SECTION --}}
<section class="history-section">
    <div class="container">
        <div class="row align-items-center">
            {{-- Gambar Kiri --}}
            <div class="col-lg-5" data-aos="fade-right">
                <div class="img-frame-luxury">
                    <img src="{{ $about->history_image ?? asset('images/banner.webp') }}" alt="History">
                </div>
            </div>

            {{-- Teks Kanan --}}
            <div class="col-lg-1"></div> {{-- Spacer --}}
            <div class="col-lg-6" data-aos="fade-left">
                <div style="border-left: 3px solid var(--gold-primary); padding-left: 30px;">
                    <h2 class="display-5 text-white mb-4" style="font-family: 'Playfair Display', serif;">Our Story</h2>
                    <p class="lead text-white-50 lh-lg">
                        {{ $about->history ?? 'Berawal dari sebuah visi sederhana untuk mendefinisikan ulang maskulinitas melalui seni pangkas rambut.' }}
                    </p>
                    <div class="mt-5">
                        <span class="d-block fs-1 fw-bold text-gold" style="font-family: 'Playfair Display', serif;">
                            {{ $about->founded_year ?? '2024' }}
                        </span>
                        <small class="text-white-50 letter-spacing-2 text-uppercase">The Beginning of Excellence</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. PHILOSOPHY SECTION (PARALLAX) --}}
<section class="philosophy-section"
    style="background-image: url('{{ $about->mission_image ? $about->mission_image : asset('images/banner.webp') }}');">
    <div class="philosophy-overlay"></div>
    <div class="container position-relative text-center" data-aos="zoom-in">

        <i class="bi bi-quote text-gold display-1 mb-3 d-block"></i>

        <h2 class="display-4 fw-bold text-white mb-4 fst-italic"
            style="font-family: 'Playfair Display', serif; max-width: 800px; margin: 0 auto;">
            "{{ $about->philosophy_quote ?? 'Detail adalah segalanya. Kami tidak hanya memotong rambut, kami memahat karakter.' }}"
        </h2>

        <div style="width: 100px; height: 1px; background: var(--gold-primary); margin: 30px auto;"></div>

        <p class="text-white-50 fs-5">
            {{ $about->mission ?? 'Dedikasi tanpa kompromi untuk kualitas dan kepuasan pelanggan.' }}
        </p>

    </div>
</section>

{{-- 4. WHY CHOOSE US (DARK CARDS) --}}
<section class="py-5" style="background: #0a0a0a;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h6 class="text-gold letter-spacing-3">THE DISTINCTION</h6>
            <h2 class="text-white display-5 fw-bold" style="font-family: 'Playfair Display', serif;">Why We Are
                Different</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="why-card">
                    <span class="why-num">01</span>
                    <i class="bi bi-scissors why-icon"></i>
                    <h4 class="text-white mb-3">{{ $about->why_1_title ?? 'Master Barber' }}</h4>
                    <p class="text-white-50 mb-0">
                        {{ $about->why_1_desc ?? 'Keahlian tinggi dengan sertifikasi internasional.' }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="why-card" style="border-bottom: 3px solid var(--gold-primary);"> {{-- Highlight Tengah --}}
                    <span class="why-num">02</span>
                    <i class="bi bi-gem why-icon"></i>
                    <h4 class="text-white mb-3">{{ $about->why_2_title ?? 'Premium Tools' }}</h4>
                    <p class="text-white-50 mb-0">
                        {{ $about->why_2_desc ?? 'Peralatan steril dan produk grooming kelas dunia.' }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="why-card">
                    <span class="why-num">03</span>
                    <i class="bi bi-cup-hot why-icon"></i>
                    <h4 class="text-white mb-3">{{ $about->why_3_title ?? 'Luxury Lounge' }}</h4>
                    <p class="text-white-50 mb-0">{{ $about->why_3_desc ?? 'Ruang tunggu nyaman dengan kopi gratis.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection