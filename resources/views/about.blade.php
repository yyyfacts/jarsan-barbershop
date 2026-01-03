@extends('layouts.app')

@section('title', 'Our Legacy')

@section('content')
@push('styles')
<style>
/* --- THEME VARIABLES (SAMA DENGAN WELCOME) --- */
:root {
    --luxury-gold: #D4AF37;
    --gold-light: #FEE140;
    --deep-bg: #050505;
}

/* --- HERO SECTION --- */
.about-hero {
    position: relative;
    height: 60vh;
    /* Tinggi Banner */
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #000;
    overflow: hidden;
}

/* Background Image Dinamis */
.hero-bg-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    filter: brightness(0.4) contrast(1.1);
    z-index: 0;
    /* Efek Zoom Perlahan (Ken Burns) */
    animation: kenBurns 20s infinite alternate;
}

@keyframes kenBurns {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(1.15);
    }
}

/* --- GLASS BOX (Center Content) --- */
.glass-box {
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    padding: 50px 40px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-top: 1px solid rgba(212, 175, 55, 0.3);
    border-bottom: 1px solid rgba(212, 175, 55, 0.3);
    max-width: 800px;
    text-align: center;
    position: relative;
    z-index: 10;
    border-radius: 4px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
}

/* Teks Emas Berkilau */
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

/* --- FEATURE CARDS (GLASS STYLE) --- */
.glass-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 40px 30px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
}

.glass-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.08);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
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
    transition: 0.6s ease;
    font-size: 1.8rem;
}

.glass-card:hover .icon-circle {
    background: var(--luxury-gold);
    color: #000 !important;
    border-color: var(--luxury-gold);
    transform: rotate(360deg) scale(1.1);
    box-shadow: 0 0 20px var(--luxury-gold);
}

.glass-card:hover .icon-circle i {
    color: #000 !important;
}

/* --- IMAGE FRAME LUXURY --- */
.img-luxury-frame {
    position: relative;
    padding: 10px;
    border: 1px solid rgba(212, 175, 55, 0.3);
    background: rgba(255, 255, 255, 0.02);
}

.img-luxury-frame img {
    display: block;
    width: 100%;
    filter: brightness(0.8) contrast(1.1);
    transition: 0.5s;
}

.img-luxury-frame:hover img {
    filter: brightness(1) contrast(1);
    transform: scale(1.02);
}
</style>
@endpush

{{-- 1. HERO HEADER --}}
<section class="about-hero">
    {{-- Background Image Dinamis (Base64 Safe) --}}
    <div class="hero-bg-image"
        style="background-image: url('{{ $about->hero_bg ? $about->hero_bg : asset('images/banner-login.webp') }}');">
    </div>

    {{-- Glass Box Content --}}
    <div class="glass-box" data-aos="zoom-in">
        <h6 class="text-white-50 letter-spacing-3 mb-3 fw-bold small text-uppercase">
            {{ $about->hero_subtitle ?? 'THE HERITAGE' }}
        </h6>

        <h1 class="display-4 fw-bold text-white mb-0" style="font-family: 'Playfair Display', serif;">
            {!! $about->hero_title ?? '<span class="text-gradient-gold">CRAFTING</span> CONFIDENCE' !!}
        </h1>

        <div style="width: 60px; height: 2px; background: var(--luxury-gold); margin: 30px auto;"></div>
    </div>
</section>

