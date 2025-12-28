@extends('layouts.app')

@section('content')
<style>
.hero-vintage {
    height: 95vh;
    background: linear-gradient(rgba(0, 0, 0, 0.5), var(--deep-charcoal)),
    url('{{ asset('images/banner.webp') }}') fixed center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.text-reveal {
    overflow: hidden;
}

.text-reveal span {
    display: block;
    transform: translateY(100%);
    animation: reveal 1.2s cubic-bezier(0.77, 0, 0.175, 1) forwards;
}

@keyframes reveal {
    to {
        transform: translateY(0);
    }
}

.glass-card {
    background: var(--glass-bg);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 40px;
    transition: 0.5s;
    text-align: center;
}

.glass-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
}
</style>

<section class="hero-vintage">
    <div class="container">
        <div class="text-reveal"><span class="text-gold fw-bold letter-spacing-5 mb-3 d-block">ESTABLISHED 2025</span>
        </div>
        <h1 class="display-1 fw-bold mb-4" data-aos="zoom-in">QUALITY <br> <span
                class="fst-italic text-gold">Over</span> QUANTITY</h1>
        <p class="lead mb-5 opacity-75 mx-auto" style="max-width: 700px;" data-aos="fade-up">Grooming ritual premium
            untuk pria yang menghargai detail dan presisi tinggi di setiap helai rambutnya.</p>
        <div data-aos="fade-up">
            @auth
            <a href="{{ route('reservasi') }}" class="btn btn-gold btn-lg px-5 py-3">MULAI RITUAL ANDA</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-gold btn-lg px-5 py-3">LOGIN UNTUK BOOKING</a>
            @endauth
        </div>
    </div>
</section>

<section class="py-5 bg-matte">
    <div class="container py-5">
        <h2 class="display-4 fw-bold text-center mb-5" data-aos="fade-down">EXCLUSIVE SERVICES</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card">
                    <i class="bi bi-scissors fs-1 text-gold mb-4"></i>
                    <h4 class="fw-bold">Expert Barber</h4>
                    <p class="text-muted">Ditangani oleh seniman rambut berpengalaman tinggi.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card">
                    <i class="bi bi-cup-hot fs-1 text-gold mb-4"></i>
                    <h4 class="fw-bold">Luxury Lounge</h4>
                    <p class="text-muted">Ruangan full AC dengan kopi premium saat Anda menunggu.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card">
                    <i class="bi bi-gem fs-1 text-gold mb-4"></i>
                    <h4 class="fw-bold">Premium Quality</h4>
                    <p class="text-muted">Layanan bintang lima yang dapat dinikmati semua kalangan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: #050505">
    <div class="container py-5 text-center">
        <h3 class="mb-5 text-gold letter-spacing-2">VOICE OF GENTLEMEN</h3>
        <div id="testi" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <p class="fs-2 fst-italic">"Fade paling rapi yang pernah saya dapatkan."</p>
                    <footer class="mt-3 text-gold">- Zain, Entrepreneur</footer>
                </div>
                <div class="carousel-item">
                    <p class="fs-2 fst-italic">"Vibes-nya dapet banget, serasa jadi bos."</p>
                    <footer class="mt-3 text-gold">- Aga, Creative Director</footer>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection