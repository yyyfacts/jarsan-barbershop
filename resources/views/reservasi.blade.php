@extends('layouts.app')

@section('title', 'Premium Booking Ritual')

@push('styles')
<style>
/* --- LUXURY REFINED VARIABLES --- */
:root {
    --bg-dark: #0a0a0a;
    --card-bg: #141414;
    --luxury-gold: #D4AF37;
    --luxury-gold-glow: rgba(212, 175, 55, 0.3);
    --gold-gradient: linear-gradient(135deg, #D4AF37 0%, #f2d06b 100%);
    --text-white: #ffffff;
    --border-color: #2a2a2a;
    --error-red: #ff4d4d;
}

body {
    background-color: var(--bg-dark) !important;
    background-image:
        radial-gradient(circle at 10% 20%, rgba(212, 175, 55, 0.05) 0%, transparent 20%),
        radial-gradient(circle at 90% 80%, rgba(212, 175, 55, 0.05) 0%, transparent 20%);
    color: var(--text-white);
}

/* --- SUCCESS ALERT & CTA --- */
.status-alert {
    background: rgba(25, 135, 84, 0.1) !important;
    border: 1px solid #198754 !important;
    backdrop-filter: blur(10px);
    padding: 25px !important;
    animation: zoomIn 0.5s ease;
}

.btn-check-status {
    background: transparent;
    border: 1px solid var(--luxury-gold);
    color: var(--luxury-gold);
    padding: 10px 25px;
    text-decoration: none;
    transition: 0.3s;
    display: inline-block;
    margin-top: 15px;
    font-size: 0.85rem;
    letter-spacing: 2px;
    font-weight: bold;
}

.btn-check-status:hover {
    background: var(--luxury-gold);
    color: #000;
    box-shadow: 0 0 15px var(--luxury-gold-glow);
}

/* --- SECTION TITLES --- */
.section-number {
    font-family: 'Playfair Display', serif;
    color: var(--luxury-gold);
    font-size: 1.5rem;
    margin-bottom: 5px;
    display: block;
}

.section-title {
    letter-spacing: 3px;
    font-weight: 300;
    margin-bottom: 40px;
    text-transform: uppercase;
    position: relative;
    padding-bottom: 10px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 1px;
    background: var(--luxury-gold);
}

/* --- CARDS ENHANCEMENT --- */
.selection-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
}

.selection-card:hover {
    border-color: var(--luxury-gold);
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
}

.selection-input:checked+.selection-card {
    border-color: var(--luxury-gold);
    background: rgba(212, 175, 55, 0.05);
    box-shadow: 0 0 20px var(--luxury-gold-glow);
}

.barber-img {
    transition: 0.5s;
    filter: grayscale(100%);
    border: 2px solid transparent;
}

.selection-input:checked+.selection-card .barber-img {
    filter: grayscale(0%);
    border-color: var(--luxury-gold);
    transform: scale(1.05);
}

/* --- TIME SLOTS (BOOKED LOGIC) --- */
.time-slot-label {
    display: block;
    background: transparent;
    color: #fff;
    padding: 15px 0;
    border: 1px solid var(--border-color);
    cursor: pointer;
    transition: 0.3s;
    font-weight: bold;
}

.time-slot-label:hover:not(.booked) {
    border-color: var(--luxury-gold);
    color: var(--luxury-gold);
}

.selection-input:checked+.time-slot-label {
    background: var(--gold-gradient);
    color: #000;
    border-color: transparent;
}

.time-slot-label.booked {
    background: #221111 !important;
    color: #555 !important;
    border-color: #441111 !important;
    cursor: not-allowed;
    text-decoration: line-through;
    opacity: 0.7;
}

/* --- STICKY SUMMARY --- */
.booking-summary {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(10, 10, 10, 0.98);
    backdrop-filter: blur(15px);
    border-top: 1px solid var(--luxury-gold);
    padding: 20px 0;
    z-index: 1050;
    display: none;
    box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.5);
}

.btn-confirm-luxury {
    background: var(--gold-gradient);
    color: #000;
    font-weight: 800;
    letter-spacing: 2px;
    padding: 15px 40px;
    border: none;
    transition: 0.3s;
}

.btn-confirm-luxury:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px var(--luxury-gold-glow);
}

