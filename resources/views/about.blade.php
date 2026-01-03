@extends('layouts.app')

@section('title', 'Our Legacy')

@section('content')
@push('styles')
<style>
/* --- CUSTOM VARIABLES --- */
:root {
    --metallic-red: #a80017;
    --luxury-gold: #D4AF37;
    --deep-bg: #0a0a0a;
}

/* --- HERO SECTION --- */
.about-hero {
    height: 60vh;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), #0a0a0a),
    url('{{ asset('images/banner-login.webp') }}') center/cover fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.section-title {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    color: var(--luxury-gold);
}

/* --- GLASS BOX (PHILOSOPHY) --- */
.glass-box {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(212, 175, 55, 0.2);
    padding: 60px 40px;
    position: relative;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
}

/* --- FEATURE CARDS --- */
.glass-card {
    background: rgba(20, 20, 20, 0.6);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    transition: 0.4s ease;
    height: 100%;
    padding: 40px 30px;
}

.glass-card:hover {
    transform: translateY(-10px);
    border-color: var(--luxury-gold);
    background: rgba(10, 10, 10, 0.9);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
}

.icon-circle {
    width: 80px;
    height: 80px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--luxury-gold);
    border-radius: 50%;
    margin-bottom: 25px;
    background: #000;
    transition: 0.4s;
}

.glass-card:hover .icon-circle {
    background: var(--luxury-gold);
    color: #000 !important;
}

.glass-card:hover .icon-circle i {
    color: #000 !important;
}

/* --- IMAGE FRAME --- */
.img-luxury {
    border: 2px solid var(--luxury-gold);
    padding: 8px;
    background: rgba(0, 0, 0, 0.5);
    transition: 0.5s;
}

.img-luxury:hover {
    transform: scale(1.02);
    box-shadow: 0 0 30px rgba(212, 175, 55, 0.15);
}
</style>
@endpush

{{-- 1. HERO HEADER --}}
<section class="about-hero">
    <div class="container text-center" data-aos="zoom-out">
        {{-- JUDUL KECIL DINAMIS --}}
        <h6 class="text-gold letter-spacing-3 mb-3 fw-bold small">
            {{ $about->hero_subtitle ?? 'THE HERITAGE' }}
        </h6>

        {{-- JUDUL BESAR DINAMIS --}}
        <h1 class="display-3 fw-bold text-white mb-0" style="font-family: 'Playfair Display', serif;">
            {{ $about->hero_title ?? 'CRAFTING CONFIDENCE' }}
        </h1>
        <div style="width: 60px; height: 3px; background: var(--luxury-gold); margin: 30px auto;"></div>
    </div>
</section>

