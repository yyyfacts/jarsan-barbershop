@extends('layouts.app')

@section('content')
@push('styles')
<style>
/* --- 1. CORE VARIABLES --- */
:root {
    --gold-primary: #D4AF37;
    --gold-dark: #aa8420;
    --bg-deep: #050505;
}

/* --- 2. CINEMATIC HERO WRAPPER --- */
.hero-wrapper {
    position: relative;
    height: 100vh;
    width: 100%;
    overflow: hidden;
    background: var(--bg-deep);
    display: flex;
    align-items: center;
}

/* Overlay Texture (Film Grain Effect) */
.hero-wrapper::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 2;
}

/* Vignette (Pinggiran Gelap) */
.hero-overlay-gradient {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at center, rgba(0, 0, 0, 0.2) 0%, #000000 90%);
    z-index: 1;
}

/* --- 3. SLIDER BACKGROUND --- */
.carousel-item {
    height: 100vh;
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.6) contrast(1.1);
    /* Efek Zoom in pelan (Cinematic Move) */
    animation: panZoom 20s infinite alternate;
}

@keyframes panZoom {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(1.1);
    }
}

/* --- 4. GIANT WATERMARK TEXT --- */
.giant-text-bg {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-family: 'Playfair Display', serif;
    font-size: 15vw;
    /* Sangat Besar */
    font-weight: 900;
    color: transparent;
    -webkit-text-stroke: 2px rgba(255, 255, 255, 0.05);
    /* Garis outline tipis */
    z-index: 2;
    white-space: nowrap;
    pointer-events: none;
    letter-spacing: 20px;
}

/* --- 5. MAIN CONTENT (ASYMMETRICAL) --- */
.hero-content-layer {
    position: relative;
    z-index: 10;
    width: 100%;
    padding-left: 5%;
    /* Geser ke kiri */
}

/* Garis Emas Panjang */
.gold-line-decor {
    width: 100px;
    height: 4px;
    background: var(--gold-primary);
    margin-bottom: 30px;
    transition: width 1s ease;
}

.hero-wrapper:hover .gold-line-decor {
    width: 200px;
}

/* Judul Utama */
.hero-title-main {
    font-family: 'Playfair Display', serif;
    font-size: 5rem;
    font-weight: 800;
    line-height: 0.9;
    color: #fff;
    text-transform: uppercase;
    margin-bottom: 20px;
    text-shadow: 10px 10px 0px rgba(0, 0, 0, 0.5);
}

.hero-subtitle-main {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.2rem;
    letter-spacing: 4px;
    color: #ccc;
    font-weight: 300;
    margin-bottom: 40px;
    border-left: 2px solid var(--gold-primary);
    padding-left: 20px;
}

/* --- 6. GOLD PARTICLES --- */
.gold-particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: var(--gold-primary);
    border-radius: 50%;
    opacity: 0;
    animation: floatUp 5s infinite linear;
    z-index: 3;
}

@keyframes floatUp {
    0% {
        transform: translateY(100vh) scale(0);
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

/* --- 7. BUTTON LUXURY --- */
.btn-luxury {
    position: relative;
    padding: 15px 50px;
    border: 1px solid var(--gold-primary);
    background: transparent;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 3px;
    font-weight: 600;
    overflow: hidden;
    transition: 0.4s;
    font-size: 0.9rem;
}

.btn-luxury::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0%;
    height: 100%;
    background: var(--gold-primary);
    transition: 0.4s cubic-bezier(0.19, 1, 0.22, 1);
    z-index: -1;
}

.btn-luxury:hover::before {
    width: 100%;
}

.btn-luxury:hover {
    color: #000;
    border-color: var(--gold-primary);
}

/* --- 8. SERVICES SECTION (GLOW CARDS) --- */
.service-card-unique {
    background: #0a0a0a;
    border: 1px solid #222;
    padding: 40px 30px;
    position: relative;
    overflow: hidden;
    transition: 0.4s;
    height: 100%;
}

.service-card-unique::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 60%);
    opacity: 0;
    transform: scale(0.5);
    transition: 0.5s;
}

.service-card-unique:hover::before {
    opacity: 1;
    transform: scale(1);
}

.service-card-unique:hover {
    border-color: var(--gold-primary);
    transform: translateY(-5px);
}

.service-num {
    font-size: 3rem;
    font-weight: 900;
    color: #1a1a1a;
    position: absolute;
    top: 10px;
    right: 20px;
    transition: 0.4s;
}

.service-card-unique:hover .service-num {
    color: var(--gold-primary);
    opacity: 0.2;
}

