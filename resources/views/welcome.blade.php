@extends('layouts.app')

@section('content')
<style>
/* --- HERO REVEAL ANIMATION --- */
.hero-section {
    height: 100vh;
    overflow: hidden;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), var(--deep-charcoal)),
    url('{{ asset('images/banner.webp') }}') fixed center/cover;
}

.text-reveal {
    overflow: hidden;
}

.text-reveal span {
    display: block;
    transform: translateY(100%);
    animation: reveal 1.5s cubic-bezier(0.77, 0, 0.175, 1) forwards;
}

@keyframes reveal {
    to {
        transform: translateY(0);
    }
}

.btn-gold {
    background: var(--luxury-gold);
    color: #000;
    border: none;
    padding: 15px 40px;
    font-weight: bold;
    letter-spacing: 2px;
    transition: 0.4s;
}

.btn-gold:hover {
    background: #fff;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
}

/* --- GLASS CARDS --- */
.service-card-luxury {
    background: var(--glass-white);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0;
    padding: 40px;
    transition: 0.5s;
    position: relative;
}

.service-card-luxury:hover {
    background: rgba(196, 30, 58, 0.1);
    /* Red metallic hint */
    border-color: var(--metallic-red);
    transform: scale(1.02);
}

.service-card-luxury i {
    color: var(--luxury-gold);
    font-size: 3rem;
    transition: 0.5s;
}

.service-card-luxury:hover i {
    color: var(--metallic-red);
}
</style>

<section class="hero-section d-flex align-items-center justify-content-center">
    <div class="container text-center">
        <div class="text-reveal">
            <span class="text-uppercase letter-spacing-5 text-gold fw-bold">Gentlemen's Choice</span>
        </div>
        <h1 class="display-1 fw-bold text-white mt-3" data-aos="zoom-in">
            QUALITY <br> <span class="fst-italic" style="color: var(--luxury-gold)">Over</span> QUANTITY
        </h1>
        <p class="lead text-light-50 mb-5 mt-4 px-md-5" data-aos="fade-up" data-aos-delay="400">
            Bukan sekadar potong rambut, ini adalah ritual kepercayaan diri. <br>
            Rasakan presisi tinggi di setiap helai rambut Anda.
        </p>
        <div data-aos="fade-up" data-aos-delay="600">
            <a href="{{ route('reservasi') }}" class="btn btn-gold text-uppercase">Booking Ritual Sekarang</a>
        </div>
    </div>
</section>

<section class="py-5" style="background: var(--deep-charcoal)">
    <div class="container py-5">
        <div class="row mb-5 align-items-end">
            <div class="col-md-8">
                <h2 class="display-4 fw-bold mb-0" data-aos="fade-right">PHILOSOPHY</h2>
                <p class="text-gold letter-spacing-2" data-aos="fade-right" data-aos-delay="200">Kenyamanan & Presisi
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('pricelist') }}" class="text-white text-decoration-none border-bottom">Lihat Menu
                    Lengkap <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card-luxury h-100">
                    <i class="bi bi-scissors mb-4 d-block"></i>
                    <h4 class="fw-bold mb-3">Expert Barber</h4>
                    <p class="text-muted">Master klipper kami bukan sekadar kapster, mereka adalah seniman yang memahami
                        anatomi wajah.</p>
                    <div class="mt-4 border-top border-secondary pt-3 text-gold fw-bold">PREMIUM CUT</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card-luxury h-100">
                    <i class="bi bi-cup-hot mb-4 d-block"></i>
                    <h4 class="fw-bold mb-3">Luxury Lounge</h4>
                    <p class="text-muted">Ruangan ber-AC dengan interior maskulin, free high-speed WiFi, dan kopi
                        premium saat Anda menunggu.</p>
                    <div class="mt-4 border-top border-secondary pt-3 text-gold fw-bold">COMFORT ZONE</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card-luxury h-100">
                    <i class="bi bi-gem mb-4 d-block"></i>
                    <h4 class="fw-bold mb-3">Affordable Luxury</h4>
                    <p class="text-muted">Standar pelayanan bintang lima dengan harga yang tetap bersahabat untuk
                        lifestyle mahasiswa.</p>
                    <div class="mt-4 border-top border-secondary pt-3 text-gold fw-bold">BEST VALUE</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: var(--matte-black)">
    <div class="container py-5 text-center">
        <h2 class="display-5 fw-bold mb-5" data-aos="fade-up">VOICE OF GENTLEMEN</h2>
        <div id="testiSlider" class="carousel slide" data-bs-ride="carousel" data-aos="zoom-in">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <blockquote class="blockquote px-md-5">
                        <p class="fs-3 fst-italic">"Satu-satunya barbershop di kota ini yang mengerti arti presisi.
                            Fade-nya sangat smooth!"</p>
                        <footer class="blockquote-footer mt-4 text-gold fs-5">Andi, Pelanggan Tetia</footer>
                    </blockquote>
                </div>
                <div class="carousel-item">
                    <blockquote class="blockquote px-md-5">
                        <p class="fs-3 fst-italic">"Vibe-nya dapet banget. Gak berasa kayak lagi cukur, tapi berasa lagi
                            nongkrong di lounge mewah."</p>
                        <footer class="blockquote-footer mt-4 text-gold fs-5">Zain, Entrepreneur</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-gold-gradient" style="background: linear-gradient(45deg, #D4AF37, #8a6d10);">
    <div class="container py-4 text-center text-dark">
        <h2 class="fw-bold display-5 mb-4">SIAP UNTUK TAMPIL LEBIH BERANI?</h2>
        <a href="{{ route('reservasi') }}" class="btn btn-dark btn-lg px-5 py-3 rounded-0 fw-bold shadow">BOOK YOUR SLOT
            NOW</a>
    </div>
</section>
@endsection