{{-- 2. HISTORY SECTION --}}
<section class="py-5" style="background-color: #050505;">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative p-3">
                    <div class="position-absolute top-0 start-0 w-100 h-100 border border-warning opacity-25"
                        style="transform: translate(-10px, -10px); z-index: 0;"></div>

                    {{-- GAMBAR SEJARAH DINAMIS --}}
                    <img src="{{ $about->history_image ?? asset('images/banner.webp') }}"
                        class="img-fluid img-luxury shadow-lg position-relative w-100"
                        style="z-index: 1; object-fit: cover; min-height: 400px;" alt="History">
                </div>
            </div>

            <div class="col-lg-6 px-lg-5" data-aos="fade-left">
                <h2 class="section-title display-5 mb-4">Our History</h2>
                {{-- TEKS SEJARAH DINAMIS --}}
                <p class="lead text-white-50 lh-lg mb-4" style="font-size: 1.1rem;">
                    {{ $about->history ?? 'Jarsan Barbershop dimulai dari visi sederhana: menghadirkan kembali ritual ketampanan klasik dalam balutan modernitas.' }}
                </p>

                <div class="d-flex align-items-center gap-4 mt-5 pt-4 border-top border-secondary">
                    <div>
                        {{-- TAHUN BERDIRI DINAMIS --}}
                        <span class="d-block text-gold fs-3 fw-bold" style="font-family: 'Playfair Display', serif;">
                            {{ $about->founded_year ?? 'Est. 2024' }}
                        </span>
                        {{-- TEKS PENDEK DINAMIS --}}
                        <small class="text-white-50 letter-spacing-1">
                            {{ $about->founded_text ?? 'FOUNDED IN EXCELLENCE' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. MISSION & PHILOSOPHY --}}
{{-- Background section ini akan berubah jika Admin upload gambar Misi --}}
<section class="py-5"
    style="background: {{ $about->mission_image ? "url('$about->mission_image') center/cover fixed no-repeat" : "#0f0f0f" }}; position: relative;">

    {{-- Overlay gelap agar tulisan tetap terbaca --}}
    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: {{ $about->mission_image ? 'rgba(0,0,0,0.7)' : 'radial-gradient(circle at center, rgba(212, 175, 55, 0.03) 0%, #0a0a0a 80%)' }}; pointer-events: none;">
    </div>

    <div class="container py-5 position-relative">
        <div class="glass-box text-center mx-auto" style="max-width: 900px;" data-aos="fade-up">
            {{-- JUDUL FILOSOFI DINAMIS --}}
            <h6 class="text-gold letter-spacing-2 mb-4 fw-bold small">
                {{ $about->philosophy_title ?? 'OUR PHILOSOPHY' }}
            </h6>

            {{-- QUOTE DINAMIS --}}
            <h2 class="display-5 fw-bold text-white mb-4 fst-italic" style="font-family: 'Playfair Display', serif;">
                "{{ $about->philosophy_quote ?? 'Misi Kami Adalah Presisi' }}"
            </h2>

            {{-- ISI MISI DINAMIS --}}
            <p class="fs-5 text-white opacity-75 mx-auto lh-base mb-4">
                {{ $about->mission ?? 'Memberikan pelayanan grooming terbaik bagi semua kalangan dengan mengutamakan kualitas.' }}
            </p>

            <div class="d-flex justify-content-center gap-2 fs-5">
                <i class="bi bi-star-fill text-gold"></i>
                <i class="bi bi-star-fill text-gold"></i>
                <i class="bi bi-star-fill text-gold"></i>
                <i class="bi bi-star-fill text-gold"></i>
                <i class="bi bi-star-fill text-gold"></i>
            </div>
        </div>
    </div>
</section>

{{-- 4. WHY CHOOSE US --}}
<section class="py-5" style="background-color: #050505;">
    <div class="container py-5 text-center">
        {{-- JUDUL UTAMA DINAMIS --}}
        <h2 class="text-white mb-5 display-5 fw-bold" style="font-family: 'Playfair Display', serif;">
            {{ $about->why_title ?? 'WHY CHOOSE THE BEST?' }}
        </h2>

        <div class="row g-4">
            {{-- KARTU 1 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-scissors fs-2 text-gold"></i>
                    </div>
                    <h4 class="text-white fw-bold letter-spacing-1 mb-3">
                        {{ $about->why_1_title ?? 'MASTER BARBER' }}
                    </h4>
                    <p class="text-white-50 small mb-0">
                        {{ $about->why_1_desc ?? 'Seniman rambut tersertifikasi dengan jam terbang tinggi.' }}
                    </p>
                </div>
            </div>

            {{-- KARTU 2 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-shield-check fs-2 text-gold"></i>
                    </div>
                    <h4 class="text-white fw-bold letter-spacing-1 mb-3">
                        {{ $about->why_2_title ?? 'PREMIUM TOOLS' }}
                    </h4>
                    <p class="text-white-50 small mb-0">
                        {{ $about->why_2_desc ?? 'Hanya menggunakan produk pomade dan alat cukur kualitas internasional.' }}
                    </p>
                </div>
            </div>

            {{-- KARTU 3 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-cup-hot fs-2 text-gold"></i>
                    </div>
                    <h4 class="text-white fw-bold letter-spacing-1 mb-3">
                        {{ $about->why_3_title ?? 'EXECUTIVE LOUNGE' }}
                    </h4>
                    <p class="text-white-50 small mb-0">
                        {{ $about->why_3_desc ?? 'Kenyamanan maksimal dengan kopi pilihan dan suasana eksklusif.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection