@extends('layouts.app')

@section('title', 'Contact Studio')

@section('content')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Italiana&family=Manrope:wght@200;400;700&display=swap"
    rel="stylesheet">
<style>
:root {
    --gold: #D4AF37;
    --gold-dim: #8a701e;
    --black: #050505;
    --glass: rgba(20, 20, 20, 0.7);
}

body {
    background-color: var(--black);
    color: #fff;
    font-family: 'Manrope', sans-serif;
    overflow-x: hidden;
}

/* --- 1. BACKGROUND YANG "HIDUP" (NOISE & GLOW) --- */
.noise-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('https://grainy-gradients.vercel.app/noise.svg');
    opacity: 0.05;
    z-index: -1;
    pointer-events: none;
}

.ambient-glow {
    position: fixed;
    top: -20%;
    right: -10%;
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.08) 0%, rgba(0, 0, 0, 0) 70%);
    z-index: -2;
    animation: pulseGlow 10s infinite alternate;
}

@keyframes pulseGlow {
    0% {
        transform: scale(1);
        opacity: 0.5;
    }

    100% {
        transform: scale(1.2);
        opacity: 0.8;
    }
}

/* --- 2. TYPOGRAPHY MEWAH --- */
.font-luxury {
    font-family: 'Italiana', serif;
    font-weight: 400;
}

/* Teks Berjalan (Marquee) */
.marquee-container {
    overflow: hidden;
    white-space: nowrap;
    position: absolute;
    top: 10%;
    left: 0;
    width: 100%;
    opacity: 0.03;
    font-size: 15rem;
    font-family: 'Italiana', serif;
    line-height: 1;
    z-index: -1;
    pointer-events: none;
}

.marquee-content {
    display: inline-block;
    animation: marquee 40s linear infinite;
}

@keyframes marquee {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
    }
}

/* --- 3. CUSTOM FORM INPUT (MINIMALIS) --- */
.input-group-luxury {
    position: relative;
    margin-bottom: 3rem;
}

.input-luxury {
    width: 100%;
    background: transparent;
    border: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    padding: 15px 0;
    color: #fff;
    font-size: 1.2rem;
    font-family: 'Italiana', serif;
    transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
}

.input-luxury:focus {
    outline: none;
    border-bottom-color: var(--gold);
    padding-left: 20px;
    /* Geser sedikit saat fokus */
}

.label-luxury {
    position: absolute;
    top: 15px;
    left: 0;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 2px;
    color: rgba(255, 255, 255, 0.4);
    pointer-events: none;
    transition: 0.5s;
}

.input-luxury:focus~.label-luxury,
.input-luxury:valid~.label-luxury {
    top: -20px;
    color: var(--gold);
    font-size: 0.7rem;
}

/* --- 4. BUTTON MAGNETIK --- */
.btn-gold-outline {
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--gold);
    background: transparent;
    padding: 20px 40px;
    font-family: 'Manrope', sans-serif;
    text-transform: uppercase;
    letter-spacing: 3px;
    font-size: 0.8rem;
    transition: 0.4s;
    position: relative;
    overflow: hidden;
}

.btn-gold-outline:hover {
    border-color: var(--gold);
    background: rgba(212, 175, 55, 0.05);
    color: #fff;
    box-shadow: 0 0 30px rgba(212, 175, 55, 0.2);
}

/* --- 5. LAYOUT UNIK (MAP FIX) --- */
.overlap-section {
    position: relative;
    margin-top: 100px;
}

.map-frame {
    width: 100%;
    height: 70vh;
    /* Tinggi Peta Dominan */
    filter: grayscale(100%) invert(90%) contrast(120%);
    transition: 1s;
    overflow: hidden;
    background: #1a1a1a;
    /* Placeholder bg */
}

.map-frame:hover {
    filter: grayscale(0%) invert(0%);
}

/* PERBAIKAN CSS MAPS AGAR RESPONSIVE */
.map-frame iframe {
    width: 100% !important;
    height: 100% !important;
    border: none !important;
}

.floating-card {
    background: rgba(18, 18, 18, 0.85);
    /* Glass effect gelap */
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    padding: 4rem;
    position: absolute;
    right: 10%;
    bottom: -50px;
    /* Offset ke bawah agar unik */
    width: 450px;
    box-shadow: 0 20px 80px rgba(0, 0, 0, 0.8);
    border-top: 3px solid var(--gold);
}

@media (max-width: 991px) {
    .floating-card {
        position: relative;
        right: 0;
        bottom: 0;
        width: 100%;
        margin-top: -100px;
        padding: 2rem;
    }

    .marquee-container {
        font-size: 8rem;
    }
}
</style>
@endpush

{{-- BACKGROUND ELEMENTS --}}
<div class="noise-bg"></div>
<div class="ambient-glow"></div>

{{-- MARQUEE BACKGROUND --}}
<div class="marquee-container">
    <div class="marquee-content">
        RESERVATION &nbsp; • &nbsp; CONTACT &nbsp; • &nbsp; MOOD CUT &nbsp; • &nbsp; STYLE &nbsp; • &nbsp;
        RESERVATION &nbsp; • &nbsp; CONTACT &nbsp; • &nbsp; MOOD CUT &nbsp; • &nbsp; STYLE &nbsp; • &nbsp;
    </div>
</div>

<div class="container" style="padding-top: 150px; padding-bottom: 100px;">
    <div class="row">

        {{-- KOLOM KIRI: HEADLINE & FORM --}}
        <div class="col-lg-6 mb-5" data-aos="fade-right" data-aos-duration="1200">
            <span class="text-white-50 small letter-spacing-3 text-uppercase d-block mb-3">Est. 2024 • Kroya</span>

            <h1 class="display-2 font-luxury text-white mb-4" style="line-height: 1.1;">
                Let's Craft <br>
                <span style="color: var(--gold); font-style: italic;">Your Style.</span>
            </h1>

            <p class="text-white-50 mb-5 fs-5 fw-light" style="max-width: 450px;">
                {{ $config->page_subtitle ?? 'Kami siap mendengarkan preferensi gaya Anda. Hubungi kami untuk konsultasi eksklusif.' }}
            </p>

            @if(session('success'))
            <div class="p-3 mb-5 border border-success text-success bg-transparent"
                style="border-style: dashed !important;">
                ✓ {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="mt-5">
                @csrf
                <div class="input-group-luxury">
                    <input type="text" name="name" class="input-luxury" required autocomplete="off">
                    <label class="label-luxury">Your Name</label>
                </div>

                <div class="input-group-luxury">
                    <input type="email" name="email" class="input-luxury" required autocomplete="off">
                    <label class="label-luxury">Email Address</label>
                </div>

                <div class="input-group-luxury">
                    <textarea name="message" class="input-luxury" rows="1" required style="resize: none; height: auto;"
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                    <label class="label-luxury">What's on your mind?</label>
                </div>

                <button type="submit" class="btn-gold-outline mt-4">
                    Send Request
                </button>
            </form>
        </div>

        {{-- KOLOM KANAN: HANYA GARIS DEKORATIF --}}
        <div class="col-lg-6 position-relative d-none d-lg-block">
            <div
                style="position: absolute; right: 0; top: 20%; height: 300px; width: 1px; background: linear-gradient(to bottom, var(--gold), transparent);">
            </div>
        </div>

    </div>
</div>

{{-- SECTION MAP & FLOATING INFO (ASIMETRIS) --}}
<div class="container-fluid px-0 overlap-section position-relative">

    {{-- MAP FULL WIDTH --}}
    <div class="map-frame">
        @if(!empty($config->maps_link))
        {{-- Gunakan {!! !!} agar kode HTML iframe dari Google terbaca & tampil --}}
        {!! $config->maps_link !!}
        @else
        <div class="d-flex align-items-center justify-content-center h-100 text-white-50">
            <small>MAPS LOCATION NOT SET</small>
        </div>
        @endif
    </div>

    {{-- KARTU INFO YANG MENGAMBANG (FLOATING) DI ATAS MAP --}}
    <div class="floating-card" data-aos="fade-up" data-aos-delay="200">
        <h3 class="font-luxury text-white mb-5">Studio Information</h3>

        <div class="row g-4">
            <div class="col-12">
                <small class="text-white-50 text-uppercase letter-spacing-2">Location</small>
                <p class="text-white fs-5 mt-1 font-luxury lh-sm">
                    {!! nl2br(e($config->address ?? 'Alamat belum diisi.')) !!}
                </p>
            </div>

            <div class="col-6">
                <small class="text-white-50 text-uppercase letter-spacing-2">Whatsapp</small>
                <p class="text-white mt-1">{{ $config->whatsapp ?? '-' }}</p>
            </div>

            <div class="col-6">
                <small class="text-white-50 text-uppercase letter-spacing-2">Email</small>
                <p class="text-white mt-1">{{ $config->email ?? '-' }}</p>
            </div>

            <div class="col-12 border-top border-secondary pt-4 mt-4 border-opacity-25">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-gold text-uppercase letter-spacing-2">Today's Hours</small>
                    {{-- Logika sederhana untuk menampilkan jam sesuai hari ini --}}
                    <span class="text-white font-luxury fs-5">
                        {{ \Carbon\Carbon::now()->isWeekend() ? ($config->hours_sat_sun ?? 'Check Schedule') : ($config->hours_mon_fri ?? 'Check Schedule') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Spacer bawah agar Floating Card tidak kepotong footer --}}
<div style="height: 100px; background: var(--black);"></div>

@endsection