@extends('layouts.app')

@section('title', 'Booking Ritual')

@push('styles')
<style>
/* ==========================================================
       1. VARIABLES & RESET (LUXURY DARK THEME)
       ========================================================== */
:root {
    --bg-main: #050505;
    /* Hitam Pekat */
    --bg-card: #141414;
    /* Abu Sangat Gelap */
    --gold: #D4AF37;
    /* Emas Mewah */
    --gold-hover: #f2d06b;
    /* Emas Terang */
    --text-white: #ffffff;
    --border-dark: #333333;
    --error-red: #8B0000;
    /* Merah untuk slot penuh */
}

body {
    background-color: var(--bg-main) !important;
    background-image: radial-gradient(circle at 50% 0%, #1a1a1a 0%, #050505 80%);
    color: var(--text-white) !important;
    font-family: 'Plus Jakarta Sans', sans-serif;
    /* Pastikan font ini ada atau pakai default */
}

/* Scrollbar Custom */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #000;
}

::-webkit-scrollbar-thumb {
    background: #333;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--gold);
}

/* Judul Section */
.section-title {
    color: var(--gold);
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    text-align: center;
    margin-bottom: 40px;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-size: 1.4rem;
    position: relative;
    padding-bottom: 15px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 1px;
    background-color: var(--gold);
}

/* ==========================================================
       2. ALERT SUKSES & TOMBOL STATUS
       ========================================================== */
.alert-luxury {
    background: rgba(20, 20, 20, 0.9);
    border: 1px solid #198754;
    color: white;
    text-align: center;
    padding: 30px;
    border-radius: 8px;
}

.btn-status-outline {
    border: 1px solid var(--gold);
    color: var(--gold);
    background: transparent;
    padding: 10px 25px;
    text-decoration: none;
    display: inline-block;
    margin-top: 15px;
    font-weight: bold;
    transition: 0.3s;
}

.btn-status-outline:hover {
    background: var(--gold);
    color: #000;
    box-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
}

/* ==========================================================
       3. INPUT & FORM STYLES
       ========================================================== */
.form-control {
    background-color: transparent !important;
    border: 1px solid var(--border-dark) !important;
    color: #fff !important;
    border-radius: 0;
    padding: 15px;
    font-size: 1rem;
}

.form-control:focus {
    border-color: var(--gold) !important;
    box-shadow: 0 0 10px rgba(212, 175, 55, 0.2);
}

/* FIX: Kalender agar terlihat iconnya */
input[type="date"] {
    color-scheme: dark;
}

::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
}

/* ==========================================================
       4. SELECTION CARDS (BARBER & SERVICE)
       ========================================================== */
.selection-input {
    display: none;
}

.selection-card {
    background: var(--bg-card);
    border: 1px solid var(--border-dark);
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
}

.selection-card:hover {
    border-color: var(--gold);
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.02);
}

.selection-input:checked+.selection-card {
    border: 2px solid var(--gold);
    background: rgba(212, 175, 55, 0.05);
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.15);
}

/* Icon Centang */
.selection-input:checked+.selection-card::after {
    content: '\F26E';
    /* Bootstrap check icon */
    font-family: 'bootstrap-icons';
    position: absolute;
    top: 10px;
    right: 10px;
    color: var(--gold);
    font-size: 1.2rem;
}

/* Gambar Barber */
.barber-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #333;
    margin-bottom: 15px;
    filter: grayscale(100%);
    transition: 0.4s;
}

.selection-input:checked+.selection-card .barber-img {
    filter: grayscale(0%);
    border-color: var(--gold);
    box-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
}

/* Gambar Service */
.service-img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    margin-bottom: 15px;
    filter: brightness(0.7);
    border: 1px solid #333;
}

.selection-input:checked+.selection-card .service-img {
    filter: brightness(1);
    border-color: var(--gold);
}

/* Tombol Detail Barber */
.btn-detail {
    font-size: 0.75rem;
    letter-spacing: 1px;
    color: var(--gold);
    border: 1px solid var(--gold);
    background: transparent;
    padding: 5px 15px;
    margin-top: 10px;
    text-transform: uppercase;
    transition: 0.3s;
    text-decoration: none;
    display: inline-block;
    position: relative;
    z-index: 5;
    /* Agar bisa diklik di atas card */
}

.btn-detail:hover {
    background: var(--gold);
    color: #000;
    font-weight: bold;
}

/* ==========================================================
       5. TIME SLOTS (FIXED VISIBILITY)
       ========================================================== */
.time-slot-label {
    display: block;
    /* Perbaikan: Pakai background card agar kontras dengan body hitam */
    background-color: #1a1a1a;
    color: white;
    padding: 15px 0;
    border: 1px solid #444;
    text-align: center;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
    font-size: 1rem;
    border-radius: 4px;
}

.time-slot-label:hover {
    border-color: var(--gold);
    color: var(--gold);
}

.selection-input:checked+.time-slot-label {
    background-color: var(--gold);
    border-color: var(--gold);
    color: black;
    font-weight: 800;
    box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
}

/* Slot Penuh (Merah) */
.time-slot-label.booked {
    background-color: #330505 !important;
    border-color: #8B0000 !important;
    color: #777 !important;
    text-decoration: line-through;
    cursor: not-allowed;
    position: relative;
    opacity: 0.8;
}

.time-slot-label.booked::after {
    content: 'FULL';
    position: absolute;
    top: -8px;
    right: -5px;
    background: #8B0000;
    color: white;
    font-size: 0.6rem;
    padding: 2px 5px;
    border-radius: 3px;
}

/* ==========================================================
       6. STICKY SUMMARY BAR
       ========================================================== */
.booking-summary {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(10, 10, 10, 0.95);
    backdrop-filter: blur(10px);
    border-top: 2px solid var(--gold);
    padding: 20px 0;
    z-index: 1050;
    display: none;
    /* Hide default */
    box-shadow: 0 -10px 20px rgba(0, 0, 0, 0.5);
}

.btn-gold-luxury {
    background: linear-gradient(135deg, #D4AF37 0%, #c5a028 100%);
    color: #000;
    border: none;
    font-weight: bold;
    padding: 12px 40px;
    letter-spacing: 2px;
    transition: 0.3s;
}

.btn-gold-luxury:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
}

/* ==========================================================
       7. MODAL DETAIL (DARK MODE)
       ========================================================== */
.modal-content-luxury {
    background-color: #111;
    border: 1px solid var(--gold);
    color: white;
}

.modal-header-luxury {
    border-bottom: 1px solid #333;
    padding: 20px;
}

.schedule-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #222;
}

.review-item {
    background: #1a1a1a;
    border-left: 3px solid var(--gold);
    padding: 10px;
    margin-bottom: 10px;
    text-align: left;
}
</style>
@endpush

@section('content')
<div class="container pb-5" style="margin-top: 100px; margin-bottom: 150px;">

    {{-- HEADER HALAMAN --}}
    <div class="text-center mb-5" data-aos="fade-down">
        <h5 class="text-white-50 letter-spacing-2 mb-2 fw-bold">PREMIUM BARBERSHOP</h5>
        <h2 class="display-4 fw-bold text-white">BOOK YOUR SLOT</h2>
        <div style="width: 50px; height: 3px; background: var(--gold); margin: 20px auto;"></div>
    </div>

    {{-- 
       FITUR: ALERT SUKSES + TOMBOL STATUS
       (Akan muncul setelah user berhasil boking)
    --}}
    @if(session('success'))
    <div class="alert-luxury mb-5" data-aos="zoom-in">
        <div class="mb-3">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
        </div>
        <h4 class="fw-bold mb-2">RESERVATION RECEIVED</h4>
        <p class="text-white-50 mb-3">{{ session('success') }}</p>

        <a href="{{ route('reservasi.history') }}" class="btn-status-outline">
            <i class="bi bi-clock-history me-2"></i> CEK STATUS PEMESANAN SAYA
        </a>
    </div>
    @endif

    <form action="{{ route('reservasi.store') }}" method="POST" id="bookingForm">
        @csrf

        {{-- 1. PILIH TANGGAL --}}
        <div class="mb-5" data-aos="fade-up">
            <h4 class="section-title">01. PILIH TANGGAL</h4>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    {{-- Input Date Native (Lebih stabil) --}}
                    <input type="date" name="date" class="form-control date-luxury text-center fs-4"
                        min="{{ date('Y-m-d') }}" required id="dateInput" onchange="checkAvailableSlots()">

                    <div class="text-center mt-3 text-white-50 small fst-italic">
                        <i class="bi bi-info-circle"></i> Klik tanggal untuk melihat ketersediaan jam
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. PILIH BARBER (ANY BARBER DIHAPUS) --}}
        <div class="mb-5" data-aos="fade-up">
            <h4 class="section-title">02. PILIH ARTIST</h4>
            <div class="row g-4 justify-content-center">

                {{-- Loop Barber Only (No Any Barber) --}}
                @foreach($barbers as $index => $barber)
                @php
                $imgSrc = $barber->photo_path ?? 'https://ui-avatars.com/api/?name=' . urlencode($barber->name) .
                '&background=D4AF37&color=000';
                $scheduleJson = json_encode($barber->schedule ?? []);
                $reviews = $barber->reviews->sortByDesc('created_at')->take(5)->values();
                $reviewsJson = json_encode($reviews);
                $avgRating = number_format($barber->reviews->avg('rating') ?? 0, 1);
                $ratingCount = $barber->reviews->count();
                @endphp

                <div class="col-6 col-md-3 col-lg-3">
                    {{-- Otomatis check barber pertama jika cuma satu --}}
                    <input type="radio" name="barber_id" id="barber_{{ $barber->id }}" value="{{ $barber->id }}"
                        class="selection-input" data-name="{{ $barber->name }}" onchange="checkAvailableSlots()"
                        {{ $loop->first && count($barbers) == 1 ? 'checked' : '' }}>

                    <label for="barber_{{ $barber->id }}" class="selection-card">
                        <img src="{{ $imgSrc }}" class="barber-img" alt="{{ $barber->name }}">
                        <h5 class="text-white fw-bold mb-1 text-uppercase">{{ Str::limit($barber->name, 12) }}</h5>
                        <div class="text-warning small mb-3">★ {{ $avgRating }} / 5.0</div>

                        <button type="button" class="btn-detail" onclick="event.stopPropagation(); showBarberDetail(
                                '{{ $barber->name }}', 
                                '{{ $imgSrc }}', 
                                '{{ $barber->bio ?? 'Expert Barber at Jarsan' }}', 
                                {{ $scheduleJson }}, 
                                {{ $reviewsJson }}, 
                                '{{ $avgRating }}', 
                                {{ $ratingCount }}
                            )">
                            LIHAT PROFIL
                        </button>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 3. PILIH SERVICE --}}
        <div class="mb-5" data-aos="fade-up">
            <h4 class="section-title">03. PILIH LAYANAN</h4>
            <div class="row g-4">
                @foreach($services as $service)
                <div class="col-6 col-md-4 col-lg-3">
                    <input type="radio" name="service_id" id="service_{{ $service->id }}" value="{{ $service->id }}"
                        class="selection-input" data-name="{{ $service->name }}" data-price="{{ $service->price }}"
                        onchange="updateSummary()" required>

                    <label for="service_{{ $service->id }}" class="selection-card p-0 pb-3" style="overflow: hidden;">
                        <div style="width: 100%; height: 150px; overflow: hidden; margin-bottom: 15px;">
                            <img src="{{ $service->image_path ?? asset('images/default-service.jpg') }}"
                                class="service-img m-0 border-0" style="width: 100%; height: 100%;"
                                alt="{{ $service->name }}"
                                onerror="this.src='https://via.placeholder.com/300x200/000000/FFFFFF?text=SERVICE'">
                        </div>
                        <div class="px-3 w-100">
                            <h6 class="text-white fw-bold mb-2 text-uppercase" style="font-size: 0.9rem;">
                                {{ $service->name }}</h6>
                            <div class="d-inline-block border border-warning px-3 py-1 text-gold fw-bold">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 4. PILIH WAKTU --}}
        <div class="mb-5" data-aos="fade-up">
            <h4 class="section-title">04. PILIH WAKTU</h4>
            <div class="row g-3 justify-content-center">
                @php
                $start = strtotime('10:00');
                $end = strtotime('21:00');
                @endphp

                @for ($t = $start; $t <= $end; $t +=1800) @php $timeVal=date('H:i', $t); $cleanTime=str_replace(':', ''
                    , $timeVal); @endphp <div class="col-4 col-md-2">
                    <input type="radio" name="time" id="time_{{ $cleanTime }}" value="{{ $timeVal }}"
                        class="selection-input time-radio" onchange="updateSummary()" required>

                    {{-- FIX: Warna background #1a1a1a agar kelihatan jelas --}}
                    <label for="time_{{ $cleanTime }}" class="time-slot-label time-label" id="label_{{ $cleanTime }}">
                        {{ $timeVal }}
                    </label>
            </div>
            @endfor
        </div>
</div>

{{-- 5. KONFIRMASI --}}
<div class="mb-5" data-aos="fade-up">
    <h4 class="section-title">05. DATA DIRI</h4>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <div class="mb-4">
                <label class="text-gold small fw-bold mb-2">NOMOR WHATSAPP</label>
                <input type="text" name="phone" class="form-control form-control-luxury text-center"
                    placeholder="Contoh: 08123456789" required>
            </div>
            <div class="mb-3">
                <label class="text-gold small fw-bold mb-2">CATATAN KHUSUS</label>
                <textarea name="notes" class="form-control form-control-luxury text-center" rows="2"
                    placeholder="Pesan tambahan..."></textarea>
            </div>
        </div>
    </div>
</div>

{{-- SUMMARY BAR --}}
<div class="booking-summary" id="summaryBar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <small class="text-white-50 d-block mb-1 letter-spacing-1" style="font-size: 0.7rem;">TOTAL
                    BAYAR</small>
                <h3 class="text-gold fw-bold m-0" id="totalPrice" style="font-family: 'Playfair Display', serif;">Rp 0
                </h3>
                <small class="text-white fst-italic" id="summaryText">...</small>
            </div>
            <button type="submit" class="btn btn-gold-luxury rounded-0 shadow-lg">
                CONFIRM BOOKING
            </button>
        </div>
    </div>
</div>

</form>
</div>

{{-- MODAL DETAIL BARBER --}}
<div class="modal fade" id="barberDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-content-luxury">
            <div class="modal-header modal-header-luxury">
                <h5 class="modal-title fw-bold text-gold" id="modalBarberName">Barber Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body modal-body-luxury text-center">
                <div class="row">
                    {{-- KIRI: FOTO --}}
                    <div class="col-md-5 border-end border-secondary">
                        <img src="" id="modalBarberImg" class="rounded-circle border border-warning mb-3 shadow"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <h4 class="text-white fw-bold mb-1" id="modalBarberName2">Name</h4>
                        <p class="text-white-50 small fst-italic" id="modalBarberBio">Bio...</p>
                        <div id="ratingBox" class="mb-3 p-2 bg-dark border border-secondary"></div>
                    </div>
                    {{-- KANAN: JADWAL --}}
                    <div class="col-md-7 text-start ps-md-4">
                        <h6 class="text-gold border-bottom border-secondary pb-2 mb-3 fw-bold small">JADWAL KERJA</h6>
                        <div id="scheduleContainer" class="bg-dark p-3 border border-secondary mb-4 small"></div>
                        <h6 class="text-gold border-bottom border-secondary pb-2 mb-3 fw-bold small">ULASAN TERBARU</h6>
                        <div class="reviews-container pe-2" style="max-height: 150px; overflow-y: auto;"></div>
                    </div>
                </div>
                <button class="btn btn-outline-light w-100 mt-4 rounded-0" data-bs-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// --- 1. AJAX CEK SLOT ---
function checkAvailableSlots() {
    const date = document.getElementById('dateInput').value;
    const barberRadio = document.querySelector('input[name="barber_id"]:checked');
    const barberId = barberRadio ? barberRadio.value : '';

    updateSummary();

    if (!date) return;

    // Reset
    document.querySelectorAll('.time-radio').forEach(el => {
        el.disabled = false;
    });
    document.querySelectorAll('.time-label').forEach(el => {
        el.classList.remove('booked');
    });

    // Fetch
    fetch(`/reservasi/check-slots?date=${date}&barber_id=${barberId}`)
        .then(response => response.json())
        .then(bookedTimes => {
            bookedTimes.forEach(time => {
                const cleanTime = time.substring(0, 5).replace(':', '');
                const input = document.getElementById('time_' + cleanTime);
                const label = document.querySelector(`label[for="time_${cleanTime}"]`);

                if (input && label) {
                    input.disabled = true;
                    label.classList.add('booked');
                    // Uncheck if selected
                    if (input.checked) {
                        input.checked = false;
                        updateSummary();
                    }
                }
            });
        })
        .catch(err => console.log(err));
}

// --- 2. MODAL ---
function showBarberDetail(name, imgSrc, bio, schedule, reviews, avgRating, ratingCount) {
    document.getElementById('modalBarberName').innerText = name;
    document.getElementById('modalBarberName2').innerText = name;
    document.getElementById('modalBarberImg').src = imgSrc;
    document.getElementById('modalBarberBio').innerText = bio;

    let stars = '';
    for (let i = 1; i <= 5; i++) {
        stars += i <= Math.round(avgRating) ? '<i class="bi bi-star-fill text-warning"></i> ' :
            '<i class="bi bi-star text-secondary"></i> ';
    }
    document.getElementById('ratingBox').innerHTML =
        `${stars} <br> <small class="text-white-50">${avgRating}/5.0 (${ratingCount} Ulasan)</small>`;

    const schedBox = document.getElementById('scheduleContainer');
    schedBox.innerHTML = '';
    ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'].forEach(day => {
        let time = schedule[day] || 'OFF';
        let cls = time === 'OFF' ? 'text-danger' : 'text-success';
        schedBox.innerHTML +=
            `<div class="d-flex justify-content-between mb-1"><span>${day}</span><span class="${cls} fw-bold">${time}</span></div>`;
    });

    const revBox = document.querySelector('.reviews-container');
    revBox.innerHTML = '';
    if (reviews.length > 0) {
        reviews.forEach(r => {
            revBox.innerHTML += `
                <div class="review-item bg-dark p-2 mb-2 border-start border-warning">
                    <div class="d-flex justify-content-between small">
                        <span class="text-gold fw-bold">${r.user ? r.user.name : 'User'}</span>
                        <span class="text-warning">★ ${r.rating}</span>
                    </div>
                    <p class="m-0 text-white-50 small fst-italic">"${r.comment || ''}"</p>
                </div>`;
        });
    } else {
        revBox.innerHTML = '<p class="text-center small text-muted">Belum ada ulasan.</p>';
    }

    new bootstrap.Modal(document.getElementById('barberDetailModal')).show();
}

// --- 3. SUMMARY ---
function updateSummary() {
    const bar = document.getElementById('summaryBar');
    const svc = document.querySelector('input[name="service_id"]:checked');
    const bbr = document.querySelector('input[name="barber_id"]:checked');
    const tme = document.querySelector('input[name="time"]:checked');
    const dte = document.getElementById('dateInput').value;

    if (svc) {
        bar.style.display = 'block';
        document.getElementById('totalPrice').innerText = 'Rp ' + parseInt(svc.getAttribute('data-price'))
            .toLocaleString('id-ID');
        let txt = svc.getAttribute('data-name');
        if (bbr && bbr.value) txt += ' with ' + bbr.getAttribute('data-name');
        if (dte && tme) txt += ' on ' + dte + ' at ' + tme.value;
        document.getElementById('summaryText').innerText = txt;
    }
}

// Init Logic Check saat load (jika form terisi otomatis browser)
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('dateInput').value) checkAvailableSlots();
});
</script>
@endpush