/* --- MODAL --- */
.modal-content-luxury {
    background: #111;
    border: 1px solid var(--luxury-gold);
    color: white;
    border-radius: 0;
}
</style>
@endpush

@section('content')
<div class="container pb-5" style="margin-top: 120px; margin-bottom: 150px;">

    {{-- HEADER --}}
    <div class="text-center mb-5" data-aos="fade-down">
        <h5 class="text-gold letter-spacing-2 mb-2 fw-bold" style="font-size: 0.8rem;">AUTHENTIC BARBER EXPERIENCE</h5>
        <h2 class="display-3 fw-bold text-white mb-4" style="font-family: 'Playfair Display', serif;">The Ritual</h2>
        <div class="d-flex justify-content-center align-items-center">
            <hr style="width: 50px; border-color: var(--luxury-gold); opacity: 1;">
            <i class="bi bi-scissors mx-3 text-gold fs-4"></i>
            <hr style="width: 50px; border-color: var(--luxury-gold); opacity: 1;">
        </div>
    </div>

    {{-- ALERT SUKSES DENGAN CTA CEK STATUS --}}
    @if(session('success'))
    <div class="status-alert text-center mb-5">
        <i class="bi bi-check2-circle text-success display-5 mb-3 d-block"></i>
        <h4 class="text-white fw-bold">Reservation Received!</h4>
        <p class="text-white-50 mb-0">{{ session('success') }}</p>
        <a href="{{ route('reservasi.history') }}" class="btn-check-status">
            <i class="bi bi-clock-history me-2"></i> CEK STATUS PEMESANAN
        </a>
    </div>
    @endif

    <form action="{{ route('reservasi.store') }}" method="POST" id="bookingForm">
        @csrf

        {{-- 1. PILIH TANGGAL --}}
        <div class="mb-5 text-center" data-aos="fade-up">
            <span class="section-number">01</span>
            <h4 class="section-title">Select Date</h4>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <input type="date" name="date" class="form-control date-luxury" min="{{ date('Y-m-d') }}" required
                        id="dateInput" onchange="checkAvailableSlots()">
                </div>
            </div>
        </div>

        {{-- 2. PILIH BARBER --}}
        <div class="mb-5" data-aos="fade-up">
            <div class="text-center">
                <span class="section-number">02</span>
                <h4 class="section-title">Select Artist</h4>
            </div>
            <div class="row g-4 justify-content-center">
                {{-- Opsi Any Barber --}}
                <div class="col-6 col-md-3 col-lg-2">
                    <input type="radio" name="barber_id" id="barber_null" value="" class="selection-input" checked
                        onchange="checkAvailableSlots()">
                    <label for="barber_null"
                        class="selection-card h-100 d-flex flex-column align-items-center justify-content-center p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-dark mb-3"
                            style="width: 80px; height: 80px; border: 1px solid #333;">
                            <i class="bi bi-stars fs-2 text-gold"></i>
                        </div>
                        <h6 class="text-white fw-bold mb-1 small">ANY BARBER</h6>
                        <small class="text-white-50">Recommended</small>
                    </label>
                </div>

                @foreach($barbers as $barber)
                @php
                $imgSrc = $barber->photo_path ?? 'https://ui-avatars.com/api/?name=' . urlencode($barber->name) .
                '&background=D4AF37&color=000';
                $scheduleJson = json_encode($barber->schedule ?? []);
                $reviewsJson = json_encode($barber->reviews->sortByDesc('created_at')->take(5)->values());
                $avgRating = number_format($barber->reviews->avg('rating') ?? 0, 1);
                @endphp
                <div class="col-6 col-md-3 col-lg-2">
                    <input type="radio" name="barber_id" id="barber_{{ $barber->id }}" value="{{ $barber->id }}"
                        class="selection-input" data-name="{{ $barber->name }}" onchange="checkAvailableSlots()">
                    <label for="barber_{{ $barber->id }}" class="selection-card p-3 h-100 text-center">
                        <img src="{{ $imgSrc }}" class="barber-img rounded-circle mb-3"
                            style="width: 80px; height: 80px; object-fit: cover;">
                        <h6 class="text-white fw-bold mb-2 small text-uppercase">{{ Str::limit($barber->name, 10) }}
                        </h6>
                        <button type="button" class="btn-detail"
                            onclick="event.stopPropagation(); showBarberDetail('{{ $barber->name }}', '{{ $imgSrc }}', '{{ $barber->bio ?? 'Senior Barber' }}', {{ $scheduleJson }}, {{ $reviewsJson }}, '{{ $avgRating }}', {{ $barber->reviews->count() }})">
                            DETAILS
                        </button>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 3. PILIH LAYANAN --}}
        <div class="mb-5" data-aos="fade-up">
            <div class="text-center">
                <span class="section-number">03</span>
                <h4 class="section-title">The Services</h4>
            </div>
            <div class="row g-4">
                @foreach($services as $service)
                <div class="col-6 col-md-4 col-lg-3">
                    <input type="radio" name="service_id" id="service_{{ $service->id }}" value="{{ $service->id }}"
                        class="selection-input" data-name="{{ $service->name }}" data-price="{{ $service->price }}"
                        onchange="updateSummary()" required>
                    <label for="service_{{ $service->id }}" class="selection-card p-0 overflow-hidden">
                        <img src="{{ $service->image_path ?? asset('images/default-service.jpg') }}" class="w-100"
                            style="height: 150px; object-fit: cover; opacity: 0.7;">
                        <div class="p-3 text-center">
                            <h6 class="text-white fw-bold mb-1 small text-uppercase">{{ $service->name }}</h6>
                            <span class="text-gold fw-bold small">IDR
                                {{ number_format($service->price, 0, ',', '.') }}</span>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- 4. PILIH WAKTU --}}
        <div class="mb-5" data-aos="fade-up">
            <div class="text-center">
                <span class="section-number">04</span>
                <h4 class="section-title">Set Time</h4>
            </div>
            <div class="row g-2 justify-content-center">
                @php
                $start = strtotime('10:00');
                $end = strtotime('21:00');
                @endphp
                @for ($t = $start; $t <= $end; $t +=1800) @php $timeVal=date('H:i', $t); $cleanTime=str_replace(':', ''
                    , $timeVal); @endphp <div class="col-4 col-md-2">
                    <input type="radio" name="time" id="time_{{ $cleanTime }}" value="{{ $timeVal }}"
                        class="selection-input time-radio" onchange="updateSummary()" required>
                    <label for="time_{{ $cleanTime }}" class="time-slot-label time-label"
                        data-time="{{ $timeVal }}">{{ $timeVal }}</label>
            </div>
            @endfor
        </div>