/* --- 9. FOOTER DECORATION (ABSTRAK) --- */
.footer-decoration-wrapper {
    position: relative;
    background: #050505;
    /* Dark Background */
    overflow: hidden;
    padding-bottom: 20px;
}

/* Dekorasi Garis Diagonal */
.abstract-lines {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: repeating-linear-gradient(45deg,
            transparent,
            transparent 10px,
            rgba(255, 255, 255, 0.02) 10px,
            /* Sangat tipis */
            rgba(255, 255, 255, 0.02) 20px);
    pointer-events: none;
    z-index: 0;
}

/* Dekorasi Ikon Gunting Raksasa */
.giant-icon-decor {
    position: absolute;
    bottom: -80px;
    right: 5%;
    font-size: 25rem;
    color: rgba(255, 255, 255, 0.02);
    /* Sangat transparan */
    transform: rotate(-15deg);
    pointer-events: none;
    z-index: 0;
}

/* Dekorasi Noise Overlay Bawah */
.noise-overlay-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.05'/%3E%3C/svg%3E");
    mask-image: linear-gradient(to top, black, transparent);
    -webkit-mask-image: linear-gradient(to top, black, transparent);
    pointer-events: none;
    z-index: 1;
}
</style>
@endpush

{{-- 1. HERO SECTION --}}
<section class="hero-wrapper">

    {{-- PARTIKEL EMAS --}}
    <div class="gold-particle" style="left: 10%; animation-duration: 6s;"></div>
    <div class="gold-particle" style="left: 30%; animation-duration: 8s;"></div>
    <div class="gold-particle" style="left: 70%; animation-duration: 5s;"></div>
    <div class="gold-particle" style="left: 90%; animation-duration: 7s;"></div>

    {{-- SLIDER (GESER) --}}
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000"
        style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ $setting && $setting->hero_image ? $setting->hero_image : asset('images/banner.webp') }}"
                    alt="Slide 1">
            </div>
            @if($setting && $setting->hero_image_2)
            <div class="carousel-item">
                <img src="{{ $setting->hero_image_2 }}" alt="Slide 2">
            </div>
            @endif
            @if($setting && $setting->hero_image_3)
            <div class="carousel-item">
                <img src="{{ $setting->hero_image_3 }}" alt="Slide 3">
            </div>
            @endif
        </div>
    </div>

    {{-- OVERLAY GELAP --}}
    <div class="hero-overlay-gradient"></div>


    {{-- KONTEN UTAMA --}}
    <div class="container hero-content-layer">
        <div class="row">
            <div class="col-lg-8" data-aos="fade-right" data-aos-duration="1200">

                {{-- Garis Dekorasi --}}
                <div class="gold-line-decor"></div>

                <h1 class="hero-title-main">
                    {!! $setting->hero_title ?? 'PREMIUM <br> <span style="color:var(--gold-primary)">CUTS</span> ONLY.'
                    !!}
                </h1>

                <p class="hero-subtitle-main">
                    {{ $setting->hero_subtitle ?? 'Lebih dari sekadar cukur rambut. Ini adalah pernyataan gaya dan jati diri pria sejati.' }}
                </p>

                @auth
                <a href="{{ route('reservasi') }}" class="btn btn-luxury text-decoration-none">
                    {{ $setting->hero_btn_text ?? 'BOOK APPOINTMENT' }}
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-luxury text-decoration-none">
                    {{ $setting->hero_btn_text ?? 'BECOME A MEMBER' }}
                </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- SCROLL INDICATOR --}}
    <div
        style="position: absolute; right: 40px; bottom: 40px; z-index: 10; writing-mode: vertical-rl; text-orientation: mixed; color: rgba(255,255,255,0.5); font-size: 0.8rem; letter-spacing: 3px;">
        SCROLL DOWN <i class="bi bi-arrow-down-long mt-2"></i>
    </div>
</section>

{{-- 2. PROMO / INFO BOARD (DINAMIS DARI DATABASE) --}}
@if($setting && $setting->promo_active)
<section class="py-5 position-relative"
    style="background: linear-gradient(to right, #0a0a0a, #111); border-bottom: 1px solid #222;">
    <div class="container py-4" data-aos="fade-up">
        <div class="row align-items-center bg-black border border-secondary rounded-4 overflow-hidden shadow-lg"
            style="border-color: rgba(255,255,255,0.1) !important;">

            <div class="col-md-5 p-0 position-relative" style="min-height: 350px;">
                <img src="{{ $setting->promo_image ?? asset('images/banner.webp') }}" alt="Info"
                    class="w-100 h-100 position-absolute top-0 start-0"
                    style="object-fit: cover; filter: brightness(0.9);">
                <div class="d-md-none position-absolute w-100 h-100"
                    style="background: linear-gradient(to top, #000, transparent); bottom: 0;"></div>
            </div>

            <div class="col-md-7 p-5 text-center text-md-start d-flex flex-column justify-content-center">
                <div class="mb-3">
                    <span class="badge bg-white text-dark px-3 py-2 rounded-1 fw-bold letter-spacing-2"
                        style="font-size: 0.75rem; border: 1px solid var(--gold-primary);">
                        <i class="bi bi-bell-fill text-gold me-2"></i> {{ $setting->promo_tag ?? 'INFORMASI' }}
                    </span>
                </div>
                <h2 class="text-white fw-bold display-6 mb-4"
                    style="font-family: 'Playfair Display', serif; line-height: 1.2;">
                    {{ $setting->promo_title ?? 'JUDUL PENGUMUMAN' }}
                </h2>
                <p class="text-white-50 mb-4 fs-5 lh-base fw-light">
                    {{ $setting->promo_desc ?? 'Deskripsi pengumuman atau promo akan muncul di sini.' }}
                </p>
                @if($setting->promo_link)
                <div>
                    <a href="{{ $setting->promo_link }}" class="btn btn-luxury rounded-0 px-5 py-3 fw-bold">
                        CEK SELENGKAPNYA <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

{{-- 3. SERVICES SECTION --}}
<section class="py-5" style="background-color: #050505;">
    <div class="container py-5">
        <div class="row align-items-end mb-5" data-aos="fade-up">
            <div class="col-md-8">
                <h6 class="text-gold letter-spacing-3 small fw-bold mb-2">OUR EXPERTISE</h6>
                <h2 class="display-4 fw-bold text-white mb-0" style="font-family: 'Playfair Display', serif;">
                    {{ $setting->services_title ?? 'EXCLUSIVE SERVICES' }}
                </h2>
            </div>
            <div class="col-md-4 text-md-end">
                <div style="width: 100%; height: 1px; background: #333; margin-bottom: 15px;"></div>
                <p class="text-white-50 small mb-0">
                    {{ $setting->services_subtext ?? 'Experience the best grooming service in town.' }}</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card-unique">
                    <span class="service-num">01</span>
                    <i class="bi bi-scissors fs-1 text-white mb-4 d-block"></i>
                    <h4 class="text-gold fw-bold mb-3">{{ $setting->service_1_title ?? 'Classic Cut' }}</h4>
                    <p class="text-white-50 small mb-0 lh-lg">
                        {{ $setting->service_1_desc ?? 'Potongan presisi dengan konsultasi gaya.' }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card-unique" style="border-top: 3px solid var(--gold-primary);">
                    <span class="service-num">02</span>
                    <i class="bi bi-brush fs-1 text-white mb-4 d-block"></i>
                    <h4 class="text-gold fw-bold mb-3">{{ $setting->service_2_title ?? 'Beard Trim' }}</h4>
                    <p class="text-white-50 small mb-0 lh-lg">
                        {{ $setting->service_2_desc ?? 'Perawatan jenggot dan kumis profesional.' }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card-unique">
                    <span class="service-num">03</span>
                    <i class="bi bi-stars fs-1 text-white mb-4 d-block"></i>
                    <h4 class="text-gold fw-bold mb-3">{{ $setting->service_3_title ?? 'Hair Spa' }}</h4>
                    <p class="text-white-50 small mb-0 lh-lg">
                        {{ $setting->service_3_desc ?? 'Relaksasi total dengan pijatan kepala.' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 4. TESTIMONIALS & FOOTER DECORATION (ABSTRAK) --}}
<div class="footer-decoration-wrapper">

    {{-- Elemen Dekorasi Abstrak --}}
    <div class="abstract-lines"></div>
    <div class="noise-overlay-bottom"></div>
    <i class="bi bi-scissors giant-icon-decor"></i> {{-- Icon Gunting Raksasa Transparan --}}

    <section class="py-5 position-relative" style="z-index: 2;">
        <div class="container py-5 text-center">

            {{-- Hiasan Garis Emas Kecil di Atas --}}
            <div style="width: 50px; height: 2px; background: var(--gold-primary); margin: 0 auto 20px;"></div>

            <h3 class="mb-5 text-gold letter-spacing-3 fw-bold fs-6 text-uppercase">
                {{ $setting->testimonial_title ?? 'VOICE OF GENTLEMEN' }}
            </h3>

            <div class="row justify-content-center">
                <div class="col-md-10" data-aos="zoom-in">
                    {{-- Widget Testimonial --}}
                    <script src="https://elfsightcdn.com/platform.js" async></script>
                    <div class="elfsight-app-93067b61-ef61-4ae5-9ee5-08877c5d93c9" data-elfsight-app-lazy></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection