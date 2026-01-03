@extends('layouts.app')

@section('title', 'Get in Touch')

@section('content')
@push('styles')
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

.contact-input::placeholder {
    color: rgba(255, 255, 255, 0.3) !important;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

/* Glass Card untuk Info Kontak */
.glass-card {
    background: rgba(30, 30, 30, 0.4);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: 0.3s;
}

.glass-card:hover {
    border-color: var(--luxury-gold);
    background: rgba(40, 40, 40, 0.6);
}

/* Map Dark Mode Filter */
.map-container iframe {
    filter: grayscale(100%) invert(92%) contrast(83%);
    -webkit-filter: grayscale(100%) invert(92%) contrast(83%);
}

.map-wrapper {
    border: 1px solid rgba(212, 175, 55, 0.2);
    transition: 0.5s;
}

.map-wrapper:hover {
    border-color: var(--luxury-gold);
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.2);
}
</style>
@endpush

<div class="container py-5 mt-5">
    <div class="row g-5">

        {{-- BAGIAN KIRI: FORMULIR --}}
        <div class="col-lg-6" data-aos="fade-right">
            <h6 class="text-gold letter-spacing-3 mb-2 fw-bold small">SEND A MESSAGE</h6>
            <h2 class="display-4 fw-bold text-white mb-5" style="font-family: 'Playfair Display', serif;">
                {{ $config->page_title ?? 'HUBUNGI KAMI' }}
            </h2>

            {{-- Tampilkan Subtitle jika ada --}}
            @if(!empty($config->page_subtitle))
            <p class="text-white-50 mb-4">{{ $config->page_subtitle }}</p>
            @endif

            @if(session('success'))
            <div class="alert alert-success bg-transparent border-success text-white mb-4">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="small text-gold fw-bold letter-spacing-2 mb-2">FULL NAME</label>
                    <input type="text" name="name" class="form-control contact-input" placeholder="Enter your name"
                        required>
                </div>
                <div class="mb-4">
                    <label class="small text-gold fw-bold letter-spacing-2 mb-2">EMAIL ADDRESS</label>
                    <input type="email" name="email" class="form-control contact-input" placeholder="email@example.com"
                        required>
                </div>
                <div class="mb-5">
                    <label class="small text-gold fw-bold letter-spacing-2 mb-2">MESSAGE</label>
                    <textarea name="message" rows="4" class="form-control contact-input"
                        placeholder="How can we help you?"></textarea>
                </div>
                <button type="submit" class="btn btn-gold-luxury w-100 py-3 fs-6 letter-spacing-2 fw-bold">
                    KIRIM PESAN SEKARANG
                </button>
            </form>
        </div>

        {{-- BAGIAN KANAN: INFO & PETA (DINAMIS DARI DATABASE) --}}
        <div class="col-lg-6" data-aos="fade-left">
            <div class="glass-card p-5 mb-4 border-0 rounded-0">
                <h4 class="text-white fw-bold mb-4 border-bottom border-secondary pb-3"
                    style="font-family: 'Playfair Display', serif;">OFFICE & BARBER</h4>

                {{-- Alamat Dinamis --}}
                <div class="d-flex mb-4">
                    <div class="me-3 mt-1">
                        <i class="bi bi-geo-alt text-gold fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-white fw-bold mb-1 letter-spacing-1">LOKASI STUDIO</h6>
                        <p class="text-white-50 mb-0 small lh-base">
                            {{-- nl2br agar enter di textarea terbaca sebagai baris baru --}}
                            {!! nl2br(e($config->address ?? 'Alamat belum diatur.')) !!}
                        </p>
                    </div>
                </div>

                {{-- Telepon Dinamis --}}
                <div class="d-flex mb-4">
                    <div class="me-3 mt-1">
                        <i class="bi bi-whatsapp text-gold fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-white fw-bold mb-1 letter-spacing-1">WHATSAPP OFFICIAL</h6>
                        <p class="text-white-50 mb-0 small">
                            {{ $config->whatsapp ?? '-' }}
                        </p>
                    </div>
                </div>

                {{-- JAM OPERASIONAL DINAMIS --}}
                <div class="d-flex mb-0">
                    <div class="me-3 mt-1">
                        <i class="bi bi-clock-history text-gold fs-4"></i>
                    </div>
                    <div class="w-100">
                        <h6 class="text-white fw-bold mb-3 letter-spacing-1">JAM OPERASIONAL</h6>

                        {{-- SESI MALAM --}}
                        <div class="p-2 mb-3 bg-dark border border-secondary border-opacity-25 rounded-1">
                            <div class="d-flex align-items-center text-gold small fw-bold">
                                <i class="bi bi-moon-stars me-2"></i> SESI MALAM (SETIAP HARI)
                            </div>
                            <div class="text-white ps-4 ms-1 small">
                                {{ $config->hours_night ?? '19.30 - 21.00 WIB' }}
                            </div>
                        </div>

                        {{-- SESI LAINNYA --}}
                        <ul class="list-unstyled text-white-50 mb-0 small">
                            <li
                                class="d-flex justify-content-between py-1 border-bottom border-secondary border-opacity-10">
                                <span>Senin - Jumat</span>
                                <span class="text-white">{{ $config->hours_mon_fri ?? 'Tutup' }}</span>
                            </li>
                            <li
                                class="d-flex justify-content-between py-1 border-bottom border-secondary border-opacity-10">
                                <span>Selasa, Rabu</span>
                                <span class="text-white">{{ $config->hours_tue_wed ?? 'Tutup' }}</span>
                            </li>
                            <li class="d-flex justify-content-between py-1">
                                <span>Sabtu, Minggu</span>
                                <span class="text-white">{{ $config->hours_sat_sun ?? 'Tutup' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- PETA DINAMIS --}}
            <div class="map-wrapper map-container overflow-hidden" style="height: 300px;">
                <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="{{ $config->maps_link ?? 'https://maps.google.com/maps?q=Indonesia&output=embed' }}">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection