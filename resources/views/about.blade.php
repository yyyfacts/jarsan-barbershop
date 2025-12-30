@extends('layouts.app')

@section('title', 'Our Legacy')

@section('content')
<style>
.about-hero {
    height: 70vh;
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(10, 10, 10, 1)),
    url('{{ asset('images/banner-login.webp') }}') center/cover fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.section-title {
    font-size: 3.5rem;
    font-weight: 700;
    color: var(--luxury-gold);
    font-family: var(--font-heading);
}

.glass-box {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(212, 175, 55, 0.3);
    padding: 60px;
    position: relative;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
}

.glass-card {
    background: rgba(30, 30, 30, 0.6);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: transform 0.3s, border-color 0.3s;
}

.glass-card:hover {
    transform: translateY(-10px);
    border-color: var(--luxury-gold);
    background: rgba(30, 30, 30, 0.9);
}

.img-luxury {
    border: 2px solid var(--luxury-gold);
    padding: 10px;
    background: rgba(0, 0, 0, 0.5);
    transition: 0.5s;
}

.img-luxury:hover {
    transform: scale(1.02);
    box-shadow: 0 0 40px rgba(212, 175, 55, 0.2);
}

.letter-spacing-5 {
    letter-spacing: 5px;
}
</style>

<section class="about-hero">
    <div class="container text-center" data-aos="zoom-out">
        <h5 class="text-gold letter-spacing-5 mb-3 fw-bold">THE HERITAGE</h5>
        <h1 class="display-2 fw-bold text-white">CRAFTING CONFIDENCE</h1>
        <div style="width: 80px; height: 3px; background: var(--luxury-gold); margin: 30px auto;"></div>
    </div>
</section>

<section class="py-5 bg-matte overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative">
                    <div class="position-absolute top-0 start-0 w-100 h-100 border border-warning opacity-25"
                        style="transform: translate(-15px, -15px); z-index: 0;"></div>

                    <img src="{{ $about->history_image ?? asset('images/banner.webp') }}"
                        class="img-fluid img-luxury shadow-lg position-relative" style="z-index: 1;" alt="History">
                </div>
            </div>
            <div class="col-lg-6 px-lg-5" data-aos="fade-left">
                <h2 class="section-title mb-4">Sejarah Kami</h2>
                <p class="lead text-white opacity-75 lh-lg">
                    {{ $about->history ?? 'Sejarah Jarsan Barbershop dimulai dari visi untuk menghadirkan ritual ketampanan klasik dalam balutan modernitas. Kami percaya bahwa setiap potongan rambut adalah karya seni yang menceritakan kepribadian Anda.' }}
                </p>
                <div class="mt-5 border-top border-secondary pt-4 d-flex align-items-center gap-3">
                    <span class="text-gold fs-2 font-heading">Est. 2024</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: var(--deep-charcoal); position: relative;">
    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: radial-gradient(circle at center, rgba(212, 175, 55, 0.05) 0%, rgba(10,10,10,1) 70%);"></div>

    <div class="container py-5 position-relative">
        <div class="glass-box text-center" data-aos="fade-up">
            <h5 class="text-gold letter-spacing-2 mb-4 fw-bold">OUR PHILOSOPHY</h5>
            <h2 class="display-4 fw-bold text-white mb-4 fst-italic">"Misi Kami Adalah Presisi"</h2>
            <p class="fs-5 text-white opacity-75 mx-auto lh-base" style="max-width: 800px;">
                {{ $about->mission ?? 'Memberikan pelayanan grooming terbaik bagi semua kalangan dengan mengutamakan kualitas, kenyamanan, dan detail yang tak tertandingi.' }}
            </p>
            <div class="mt-4">
                <i class="bi bi-star-fill text-gold mx-1"></i>
                <i class="bi bi-star-fill text-gold mx-1"></i>
                <i class="bi bi-star-fill text-gold mx-1"></i>
                <i class="bi bi-star-fill text-gold mx-1"></i>
                <i class="bi bi-star-fill text-gold mx-1"></i>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-matte">
    <div class="container py-5 text-center">
        <h2 class="text-white mb-5 display-5 fw-bold">WHY CHOOSE THE BEST?</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="p-5 glass-card h-100">
                    <div class="mb-4 d-inline-block p-3 rounded-circle border border-warning bg-black">
                        <i class="bi bi-scissors display-4 text-gold"></i>
                    </div>
                    <h4 class="text-white fw-bold letter-spacing-1 mb-3">MASTER BARBER</h4>
                    <p class="text-white-50">Seniman rambut yang tersertifikasi dan berpengalaman luas dalam menangani
                        berbagai gaya klasik hingga modern.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="p-5 glass-card h-100">
                    <div class="mb-4 d-inline-block p-3 rounded-circle border border-warning bg-black">
                        <i class="bi bi-shield-check display-4 text-gold"></i>
                    </div>
                    <h4 class="text-white fw-bold letter-spacing-1 mb-3">PREMIUM TOOLS</h4>
                    <p class="text-white-50">Hanya menggunakan produk pomade, tonik, dan alat cukur kualitas
                        internasional demi keamanan kulit Anda.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="p-5 glass-card h-100">
                    <div class="mb-4 d-inline-block p-3 rounded-circle border border-warning bg-black">
                        <i class="bi bi-cup-hot display-4 text-gold"></i>
                    </div>
                    <h4 class="text-white fw-bold letter-spacing-1 mb-3">EXECUTIVE LOUNGE</h4>
                    <p class="text-white-50">Kenyamanan maksimal dengan kopi pilihan, AC dingin, dan suasana eksklusif
                        saat Anda menunggu.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection