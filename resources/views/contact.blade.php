@extends('layouts.app')

@section('title', 'Get in Touch')

@section('content')
<style>
.contact-input {
    background: rgba(255, 255, 255, 0.02) !important;
    border: none !important;
    border-bottom: 1px solid rgba(212, 175, 55, 0.3) !important;
    color: white !important;
    padding: 15px 0 !important;
    border-radius: 0 !important;
    transition: 0.4s;
}

.contact-input:focus {
    border-bottom-color: var(--luxury-gold) !important;
    box-shadow: none !important;
    background: rgba(212, 175, 55, 0.05) !important;
}

.contact-input::placeholder {
    color: rgba(255, 255, 255, 0.3);
}

.map-container {
    border: 1px solid var(--gold-accent);
    filter: grayscale(100%) invert(90%) contrast(90%);
    transition: 0.5s;
}

.map-container:hover {
    filter: grayscale(0%) invert(0%);
}
</style>

<div class="container py-5 mt-5">
    <div class="row g-5">
        <div class="col-lg-6" data-aos="fade-right">
            <h5 class="text-gold letter-spacing-2 mb-2">SEND A MESSAGE</h5>
            <h2 class="display-4 fw-bold text-white mb-5">HUBUNGI KAMI</h2>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="small text-gold fw-bold letter-spacing-2">FULL NAME</label>
                    <input type="text" name="name" class="form-control contact-input"
                        placeholder="Masukkan nama Anda..." required>
                </div>
                <div class="mb-4">
                    <label class="small text-gold fw-bold letter-spacing-2">EMAIL ADDRESS</label>
                    <input type="email" name="email" class="form-control contact-input" placeholder="email@contoh.com"
                        required>
                </div>
                <div class="mb-5">
                    <label class="small text-gold fw-bold letter-spacing-2">MESSAGE</label>
                    <textarea name="message" rows="4" class="form-control contact-input"
                        placeholder="Apa yang ingin Anda sampaikan?"></textarea>
                </div>
                <button type="submit" class="btn btn-gold-luxury w-100 py-3 fs-5">KIRIM PESAN SEKARANG</button>
            </form>
        </div>

        <div class="col-lg-6" data-aos="fade-left">
            <div class="glass-card p-5 mb-4 border-0">
                <h4 class="text-white fw-bold mb-4">OFFICE & BARBER</h4>
                <p class="text-muted d-flex align-items-center mb-3">
                    <i class="bi bi-geo-alt text-gold me-3 fs-4"></i>
                    Jl. Jarsan No. 123, Barbershop City, Indonesia
                </p>
                <p class="text-muted d-flex align-items-center mb-3">
                    <i class="bi bi-telephone text-gold me-3 fs-4"></i>
                    0882 3256 0561
                </p>
                <p class="text-muted d-flex align-items-center mb-0">
                    <i class="bi bi-envelope text-gold me-3 fs-4"></i>
                    jarsanbarbershop@gmail.com
                </p>
            </div>

            <div class="map-container overflow-hidden" style="height: 350px;">
                <iframe src="https://www.google.com/maps/embed?..." width="100%" height="100%" style="border:0;"
                    allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection