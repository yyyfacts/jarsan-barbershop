@extends('layouts.app')

@section('title', 'Booking Ritual')

@push('styles')
<style>
/* --- LUXURY THEME VARIABLES --- */
:root {
    --bg-dark: #0a0a0a;
    --card-bg: #121212;
    --luxury-gold: #D4AF37;
    --gold-dim: rgba(212, 175, 55, 0.2);
    --text-white: #ffffff;
    --border-color: #333;
}

/* BACKGROUND DENGAN LAYERED TEXTURE */
body {
    background-color: var(--bg-dark) !important;
    background-image:
        radial-gradient(circle at 50% 0%, #1a1a1a 0%, #0a0a0a 70%),
        url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
    background-attachment: fixed;
}

/* --- 1. RITUAL PROGRESS INDICATOR --- */
.ritual-steps {
    display: flex;
    justify-content: space-between;
    position: relative;
    margin-bottom: 80px;
    padding: 0 20px;
}

.ritual-steps::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, #333, transparent);
    z-index: 1;
}

.step-item {
    width: 50px;
    height: 50px;
    background: #050505;
    border: 1px solid #222;
    border-radius: 50%;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #444;
    font-weight: 800;
    transition: 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.step-item span {
    position: absolute;
    bottom: -30px;
    font-size: 0.65rem;
    letter-spacing: 2px;
    white-space: nowrap;
    color: #444;
}

.step-item.active {
    border-color: var(--luxury-gold);
    color: var(--luxury-gold);
    box-shadow: 0 0 20px var(--gold-dim);
}

.step-item.active span {
    color: var(--luxury-gold);
}

/* --- 2. SECTION TITLES --- */
.section-title {
    color: var(--luxury-gold);
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    text-align: center;
    margin-bottom: 50px;
    letter-spacing: 5px;
    text-transform: uppercase;
    font-size: 1.2rem;
    position: relative;
}

.section-title::after {
    content: '◈';
    display: block;
    font-size: 0.8rem;
    margin-top: 10px;
    opacity: 0.5;
}

/* --- 3. SELECTION CARDS (BARBER & SERVICE) --- */
.selection-input {
    display: none;
}

.selection-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid #222;
    border-radius: 0;
    padding: 25px 15px;
    cursor: pointer;
    transition: all 0.4s ease;
    height: 100%;
    position: relative;
}

.selection-card:hover {
    border-color: var(--luxury-gold);
    background: rgba(212, 175, 55, 0.05);
    transform: translateY(-10px);
}

.selection-input:checked+.selection-card {
    border-color: var(--luxury-gold);
    background: linear-gradient(to bottom, rgba(212, 175, 55, 0.12), transparent);
    box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.5);
}

/* Gambar Barber Efek Bundar Glowing */
.barber-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #222;
    margin-bottom: 15px;
    filter: grayscale(100%);
    transition: 0.5s;
}

.selection-input:checked+.selection-card .barber-img {
    filter: grayscale(0%);
    border-color: var(--luxury-gold);
    box-shadow: 0 0 20px var(--gold-dim);
}

