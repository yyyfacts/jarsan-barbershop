@extends('layouts.app')

@section('content')
@push('styles')
<style>
/* --- THEME VARIABLES --- */
:root {
    --luxury-gold: #D4AF37;
    --gold-dim: #c5a028;
}

/* --- HERO SECTION --- */
.hero-vintage {
    height: 100vh;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9), #0a0a0a),
    url('{{ asset('images/banner.webp') }}') no-repeat center center/cover fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 900px;
    padding: 0 20px;
}

.hero-title {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    letter-spacing: 2px;
    text-shadow: 0 5px 15px rgba(0, 0, 0, 0.8);
}

.hero-subtitle {
    font-family: 'Poppins', sans-serif;
    font-weight: 300;
    letter-spacing: 1px;
    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.8);
}

/* --- NEW GOLD BUTTON STYLING --- */
.btn-gold-hero {
    background: linear-gradient(135deg, var(--luxury-gold) 0%, #8a7018 100%);
    border: 1px solid var(--luxury-gold);
    color: #000;
    letter-spacing: 3px;
    font-size: 0.9rem;
    font-weight: 700;
    padding: 15px 40px;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    z-index: 1;
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
}

.btn-gold-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0%;
    height: 100%;
    background: #fff;
    transition: 0.4s;
    z-index: -1;
}

.btn-gold-hero:hover::before {
    width: 100%;
}

.btn-gold-hero:hover {
    color: #000;
    box-shadow: 0 0 40px rgba(255, 255, 255, 0.6);
    border-color: #fff;
    transform: scale(1.05);
}

/* --- GLASS CARDS --- */
.glass-card {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    padding: 40px 30px;
    transition: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    text-align: center;
    height: 100%;
}

.glass-card:hover {
    border-color: var(--luxury-gold);
    background: rgba(10, 10, 10, 0.8);
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
}

.icon-circle {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    margin: 0 auto 25px;
    transition: 0.4s;
}

.glass-card:hover .icon-circle {
    border-color: var(--luxury-gold);
    background: rgba(212, 175, 55, 0.1);
    color: var(--luxury-gold);
}

.glass-card:hover i {
    color: var(--luxury-gold) !important;
}
</style>
@endpush

{{-- 1. HERO SECTION --}}
<section class="hero-vintage">
    <div class="hero-content">
        {{-- JUDUL DINAMIS (Pakai {!! !!} agar HTML terbaca) --}}
        <h1 class="hero-title display-3 fw-bold text-white mb-3" data-aos="fade-up" data-aos-duration="1200">
            {!! $setting->hero_title ?? 'QUALITY <span class="fst-italic text-gold"
                style="font-family: \'Playfair Display\', serif;">Over</span> QUANTITY' !!}
        </h1>

        {{-- SUBTITLE DINAMIS --}}
        <p class="hero-subtitle text-white-50 fs-5 mb-5 mx-auto" style="max-width: 600px; line-height: 1.8;"
            data-aos="fade-up" data-aos-delay="200">
            {{ $setting->hero_subtitle ?? 'Sebuah ritual grooming premium. Presisi tinggi untuk pria yang menghargai detail.' }}
        </p>

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
</section>

{{-- 2. SERVICES SECTION --}}
<section class="py-5" style="background-color: #050505;">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            {{-- SUBTEXT LAYANAN --}}
            <h6 class="text-gold letter-spacing-3 small fw-bold">
                {{ $setting->services_subtext ?? 'WHAT WE OFFER' }}
            </h6>
            {{-- JUDUL LAYANAN --}}
            <h2 class="display-5 fw-bold text-white" style="font-family: 'Playfair Display', serif;">
                {{ $setting->services_title ?? 'EXCLUSIVE SERVICES' }}
            </h2>
        </div>

        <div class="row g-4 px-2">
            {{-- CARD 1 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-scissors fs-2 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">
                        {{ $setting->service_1_title ?? 'Expert Barber' }}
                    </h4>
                    <p class="text-white-50 small mb-0">
                        {{ $setting->service_1_desc ?? 'Ditangani oleh seniman rambut berpengalaman tinggi dengan teknik fading presisi dan gaya modern.' }}
                    </p>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-cup-hot fs-2 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">
                        {{ $setting->service_2_title ?? 'Luxury Lounge' }}
                    </h4>
                    <p class="text-white-50 small mb-0">
                        {{ $setting->service_2_desc ?? 'Menunggu bukan hal membosankan. Nikmati kopi di ruangan ber-AC dengan musik berkelas.' }}
                    </p>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-gem fs-2 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">
                        {{ $setting->service_3_title ?? 'Premium Products' }}
                    </h4>
                    <p class="text-white-50 small mb-0">
                        {{ $setting->service_3_desc ?? 'Kami hanya menggunakan pomade dan produk perawatan rambut kualitas terbaik.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. TESTIMONIALS (GOOGLE REVIEWS WIDGET) --}}
<section class="py-5" style="background: radial-gradient(circle at center, #1a1a1a 0%, #000000 100%);">
    <div class="container py-5 text-center">
        {{-- JUDUL TESTIMONIAL --}}
        <h3 class="mb-5 text-gold letter-spacing-3 fw-bold fs-6">
            {{ $setting->testimonial_title ?? 'VOICE OF GENTLEMEN' }}
        </h3>

        <div class="row justify-content-center">
            <div class="col-md-10" data-aos="fade-up">

                {{-- WIDGET ELFSIGHT --}}
                <script src="https://elfsightcdn.com/platform.js" async></script>
                <div class="elfsight-app-93067b61-ef61-4ae5-9ee5-08877c5d93c9" data-elfsight-app-lazy></div>

            </div>
        </div>
    </div>
</section>
@endsection