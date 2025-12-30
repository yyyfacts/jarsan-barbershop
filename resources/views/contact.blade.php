@extends('layouts.app')

@section('title', 'Get in Touch')

@section('content')
<style>
/* Styling Input Khusus Tema Luxury */
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

/* Warna Placeholder Input (Putih Transparan) */
.contact-input::placeholder {
    color: rgba(255, 255, 255, 0.5) !important;
}

/* Glass Card untuk Info Kontak */
.glass-card {
    background: rgba(30, 30, 30, 0.4);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

/* Trik CSS untuk membuat Google Maps jadi Dark Mode */
.map-container iframe {
    filter: grayscale(100%) invert(92%) contrast(83%);
    -webkit-filter: grayscale(100%) invert(92%) contrast(83%);
}

.map-wrapper {
    border: 1px solid var(--gold-accent);
    transition: 0.5s;
}

.map-wrapper:hover {
    border-color: var(--luxury-gold);
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.2);
}
</style>

<div class="container py-5 mt-5">
    <div class="row g-5">

        {{-- BAGIAN KIRI: FORMULIR --}}
        <div class="col-lg-6" data-aos="fade-right">
            <h5 class="text-gold letter-spacing-2 mb-2 fw-bold">SEND A MESSAGE</h5>
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
                <button type="submit" class="btn btn-gold-luxury w-100 py-3 fs-6 letter-spacing-2">KIRIM PESAN
                    SEKARANG</button>
            </form>
        </div>

        {{-- BAGIAN KANAN: INFO & PETA --}}
        <div class="col-lg-6" data-aos="fade-left">
            <div class="glass-card p-5 mb-4 border-0 rounded-0">
                <h4 class="text-white fw-bold mb-4 border-bottom border-secondary pb-3">OFFICE & BARBER</h4>

                {{-- Alamat --}}
                <div class="d-flex mb-4">
                    <i class="bi bi-geo-alt text-gold me-3 fs-4"></i>
                    <div>
                        <h6 class="text-white fw-bold mb-1">Lokasi</h6>
                        <p class="text-white-50 mb-0">
                            Jl. Jarsan No. 123, Barbershop City,<br> Jawa Tengah, Indonesia
                        </p>
                    </div>
                </div>

                {{-- Telepon --}}
                <div class="d-flex mb-4">
                    <i class="bi bi-telephone text-gold me-3 fs-4"></i>
                    <div>
                        <h6 class="text-white fw-bold mb-1">Telepon / WhatsApp</h6>
                        <p class="text-white-50 mb-0">0882 3256 0561</p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="d-flex mb-0">
                    <i class="bi bi-envelope text-gold me-3 fs-4"></i>
                    <div>
                        <h6 class="text-white fw-bold mb-1">Email Official</h6>
                        <p class="text-white-50 mb-0">jarsanbarbershop@gmail.com</p>
                    </div>
                </div>
            </div>

            {{-- PETA --}}
            <div class="map-wrapper map-container overflow-hidden" style="height: 350px;">
                {{-- Ganti src iframe di bawah dengan link embed Google Maps lokasi asli barbershop Anda --}}
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.270684615286!2d109.2468393!3d-7.4352778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655ea49d97c069%3A0xa19c3b8568600d8!2sPurwokerto%2C%20Banyumas%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection