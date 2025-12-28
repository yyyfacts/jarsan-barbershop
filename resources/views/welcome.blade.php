@extends('layouts.app')

@section('content')
<style>
.hero-luxury {
    height: 100vh;
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8)),
    url('{{ asset('images/banner.webp') }}') fixed center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.display-title {
    font-size: clamp(2.5rem, 8vw, 5rem);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.1;
}

.glass-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--luxury-gold);
    padding: 40px 20px;
    transition: 0.4s;
}

.glass-card:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.1);
}
</style>

<section class="hero-luxury">
    <div class="container" data-aos="zoom-in">
        <h5 class="text-gold mb-3 fw-bold" style="letter-spacing: 5px;">PROFESSIONAL GROOMING</h5>
        <h1 class="display-title mb-4">QUALITY <br> <span class="fst-italic text-gold">Over</span> QUANTITY</h1>
        <div class="mt-5">
            @auth
            <a href="{{ route('reservasi') }}" class="btn btn-gold-luxury btn-lg px-5 py-3">BOOK YOUR RITUAL</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-gold-luxury btn-lg px-5 py-3">LOGIN TO BOOKING</a>
            @endauth
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row g-4 text-center">
            <div class="col-md-4" data-aos="fade-up">
                <div class="glass-card">
                    <i class="bi bi-scissors fs-1 text-gold"></i>
                    <h3 class="mt-3 text-white fw-bold">EXPERT BARBER</h3>
                    <p class="text-white mt-2">Seniman rambut profesional.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card">
                    <i class="bi bi-cup-hot fs-1 text-gold"></i>
                    <h3 class="mt-3 text-white fw-bold">LUXURY LOUNGE</h3>
                    <p class="text-white mt-2">Kenyamanan maksimal.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="glass-card">
                    <i class="bi bi-gem fs-1 text-gold"></i>
                    <h3 class="mt-3 text-white fw-bold">PREMIUM QUALITY</h3>
                    <p class="text-white mt-2">Untuk semua kalangan.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection