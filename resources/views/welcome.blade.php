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
    /* Efek hover putih */
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

/* --- CAROUSEL --- */
.carousel-fade .carousel-item {
    opacity: 0;
    transition-duration: 1s;
    transition-property: opacity;
}

.carousel-fade .carousel-item.active,
.carousel-fade .carousel-item-next.carousel-item-start,
.carousel-fade .carousel-item-prev.carousel-item-end {
    opacity: 1;
}

.carousel-fade .carousel-item-left,
.carousel-fade .carousel-item-right {
    opacity: 0;
}

.carousel-indicators [data-bs-target] {
    background-color: var(--luxury-gold);
}
</style>
@endpush

{{-- 1. HERO SECTION --}}
<section class="hero-vintage">
    <div class="hero-content">
        <h1 class="hero-title display-3 fw-bold text-white mb-3" data-aos="fade-up" data-aos-duration="1200">
            QUALITY <span class="fst-italic text-gold" style="font-family: 'Playfair Display', serif;">Over</span>
            QUANTITY
        </h1>

        <p class="hero-subtitle text-white-50 fs-5 mb-5 mx-auto" style="max-width: 600px; line-height: 1.8;"
            data-aos="fade-up" data-aos-delay="200">
            Sebuah ritual grooming premium. <br>
            Presisi tinggi untuk pria yang menghargai detail.
        </p>

        <div data-aos="fade-up" data-aos-delay="400">
            @auth
            <a href="{{ route('reservasi') }}" class="btn btn-gold-hero rounded-0 text-decoration-none">
                BOOK APPOINTMENT
            </a>
            @else
            <a href="{{ route('login') }}" class="btn btn-gold-hero rounded-0 text-decoration-none">
                LOGIN TO BOOK
            </a>
            @endauth
        </div>
    </div>
</section>

{{-- 2. SERVICES SECTION --}}
<section class="py-5" style="background-color: #050505;">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <h6 class="text-gold letter-spacing-3 small fw-bold">WHAT WE OFFER</h6>
            <h2 class="display-5 fw-bold text-white" style="font-family: 'Playfair Display', serif;">EXCLUSIVE SERVICES
            </h2>
        </div>

        <div class="row g-4 px-2">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-scissors fs-2 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">Expert Barber</h4>
                    <p class="text-white-50 small mb-0">
                        Ditangani oleh seniman rambut berpengalaman tinggi dengan teknik fading presisi dan gaya modern.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-cup-hot fs-2 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">Luxury Lounge</h4>
                    <p class="text-white-50 small mb-0">
                        Menunggu bukan hal membosankan. Nikmati kopi premium di ruangan ber-AC dengan musik berkelas.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card">
                    <div class="icon-circle">
                        <i class="bi bi-gem fs-2 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-3">Premium Products</h4>
                    <p class="text-white-50 small mb-0">
                        Kami hanya menggunakan pomade dan produk perawatan rambut kualitas internasional terbaik.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. TESTIMONIALS --}}
<section class="py-5" style="background: radial-gradient(circle at center, #1a1a1a 0%, #000000 100%);">
    <div class="container py-5 text-center">
        <h3 class="mb-5 text-gold letter-spacing-3 fw-bold fs-6">VOICE OF GENTLEMEN</h3>

        <div id="testi" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner pb-5">

                <div class="carousel-item active">
                    <div class="quote-content mx-auto" style="max-width: 800px;">
                        <div class="mb-4">
                            <i class="bi bi-quote fs-1 text-gold"></i>
                        </div>
                        <h3 class="display-6 fst-italic text-white fw-light mb-4"
                            style="font-family: 'Playfair Display', serif;">
                            "Fade paling rapi yang pernah saya dapatkan. Pelayanannya benar-benar next level."
                        </h3>
                        <div>
                            <span class="text-white fw-bold text-uppercase letter-spacing-2 fs-6">Zain</span>
                            <span class="text-gold mx-2">|</span>
                            <small class="text-gold">Entrepreneur</small>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="quote-content mx-auto" style="max-width: 800px;">
                        <div class="mb-4">
                            <i class="bi bi-quote fs-1 text-gold"></i>
                        </div>
                        <h3 class="display-6 fst-italic text-white fw-light mb-4"
                            style="font-family: 'Playfair Display', serif;">
                            "Vibes-nya dapet banget, serasa jadi bos setiap kali cukur di sini. Definisi ganteng
                            maksimal."
                        </h3>
                        <div>
                            <span class="text-white fw-bold text-uppercase letter-spacing-2 fs-6">Aga</span>
                            <span class="text-gold mx-2">|</span>
                            <small class="text-gold">Creative Director</small>
                        </div>
                    </div>
                </div>

            </div>

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#testi" data-bs-slide-to="0" class="active"
                    aria-current="true"></button>
                <button type="button" data-bs-target="#testi" data-bs-slide-to="1"></button>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#testi" data-bs-slide="prev">
                <span class="carousel-control-prev-icon opacity-25" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testi" data-bs-slide="next">
                <span class="carousel-control-next-icon opacity-25" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
@endsection