</div>

{{-- 5. KONTAK --}}
<div class="mb-5" data-aos="fade-up">
    <div class="text-center">
        <span class="section-number">05</span>
        <h4 class="section-title">Personal Info</h4>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <div class="mb-3">
                <label class="text-gold small fw-bold letter-spacing-2 mb-2">WHATSAPP NUMBER</label>
                <input type="text" name="phone" class="form-control form-control-luxury" placeholder="e.g. 08123456789"
                    required>
            </div>
            <div class="mb-3">
                <label class="text-gold small fw-bold letter-spacing-2 mb-2">NOTES (OPTIONAL)</label>
                <textarea name="notes" class="form-control form-control-luxury" rows="2"
                    placeholder="Special requests..."></textarea>
            </div>
        </div>
    </div>
</div>

{{-- STICKY SUMMARY --}}
<div class="booking-summary" id="summaryBar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-flex align-items-center">
                    <div class="pe-4 border-end border-secondary">
                        <small class="text-gold d-block letter-spacing-1">TOTAL PAYMENT</small>
                        <h3 class="text-white fw-bold m-0" id="totalPrice"
                            style="font-family: 'Playfair Display', serif;">Rp 0</h3>
                    </div>
                    <div class="ps-4">
                        <small class="text-white-50 d-block">YOUR CHOICE</small>
                        <span class="text-white italic small" id="summaryText">...</span>
                    </div>
                </div>
            </div>
            <div class="col-md-5 text-end">
                <button type="submit" class="btn btn-confirm-luxury rounded-0">
                    COMPLETE BOOKING
                </button>
            </div>
        </div>
    </div>
</div>
</form>
</div>

{{-- MODAL DETAIL BARBER --}}
<div class="modal fade" id="barberDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-content-luxury">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title fw-bold text-gold letter-spacing-1" id="modalBarberName">Barber Detail</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-4 text-center">
                        <img src="" id="modalBarberImg" class="rounded-circle border border-warning"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <h3 class="fw-bold text-white mb-1" id="modalBarberName2">Name</h3>
                        <p class="text-gold-dim fst-italic mb-3" id="modalBarberBio">Bio...</p>
                        <div id="ratingBox"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-gold border-bottom border-secondary pb-2 mb-3 fw-bold small">WEEKLY SCHEDULE
                        </h6>
                        <div id="scheduleContainer" class="small"></div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-gold border-bottom border-secondary pb-2 mb-3 fw-bold small">LATEST REVIEWS</h6>
                        <div class="reviews-container" style="max-height: 200px; overflow-y: auto;"></div>
                    </div>
                </div>
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
    const barberId = document.querySelector('input[name="barber_id"]:checked').value;

    updateSummary(); // Panggil ini juga agar ringkasan update

    if (!date) return;

    fetch(`/reservasi/check-slots?date=${date}&barber_id=${barberId}`)
        .then(response => response.json())
        .then(bookedTimes => {
            // Reset semua slot
            document.querySelectorAll('.time-radio').forEach(input => input.disabled = false);
            document.querySelectorAll('.time-label').forEach(label => label.classList.remove('booked'));

            // Tandai yang sudah penuh
            bookedTimes.forEach(time => {
                const cleanTime = time.substring(0, 5).replace(':', '');
                const input = document.getElementById('time_' + cleanTime);
                const label = document.querySelector(`label[for="time_${cleanTime}"]`);
                if (input && label) {
                    input.disabled = true;
                    label.classList.add('booked');
                }
            });
        });
}

// --- 2. SUMMARY BAR ---
function updateSummary() {
    const bar = document.getElementById('summaryBar');
    const selectedService = document.querySelector('input[name="service_id"]:checked');
    const selectedBarber = document.querySelector('input[name="barber_id"]:checked');
    const selectedTime = document.querySelector('input[name="time"]:checked');
    const selectedDate = document.getElementById('dateInput').value;

    if (selectedService) {
        bar.style.display = 'block';
        document.getElementById('totalPrice').innerText = 'Rp ' + parseInt(selectedService.getAttribute('data-price'))
            .toLocaleString('id-ID');

        let text = selectedService.getAttribute('data-name');
        if (selectedBarber && selectedBarber.value) text += ' with ' + selectedBarber.getAttribute('data-name');
        if (selectedDate && selectedTime) text += ' on ' + selectedDate + ' @ ' + selectedTime.value;

        document.getElementById('summaryText').innerText = text;
    }
}

// --- 3. DETAIL BARBER ---
function showBarberDetail(name, imgSrc, bio, schedule, reviews, avgRating, ratingCount) {
    document.getElementById('modalBarberName').innerText = name;
    document.getElementById('modalBarberName2').innerText = name;
    document.getElementById('modalBarberImg').src = imgSrc;
    document.getElementById('modalBarberBio').innerText = bio;

    // Rating
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        stars += `<i class="bi bi-star${i <= Math.round(avgRating) ? '-fill' : ''} text-warning"></i> `;
    }
    document.getElementById('ratingBox').innerHTML =
        `${stars} <span class="small text-white-50">(${avgRating} / 5.0)</span>`;

    // Schedule
    const schedCont = document.getElementById('scheduleContainer');
    schedCont.innerHTML = '';
    ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'].forEach(day => {
        let time = schedule && schedule[day] ? schedule[day] : 'OFF';
        schedCont.innerHTML +=
            `<div class="d-flex justify-content-between mb-1"><span>${day}</span><span class="${time === 'OFF' ? 'text-danger' : 'text-gold'}">${time}</span></div>`;
    });

    // Reviews
    const revCont = document.querySelector('.reviews-container');
    revCont.innerHTML = reviews.length > 0 ? '' : '<p class="text-white-50 small fst-italic">No reviews yet.</p>';
    reviews.forEach(r => {
        revCont.innerHTML += `
                <div class="p-2 mb-2 bg-dark rounded border-start border-warning">
                    <div class="d-flex justify-content-between"><small class="text-gold fw-bold">${r.user ? r.user.name : 'Guest'}</small><small class="text-warning">★ ${r.rating}</small></div>
                    <small class="text-white-50">"${r.comment || 'No comment'}"</small>
                </div>`;
    });

    new bootstrap.Modal(document.getElementById('barberDetailModal')).show();
}

// Inisialisasi awal
document.addEventListener('DOMContentLoaded', checkAvailableSlots);
</script>
@endpush