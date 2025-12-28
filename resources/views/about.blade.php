@extends('layouts.app')

@section('title', 'Our Legacy')

@section('content')
<style>
.about-hero {
    height: 70vh;
    background: linear-gradient(rgba(0, 0, 0, 0.6), var(--deep-charcoal)),
    url('{{ asset('images/banner-login.webp') }}') center/cover fixed;
    display: flex;
    align-items: center;
    justify-content: center;
}

.section-title {
    font-size: 3.5rem;
    font-weight: 700;
    color: var(--luxury-gold);
}

.glass-box {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(212, 175, 55, 0.2);
    padding: 60px;
    position: relative;
}

.img-luxury {
    border: 1px solid var(--luxury-gold);
    padding: 15px;
    background: var(--matte-black);
    transition: 0.5s;
}

.img-luxury:hover {
    transform: scale(1.02);
    box-shadow: 0 0 30px var(--gold-accent);
}
</style>

<section class="about-hero">
    <div class="container text-center" data-aos="zoom-out">
        <h5 class="text-gold letter-spacing-5 mb-3">THE HERITAGE</h5>
        <h1 class="display-2 fw-bold text-white">CRAFTING CONFIDENCE</h1>
    </div>
</section>

<section class="py-5 bg-matte overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative">
                    <img src="{{ $about->history_image ?? asset('images/banner.webp') }}"
                        class="img-fluid img-luxury shadow-lg" alt="History">
                </div>
            </div>
            <div class="col-lg-6 px-lg-5" data-aos="fade-left">
                <h2 class="section-title mb-4">Sejarah Kami</h2>
                <p class="lead text-white opacity-75 lh-lg">
                    {{ $about->history ?? 'Sejarah Jarsan Barbershop dimulai dari visi untuk menghadirkan ritual ketampanan klasik dalam balutan modernitas.' }}
                </p>
                <div class="mt-5 border-top border-warning pt-4" style="width: 100px;"></div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-deep" style="background: var(--deep-charcoal)">
    <div class="container py-5">
        <div class="glass-box text-center" data-aos="fade-up">
            <h5 class="text-gold letter-spacing-2 mb-4">OUR PHILOSOPHY</h5>
            <h2 class="display-4 fw-bold text-white mb-4 italic">"Misi Kami Adalah Presisi"</h2>
            <p class="fs-5 text-white opacity-75 mx-auto" style="max-width: 800px;">
                {{ $about->mission ?? 'Memberikan pelayanan grooming terbaik bagi semua kalangan dengan mengutamakan kualitas, kenyamanan, dan detail yang tak tertandingi.' }}
            </p>
        </div>
    </div>
</section>

<section class="py-5 bg-matte">
    <div class="container py-5 text-center">
        <h2 class="text-white mb-5 display-5 fw-bold">WHY CHOOSE THE BEST?</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="p-5 glass-card h-100 border-0">
                    <i class="bi bi-scissors display-3 text-gold mb-4"></i>
                    <h4 class="text-white fw-bold">MASTER BARBER</h4>
                    <p class="text-muted">Seniman rambut yang tersertifikasi dan berpengalaman luas.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="p-5 glass-card h-100 border-0">
                    <i class="bi bi-shield-check display-3 text-gold mb-4"></i>
                    <h4 class="text-white fw-bold">PREMIUM TOOLS</h4>
                    <p class="text-muted">Hanya menggunakan produk dan alat kualitas internasional.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="p-5 glass-card h-100 border-0">
                    <i class="bi bi-cup-hot display-3 text-gold mb-4"></i>
                    <h4 class="text-white fw-bold">EXECUTIVE LOUNGE</h4>
                    <p class="text-muted">Kenyamanan maksimal dengan kopi pilihan dan suasana eksklusif.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection