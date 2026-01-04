@extends('layouts.app')

@section('title', 'Service Menu')

@section('content')
<style>
:root {
    --luxury-gold: #D4AF37;
    --matte-black: #0A0A0A;
    --deep-charcoal: #121212;
    --gold-gradient: linear-gradient(135deg, #D4AF37 0%, #F1D382 50%, #B4912A 100%);
}

/* --- CINEMATIC HERO --- */
.hero-pricelist {
    height: 75vh;
    background: linear-gradient(rgba(0, 0, 0, 0.4), var(--matte-black)),
    url('{{ asset('images/banner.webp') }}') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.hero-pricelist::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 150px;
    background: linear-gradient(to top, var(--matte-black), transparent);
}

.hero-title {
    font-family: 'Playfair Display', serif;
    background: var(--gold-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: clamp(3rem, 8vw, 5rem);
    text-transform: uppercase;
    font-weight: 900;
}

/* --- BENTO SERVICE CARDS --- */
.luxury-service-card {
    background: #181818;
    border: 1px solid rgba(212, 175, 55, 0.1);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    height: 100%;
    position: relative;
    display: flex;
    flex-direction: column;
}

.luxury-service-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.8);
    z-index: 5;
}

.service-img-wrapper {
    height: 280px;
    position: relative;
    clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
}

.service-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: grayscale(100%) brightness(0.6);
    transition: 0.8s ease;
}

.luxury-service-card:hover .service-img-wrapper img {
    filter: grayscale(0%) brightness(1);
    transform: scale(1.1);
}

/* Overlay Cahaya Emas saat Hover */
.luxury-service-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.05), transparent);
    transition: 0.5s;
}

.luxury-service-card:hover::before {
    left: 100%;
}

.service-info {
    padding: 25px;
    background: linear-gradient(to bottom, #181818, #111);
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.duration-tag {
    font-size: 0.7rem;
    color: var(--luxury-gold);
    letter-spacing: 3px;
    font-weight: 700;
    display: block;
    margin-bottom: 8px;
}

.service-info h4 {
    font-size: 1.4rem;
    color: #fff;
    font-weight: 700;
    margin-bottom: 12px;
    font-family: 'Playfair Display', serif;
}

.service-price {
    font-size: 1.8rem;
    background: var(--gold-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 900;
    margin-top: 15px;
}

/* --- CTA REDESIGN --- */
.cta-luxury {
    background: linear-gradient(45deg, #050505, #111);
    border: 1px solid var(--luxury-gold);
    padding: 80px 0;
    border-radius: 20px;
    margin-bottom: 50px;
    position: relative;
    overflow: hidden;
}

.cta-luxury::after {
    content: "MOOD";
    position: absolute;
    top: -20px;
    right: -20px;
    font-size: 10rem;
    color: rgba(212, 175, 55, 0.03);
    font-weight: 900;
}

/* --- ANIMATION --- */
[data-aos] {
    transition-duration: 1000ms !important;
}
</style>

{{-- HERO SECTION --}}
<section class="hero-pricelist">
    <div class="container text-center" style="z-index: 10;">
        <div data-aos="fade-down">
            <span
                class="text-gold letter-spacing-5 mb-3 d-block">{{ $pageConfig->pricelist_subtitle ?? 'CURATED GROOMING' }}</span>
            <h1 class="hero-title">{{ $pageConfig->pricelist_title ?? 'SERVICE MENU' }}</h1>
        </div>

        <div class="d-flex justify-content-center mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div style="width: 100px; height: 1px; background: var(--luxury-gold); align-self: center;"></div>
            <i class="bi bi-scissors mx-3 text-gold fs-4"></i>
            <div style="width: 100px; height: 1px; background: var(--luxury-gold); align-self: center;"></div>
        </div>

        <p class="lead text-white mt-4 mx-auto opacity-75 font-serif italic" style="max-width: 600px;"
            data-aos="fade-up" data-aos-delay="500">
            "{{ $pageConfig->pricelist_description ?? 'Layanan perawatan rambut terbaik untuk hasil pengerjaan profesional dan presisi.' }}"
        </p>
    </div>
</section>

{{-- DAFTAR SERVICE --}}
<section class="py-5" style="background: var(--matte-black)">
    <div class="container py-5">
        <div class="row g-5 justify-content-center">
            @forelse ($services as $service)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="luxury-service-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <div class="service-img-wrapper">
                        <img src="{{ $service->image_path ?? 'https://placehold.co/600x800/1a1a1a/FFF?text=JARSAN+Service' }}"
                            alt="{{ $service->name }}">
                        <div class="position-absolute bottom-0 start-0 p-3 w-100"
                            style="background: linear-gradient(transparent, rgba(0,0,0,0.8))">
                            <span class="duration-tag text-uppercase"><i class="bi bi-clock me-1"></i>
                                {{ $service->duration_minutes ?? '-' }} MINS</span>
                        </div>
                    </div>
                    <div class="service-info">
                        <div>
                            <h4 class="text-uppercase">{{ $service->name }}</h4>
                            <p class="text-white-50 small" style="line-height: 1.4;">
                                {{ $service->description ?? 'Nikmati layanan grooming premium dengan sentuhan handuk hangat dan pijatan relaksasi.' }}
                            </p>
                        </div>
                        <div class="service-price">Rp {{ number_format($service->price, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 border border-secondary border-dashed rounded-4">
                    <i class="bi bi-calendar-x display-1 text-gold mb-4"></i>
                    <h3 class="text-white">Menu Belum Siap</h3>
                    <p class="text-white-50">Kami sedang meracik layanan terbaik untuk Anda. Silakan kembali lagi nanti.
                    </p>
                </div>
            </div>
            @endforelse
        </div>

        {{-- CTA TERINTEGRASI KE DALAM KONTEN --}}
        <div class="mt-5 pt-5" data-aos="zoom-in">
            <div class="cta-luxury container text-center">
                <h2 class="hero-title fs-2 mb-4">{{ $pageConfig->pricelist_cta_title ?? 'READY FOR THE NEXT LEVEL?' }}
                </h2>
                <p class="text-white-50 mb-5 mx-auto fs-5" style="max-width: 700px;">
                    {{ $pageConfig->pricelist_cta_text ?? 'Pesan jadwal pengerjaan Anda sekarang dan rasakan pengalaman grooming eksekutif.' }}
                </p>

                <div class="d-flex justify-content-center gap-3">
                    @auth
                    <a href="{{ route('reservasi') }}"
                        class="btn btn-gold-luxury btn-lg px-5 py-3 rounded-0 fw-bold shadow-lg text-uppercase">
                        <i class="bi bi-calendar-check me-2"></i> Book Appointment
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="btn btn-gold-luxury btn-lg px-5 py-3 rounded-0 fw-bold shadow-lg text-uppercase">
                        <i class="bi bi-person-lock me-2"></i> Member Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="btn btn-outline-light btn-lg px-5 py-3 rounded-0 fw-bold hover-gold">
                        Join Member
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>
@endsection