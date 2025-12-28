@extends('layouts.app')

@section('content')
<style>
.hero-section {
    height: 90vh;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9)),
    url('{{ asset('images/banner.webp') }}') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
}

.glass-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 40px 30px;
    transition: 0.4s;
    height: 100%;
}

.glass-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.06);
}

.text-gold {
    color: var(--luxury-gold) !important;
}

.letter-spacing-5 {
    letter-spacing: 5px;
}
</style>

<section class="hero-section">
    <div class="container text-center">
        <h5 class="text-gold letter-spacing-5 fw-bold mb-3" data-aos="fade-down">PROFESSIONAL GROOMING</h5>
        <h1 class="display-1 fw-bold text-white mb-4" data-aos="zoom-in">QUALITY <span
                class="text-gold fst-italic">Over</span> QUANTITY</h1>
        <p class="lead text-white mb-5 mx-auto" style="max-width: 700px;" data-aos="fade-up">
            Ritual ketampanan premium yang dirancang khusus untuk pria yang menghargai detail dan presisi tinggi.
        </p>
        <a href="{{ route('reservasi') }}" class="btn btn-warning btn-lg px-5 py-3 rounded-0 fw-bold shadow-lg"
            data-aos="fade-up">BOOK YOUR RITUAL</a>
    </div>
</section>

<section class="py-5" style="background: var(--deep-charcoal)">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold text-white" data-aos="fade-up">OUR PHILOSOPHY</h2>
            <div class="mx-auto mt-2" style="width: 80px; height: 3px; background: var(--luxury-gold)"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card text-center">
                    <i class="bi bi-scissors text-gold display-4 mb-4"></i>
                    <h4 class="text-white fw-bold mb-3">Expert Barber</h4>
                    <p class="text-light opacity-75">Kombinasi teknik klasik dan modern oleh kapster berpengalaman untuk
                        hasil yang sangat presisi.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card text-center">
                    <i class="bi bi-cup-hot text-gold display-4 mb-4"></i>
                    <h4 class="text-white fw-bold mb-3">Luxury Lounge</h4>
                    <p class="text-light opacity-75">Nikmati kenyamanan maksimal dengan ruangan full AC, musik yang
                        rileks, dan free high-speed WiFi.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card text-center">
                    <i class="bi bi-gem text-gold display-4 mb-4"></i>
                    <h4 class="text-white fw-bold mb-3">Affordable Luxury</h4>
                    <p class="text-light opacity-75">Kualitas pelayanan bintang lima yang dapat dinikmati oleh <span
                            class="text-gold fw-bold">Semua Kalangan</span> tanpa kompromi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: var(--matte-black)">
    <div class="container text-center py-5">
        <h2 class="display-5 fw-bold text-white mb-5">VOICE OF GENTLEMEN</h2>
        <div id="quoteCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <p class="fs-2 text-white fst-italic">"Presisi pengerjaannya luar biasa. Fade-nya paling rapi yang
                        pernah saya rasakan."</p>
                    <p class="text-gold fw-bold mt-3">- ARYA, PELANGGAN SETIA</p>
                </div>
                <div class="carousel-item">
                    <p class="fs-2 text-white fst-italic">"Tempatnya sangat nyaman dan berkelas. Cocok untuk semua
                        kalangan yang ingin tampil beda."</p>
                    <p class="text-gold fw-bold mt-3">- RIZKY, ENTREPRENEUR</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection