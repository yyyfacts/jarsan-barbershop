@extends('layouts.app')

@section('title', 'Service Menu')

@section('content')
<style>
/* --- PRICELIST HERO --- */
.hero-pricelist {
    height: 60vh;
    background: linear-gradient(rgba(0, 0, 0, 0.7), var(--deep-charcoal)),
    url('{{ asset('images/banner.webp') }}') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* --- SERVICE CARD REDESIGN --- */
.luxury-service-card {
    background: var(--matte-black);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: 0;
    overflow: hidden;
    transition: 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    height: 100%;
    position: relative;
}

.luxury-service-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(212, 175, 55, 0.15);
}

.service-img-wrapper {
    height: 250px;
    overflow: hidden;
    position: relative;
}

.service-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 1s ease;
}

.luxury-service-card:hover .service-img-wrapper img {
    transform: scale(1.1);
}

.service-info {
    padding: 30px;
    text-align: center;
}

.service-info h4 {
    color: #ffffff;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 15px;
}

.service-info p {
    color: #f0f0f0;
    opacity: 0.7;
    font-size: 0.9rem;
    height: 50px;
    overflow: hidden;
}

.service-price {
    font-size: 1.5rem;
    color: var(--luxury-gold);
    font-weight: 800;
    font-family: var(--font-heading);
    margin-top: 20px;
    display: block;
}

.duration-tag {
    background: rgba(255, 255, 255, 0.05);
    color: var(--luxury-gold);
    padding: 4px 15px;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 1px;
    display: inline-block;
    margin-bottom: 10px;
    border: 1px solid var(--gold-accent);
}
</style>

<section class="hero-pricelist">
    <div class="container text-center" data-aos="zoom-out">
        <h1 class="display-3 fw-bold text-white mb-2">SERVICE MENU</h1>
        <div class="mx-auto" style="width: 60px; height: 3px; background: var(--luxury-gold);"></div>
        <p class="lead text-white mt-4 opacity-90">Layanan perawatan rambut terbaik untuk hasil pengerjaan profesional
        </p>
    </div>
</section>

<section class="py-5" style="background: var(--deep-charcoal)">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            @forelse ($services as $service)
            <div class="col-md-6 col-lg-4 col-xl-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="luxury-service-card">
                    <div class="service-img-wrapper">
                        <img src="{{ $service->image_path ?? 'https://via.placeholder.com/400x300?text=Jarsan+Barber' }}"
                            alt="{{ $service->name }}">
                    </div>
                    <div class="service-info">
                        <span class="duration-tag text-uppercase">{{ $service->duration_minutes ?? '-' }} MINS
                            SESSION</span>
                        <h4 class="text-uppercase">{{ $service->name }}</h4>
                        <p>{{ $service->description ?? 'Deskripsi layanan premium kami.' }}</p>
                        <span class="service-price">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-white opacity-50 fs-5 italic">Belum ada menu layanan yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-5" style="background: linear-gradient(45deg, #D4AF37, #f7d774);">
    <div class="container py-4 text-center">
        <h2 class="fw-bold text-black mb-4">INGIN TAMPIL LEBIH BERANI?</h2>
        <p class="text-black mb-5 fw-medium">Pesan jadwal pengerjaan Anda sekarang dan rasakan pengalaman grooming
            eksekutif.</p>
        @auth
        <a href="{{ route('reservasi') }}" class="btn btn-dark btn-lg px-5 py-3 rounded-0 fw-bold shadow">BOOK YOUR SLOT
            NOW</a>
        @else
        <a href="{{ route('login') }}" class="btn btn-dark btn-lg px-5 py-3 rounded-0 fw-bold shadow">LOGIN TO
            BOOKING</a>
        @endauth
    </div>
</section>
@endsection