/* --- 4. TIME SLOTS (LUXURY GRID) --- */
.time-slot-label {
    display: block;
    background: transparent;
    color: #666;
    padding: 15px 0;
    border: 1px solid #222;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

.time-slot-label:hover {
    border-color: var(--luxury-gold);
    color: #fff;
}

.selection-input:checked+.time-slot-label {
    background: var(--luxury-gold);
    color: #000;
    font-weight: 800;
    box-shadow: 0 0 15px var(--gold-dim);
}

/* --- 5. STICKY SUMMARY TICKET --- */
.booking-summary {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(5, 5, 5, 0.95);
    backdrop-filter: blur(20px);
    border-top: 1px solid var(--luxury-gold);
    padding: 25px 0;
    z-index: 1050;
    display: none;
    animation: ticketSlideUp 0.5s cubic-bezier(0.19, 1, 0.22, 1);
}

@keyframes ticketSlideUp {
    from {
        transform: translateY(100%);
    }

    to {
        transform: translateY(0);
    }
}

.ticket-divider {
    border-left: 1px dashed rgba(212, 175, 55, 0.3);
    margin: 0 30px;
    height: 50px;
}

/* --- 6. DATE INPUT CUSTOM --- */
.date-luxury {
    background: transparent;
    border: none;
    border-bottom: 2px solid #333;
    color: var(--luxury-gold);
    font-size: 2rem;
    font-weight: 800;
    text-align: center;
    font-family: 'Playfair Display', serif;
}

.date-luxury:focus {
    background: transparent;
    border-bottom-color: var(--luxury-gold);
    box-shadow: none;
    color: #fff;
}

/* --- 7. MODAL LUXURY STYLE --- */
.modal-content-luxury {
    background: #0f0f0f;
    border: 1px solid var(--luxury-gold);
    border-radius: 0;
    color: #fff;
}

.review-item {
    background: #161616;
    padding: 15px;
    margin-bottom: 10px;
    border-left: 2px solid var(--luxury-gold);
}
</style>
@endpush

@section('content')
<div class="container pb-5" style="margin-top: 120px; margin-bottom: 180px;">

    <div class="ritual-steps mx-auto mb-5 d-none d-lg-flex" style="max-width: 800px;">
        <div class="step-item active" id="dot1">1 <span>DATE</span></div>
        <div class="step-item" id="dot2">2 <span>ARTIST</span></div>
        <div class="step-item" id="dot3">3 <span>SERVICE</span></div>
        <div class="step-item" id="dot4">4 <span>TIME</span></div>
        <div class="step-item" id="dot5">5 <span>FINAL</span></div>
    </div>

    <div class="text-center mb-5" data-aos="zoom-in">
        <h5 class="text-gold letter-spacing-5 mb-2 fw-bold">THE ULTIMATE GROOMING</h5>
        <h2 class="display-3 fw-bold text-white font-serif">RESERVE RITUAL</h2>
    </div>

    @if(session('success'))
    <div class="alert alert-success bg-transparent border-success text-white text-center mb-5">
        <i class="bi bi-check2-all me-2"></i> {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('reservasi.store') }}" method="POST" id="bookingForm">
        @csrf

        <div class="mb-5 py-5" data-aos="fade-up">
            <h4 class="section-title">I. CHOOSE THE MOMENT</h4>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <input type="date" name="date" class="form-control date-luxury" min="{{ date('Y-m-d') }}" required
                        id="dateInput" onchange="updateRitual(1)">
                    <p class="text-center text-white-50 mt-3 small">Tentukan hari keberuntungan Anda</p>
                </div>
            </div>
        </div>

        <div class="mb-5 py-5 border-top border-secondary border-opacity-10" data-aos="fade-up">
            <h4 class="section-title">II. SELECT YOUR MASTER</h4>
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-3 col-lg-2">
                    <input type="radio" name="barber_id" id="barber_null" value="" class="selection-input" checked
                        onchange="updateSummary(); updateRitual(2)">
                    <label for="barber_null" class="selection-card text-center d-flex flex-column align-items-center">
                        <div class="barber-img d-flex align-items-center justify-content-center bg-dark">
                            <i class="bi bi-person-badge fs-1 opacity-25"></i>
                        </div>
                        <h6 class="text-white fw-bold mb-1 small uppercase">ANY MASTER</h6>
                        <small class="text-gold" style="font-size: 0.6rem;">Auto-Assign Artist</small>
                    </label>
                </div>

                @foreach($barbers as $barber)
                @php
                $imgSrc = $barber->photo_path ??
                'https://ui-avatars.com/api/?name='.urlencode($barber->name).'&background=111&color=D4AF37';
                $scheduleJson = json_encode($barber->schedule ?? []);
                $reviews = $barber->reviews->sortByDesc('created_at')->take(5)->values();
                $avgRating = $barber->reviews->avg('rating') ?? 0;
                @endphp
                <div class="col-6 col-md-3 col-lg-2">
                    <input type="radio" name="barber_id" id="barber_{{ $barber->id }}" value="{{ $barber->id }}"
                        class="selection-input" data-name="{{ $barber->name }}"
                        onchange="updateSummary(); updateRitual(2)">
                    <label for="barber_{{ $barber->id }}"
                        class="selection-card text-center d-flex flex-column align-items-center">
                        <img src="{{ $imgSrc }}" class="barber-img shadow-lg">
                        <h6 class="text-white fw-bold mb-1 small text-uppercase">{{ Str::limit($barber->name, 12) }}
                        </h6>
                        <div class="text-warning mb-2" style="font-size: 0.6rem;">
                            <i class="bi bi-star-fill"></i> {{ number_format($avgRating, 1) }}
                        </div>
                        <button type="button" class="btn btn-outline-warning btn-sm py-0 rounded-0"
                            style="font-size: 0.6rem;"
                            onclick="event.stopPropagation(); showBarberDetail('{{ $barber->name }}', '{{ $imgSrc }}', '{{ $barber->bio }}', {{ $scheduleJson }}, {{ json_encode($reviews) }}, '{{ number_format($avgRating,1) }}', {{ $barber->reviews->count() }})">
                            VIEW PROFILE
                        </button>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mb-5 py-5 border-top border-secondary border-opacity-10" data-aos="fade-up">
            <h4 class="section-title">III. CHOOSE THE TREATMENT</h4>
            <div class="row g-4">
                @foreach($services as $service)
                <div class="col-6 col-md-4 col-lg-3">
                    <input type="radio" name="service_id" id="service_{{ $service->id }}" value="{{ $service->id }}"
                        class="selection-input" data-name="{{ $service->name }}" data-price="{{ $service->price }}"
                        onchange="updateSummary(); updateRitual(3)" required>
                    <label for="service_{{ $service->id }}" class="selection-card p-0 overflow-hidden">
                        <img src="{{ $service->image_path ?? 'https://via.placeholder.com/400x300/111/D4AF37?text=MOOD+SERVICE' }}"
                            class="w-100" style="height: 180px; object-fit: cover; filter: brightness(0.6);">
                        <div class="p-3 text-center bg-black">
                            <h6 class="text-white fw-bold text-uppercase mb-2 small">{{ $service->name }}</h6>
                            <span class="text-gold fw-bold small">Rp
                                {{ number_format($service->price, 0, ',', '.') }}</span>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mb-5 py-5 border-top border-secondary border-opacity-10" data-aos="fade-up">
            <h4 class="section-title">IV. SET THE APPOINTMENT</h4>
            <div class="row g-2 justify-content-center">
                @php
                $times =
                ["10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30","18:00","18:30","19:00","19:30","20:00","20:30","21:00"];
                @endphp
                @foreach($times as $time)
                <div class="col-3 col-md-2 col-lg-1">
                    <input type="radio" name="time" id="time_{{ $time }}" value="{{ $time }}" class="selection-input"
                        onchange="updateSummary(); updateRitual(4)" required>
                    <label for="time_{{ $time }}" class="time-slot-label rounded-0">{{ $time }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="row justify-content-center py-5 border-top border-secondary border-opacity-10" data-aos="fade-up">
            <div class="col-md-6 text-center">
                <h4 class="section-title">V. FINAL DETAILS</h4>
                <div class="bg-dark p-4 border border-secondary border-opacity-25 shadow-lg">
                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                    <div class="mb-4 text-start">
                        <label class="text-gold small fw-bold mb-2 uppercase tracking-widest">Phone Number (WA)</label>
                        <input type="text" name="phone"
                            class="form-control bg-transparent border-secondary text-white rounded-0 py-3"
                            placeholder="Contoh: 08123xxx" required onkeyup="updateRitual(5)">
                    </div>
                    <div class="mb-0 text-start">
                        <label class="text-gold small fw-bold mb-2 uppercase tracking-widest">Special Notes</label>
                        <textarea name="notes" class="form-control bg-transparent border-secondary text-white rounded-0"
                            rows="3" placeholder="Preferensi khusus..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="booking-summary" id="summaryBar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="text-start">
                            <small class="text-gold fw-bold uppercase tracking-widest d-block mb-1">Total
                                Investment</small>
                            <h2 class="text-white fw-bold m-0 font-serif" id="totalPrice">Rp 0</h2>
                        </div>
                        <div class="ticket-divider d-none d-md-block"></div>
                        <div class="text-start d-none d-md-block">
                            <h6 class="text-white m-0 uppercase letter-spacing-1" id="summaryText">Selecting...</h6>
                            <small class="text-gold" id="summaryTime">Set your preferred schedule</small>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <button type="submit" class="btn btn-gold-luxury btn-lg px-5 py-3 rounded-0 fw-bold shadow-lg"
                            style="letter-spacing: 3px;">CONFIRM RESERVATION</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="barberDetailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-content-luxury">
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-5 bg-black p-5 text-center border-end border-secondary border-opacity-25">
                        <img src="" id="modalBarberImg" class="rounded-circle mb-4 shadow-lg"
                            style="width:180px; height:180px; object-fit:cover; border: 3px solid var(--luxury-gold);">
                        <h3 id="modalBarberName" class="font-serif text-white mb-2"></h3>
                        <div id="ratingBox" class="mb-4"></div>
                        <p id="modalBarberBio" class="text-white-50 fst-italic small"></p>
                    </div>
                    <div class="col-md-7 p-5 bg-dark">
                        <h6 class="text-gold uppercase letter-spacing-2 mb-4">Availability Schedule</h6>
                        <div id="scheduleContainer" class="row g-2 mb-5"></div>

                        <h6 class="text-gold uppercase letter-spacing-2 mb-4">Master Reviews</h6>
                        <div class="reviews-container" style="max-height:180px; overflow-y:auto; padding-right: 10px;">
                        </div>

                        <button class="btn btn-outline-secondary w-100 mt-5 rounded-0" data-bs-dismiss="modal">BACK TO
                            RITUAL</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Logic Ritual Steps Highlighting
function updateRitual(step) {
    for (let i = 1; i <= step + 1; i++) {
        const dot = document.getElementById('dot' + i);
        if (dot) dot.classList.add('active');
    }
}

// Logic Summary Bar & Ticket
function updateSummary() {
    const summaryBar = document.getElementById('summaryBar');
    const priceLabel = document.getElementById('totalPrice');
    const summaryText = document.getElementById('summaryText');
    const summaryTime = document.getElementById('summaryTime');

    const service = document.querySelector('input[name="service_id"]:checked');
    const barber = document.querySelector('input[name="barber_id"]:checked');
    const time = document.querySelector('input[name="time"]:checked');
    const date = document.getElementById('dateInput').value;

    if (service) {
        summaryBar.style.display = 'block';
        priceLabel.innerText = 'Rp ' + parseInt(service.dataset.price).toLocaleString('id-ID');
        summaryText.innerText = service.dataset.name;

        let detail = (barber && barber.value !== "") ? 'Master ' + barber.dataset.name : 'Master Artist Any';
        if (date && time) detail += ' • ' + date + ' • ' + time.value;
        summaryTime.innerText = detail;
    }
}

// Logic Modal Barber
function showBarberDetail(name, img, bio, schedule, reviews, avg, count) {
    document.getElementById('modalBarberName').innerText = name;
    document.getElementById('modalBarberImg').src = img;
    document.getElementById('modalBarberBio').innerText = bio || 'Master Barber at Jarsan';

    let stars = '';
    for (let i = 1; i <= 5; i++) stars +=
        `<i class="bi bi-star${i<=Math.round(avg)?'-fill':''} text-warning mx-1"></i>`;
    document.getElementById('ratingBox').innerHTML =
        `${stars}<br><small class="text-white-50 mt-2 d-block">${avg}/5.0 (${count} Verified Reviews)</small>`;

    const sc = document.getElementById('scheduleContainer');
    sc.innerHTML = '';
    ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'].forEach(d => {
        let t = schedule[d] || 'OFF';
        sc.innerHTML +=
            `<div class="col-6 small"><div class="p-2 border border-secondary border-opacity-25 d-flex justify-content-between"><span>${d}</span> <span class="${t=='OFF'?'text-danger':'text-gold fw-bold'}">${t}</span></div></div>`;
    });

    const rc = document.querySelector('.reviews-container');
    rc.innerHTML = reviews.length ? '' :
        '<div class="text-center text-white-50 py-4"><i class="bi bi-chat-dots fs-3 d-block mb-2"></i>No ritual reviews yet.</div>';
    reviews.forEach(r => {
        rc.innerHTML += `
            <div class="review-item">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-gold small fw-bold">${r.user.name}</span>
                    <span class="text-warning small"><i class="bi bi-star-fill"></i> ${r.rating}</span>
                </div>
                <p class="m-0 text-white-50 small" style="line-height:1.4;">"${r.comment || 'Memberikan rating tanpa ulasan tekstual.'}"</p>
            </div>`;
    });

    new bootstrap.Modal(document.getElementById('barberDetailModal')).show();
}
</script>
@endpush