{{-- 2. HISTORY SECTION --}}
<section class="py-5" style="background-color: var(--deep-bg);">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            {{-- Gambar Sejarah --}}
            <div class="col-lg-6" data-aos="fade-right">
                <div class="img-luxury-frame">
                    <img src="{{ $about->history_image ?? asset('images/banner.webp') }}" alt="Our History"
                        class="img-fluid">

                    {{-- Dekorasi Kotak Emas di belakang --}}
                    <div
                        style="position: absolute; top: -10px; left: -10px; width: 100%; height: 100%; border: 1px solid var(--luxury-gold); z-index: -1; opacity: 0.3;">
                    </div>
                </div>
            </div>

            {{-- Teks Sejarah --}}
            <div class="col-lg-6 px-lg-5" data-aos="fade-left">
                <h6 class="text-gold letter-spacing-2 small fw-bold mb-2">OUR STORY</h6>
                <h2 class="display-5 text-white mb-4 fw-bold" style="font-family: 'Playfair Display', serif;">
                    History of Excellence
                </h2>

                <p class="lead text-white-50 lh-lg mb-4" style="font-size: 1.05rem;">
                    {{ $about->history ?? 'Jarsan Barbershop dimulai dari visi sederhana: menghadirkan kembali ritual ketampanan klasik dalam balutan modernitas.' }}
                </p>

                <div class="d-flex align-items-center gap-4 mt-5 pt-4 border-top border-secondary">
                    <div>
                        <span class="d-block text-gradient-gold fs-2 fw-bold"
                            style="font-family: 'Playfair Display', serif;">
                            {{ $about->founded_year ?? 'Est. 2024' }}
                        </span>
                        <small class="text-white-50 letter-spacing-2 text-uppercase" style="font-size: 0.7rem;">
                            {{ $about->founded_text ?? 'FOUNDED IN EXCELLENCE' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. MISSION & PHILOSOPHY --}}
{{-- Parallax Background --}}
<section class="py-5 position-relative"
    style="background: {{ $about->mission_image ? "url('$about->mission_image')" : "#111" }} center/cover fixed no-repeat;">

    {{-- Overlay Gelap --}}
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.75);">
    </div>

    <div class="container py-5 position-relative">
        <div class="glass-box text-center mx-auto" style="max-width: 900px; background: rgba(0,0,0,0.5);"
            data-aos="fade-up">

            <h6 class="text-gold letter-spacing-2 mb-4 fw-bold small">
                {{ $about->philosophy_title ?? 'OUR PHILOSOPHY' }}
            </h6>

            <h2 class="display-5 fw-bold text-white mb-4 fst-italic" style="font-family: 'Playfair Display', serif;">
                "{{ $about->philosophy_quote ?? 'Misi Kami Adalah Presisi' }}"
            </h2>

            <p class="fs-5 text-white opacity-75 mx-auto lh-base mb-4">
                {{ $about->mission ?? 'Memberikan pelayanan grooming terbaik bagi semua kalangan dengan mengutamakan kualitas.' }}
            </p>

            <div class="d-flex justify-content-center gap-3 fs-5">
                <i class="bi bi-star-fill text-gold"></i>
                <i class="bi bi-star-fill text-gold"></i>
                <i class="bi bi-star-fill text-gold"></i>
                <i class="bi bi-star-fill text-gold"></i>
                <i class="bi bi-star-fill text-gold"></i>
            </div>
        </div>
    </div>
</section>

{{-- 4. WHY CHOOSE US (GLASS CARDS) --}}
<section class="py-5" style="background-color: var(--deep-bg);">
    <div class="container py-5 text-center">

        <h6 class="text-gold letter-spacing-3 small fw-bold mb-2">THE ADVANTAGE</h6>
        <h2 class="text-white mb-5 display-5 fw-bold" style="font-family: 'Playfair Display', serif;">
            {{ $about->why_title ?? 'WHY CHOOSE THE BEST?' }}
        </h2>

        <div class="row g-4">
            {{-- KARTU 1 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card">
                    <div class="icon-circle mx-auto">
                        <i class="bi bi-scissors"></i>
                    </div>
                    <h4 class="text-white fw-bold letter-spacing-1 mb-3">
                        {{ $about->why_1_title ?? 'MASTER BARBER' }}
                    </h4>
                    <p class="text-white-50 small mb-0 lh-base">
                        {{ $about->why_1_desc ?? 'Seniman rambut tersertifikasi dengan jam terbang tinggi.' }}
                    </p>
                </div>
            </div>

            {{-- KARTU 2 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card">
                    <div class="icon-circle mx-auto">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="text-white fw-bold letter-spacing-1 mb-3">
                        {{ $about->why_2_title ?? 'PREMIUM TOOLS' }}
                    </h4>
                    <p class="text-white-50 small mb-0 lh-base">
                        {{ $about->why_2_desc ?? 'Hanya menggunakan produk pomade dan alat cukur kualitas internasional.' }}
                    </p>
                </div>
            </div>

            {{-- KARTU 3 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card">
                    <div class="icon-circle mx-auto">
                        <i class="bi bi-cup-hot"></i>
                    </div>
                    <h4 class="text-white fw-bold letter-spacing-1 mb-3">
                        {{ $about->why_3_title ?? 'EXECUTIVE LOUNGE' }}
                    </h4>
                    <p class="text-white-50 small mb-0 lh-base">
                        {{ $about->why_3_desc ?? 'Kenyamanan maksimal dengan kopi pilihan dan suasana eksklusif.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection