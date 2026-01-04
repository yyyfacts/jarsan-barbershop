@extends('layouts.app')

@section('title', 'Member Profile')

@push('styles')
<style>
:root {
    --luxury-gold: #D4AF37;
    --matte-black: #0f0f0f;
}

/* --- FIX MODAL ERROR --- */
.modal-backdrop {
    display: none !important;
    z-index: -1 !important;
}

.modal {
    background-color: rgba(0, 0, 0, 0.9) !important;
    backdrop-filter: blur(5px);
}

.modal-dialog {
    z-index: 10000 !important;
    margin-top: 10vh;
}

/* --- ELITE CARD DESIGN --- */
.elite-card {
    background: linear-gradient(145deg, #161616, #000);
    border: 1px solid rgba(212, 175, 55, 0.2);
    padding: 40px 25px;
    position: relative;
    overflow: hidden;
}

.elite-card::after {
    content: "VIP";
    position: absolute;
    top: -10px;
    right: -10px;
    font-size: 6rem;
    font-weight: 900;
    color: rgba(212, 175, 55, 0.03);
    z-index: 0;
}

/* --- STATS GLOW --- */
.stats-box {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.stats-box:hover {
    transform: scale(1.05);
    border-color: var(--luxury-gold);
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.15);
}

/* --- TABLE RE-BORN --- */
.table-luxury {
    --bs-table-bg: transparent;
    --bs-table-color: #fff;
}

.table-luxury thead th {
    font-family: 'Playfair Display', serif;
    color: var(--luxury-gold) !important;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-bottom: 2px solid var(--luxury-gold) !important;
    padding: 20px 15px;
}

.table-luxury tbody td {
    padding: 25px 15px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
    font-size: 0.9rem;
}

.table-luxury tbody tr:hover td {
    background: rgba(212, 175, 55, 0.03) !important;
}

.status-badge {
    padding: 6px 15px;
    font-size: 0.7rem;
    letter-spacing: 1px;
    font-weight: 700;
    border-radius: 0;
}
</style>
@endpush

@section('content')
<div class="container py-5" style="margin-top: 100px; margin-bottom: 120px;">

    {{-- FEEDBACK --}}
    @if(session('success'))
    <div class="alert alert-success border-0 bg-dark text-gold mb-5 rounded-0 border-start border-gold border-3 shadow">
        <i class="bi bi-patch-check-fill me-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="row g-5">
        {{-- BAGIAN KIRI: ELITE CARD --}}
        <div class="col-lg-4" data-aos="fade-right">
            <div class="elite-card shadow-lg rounded-3">
                <div class="text-center position-relative z-index-1">
                    <div class="mb-4 position-relative d-inline-block">
                        <img src="{{ Auth::user()->avatar_blob ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=D4AF37&color=000' }}"
                            class="rounded-circle"
                            style="width: 130px; height: 130px; object-fit: cover; border: 2px solid var(--luxury-gold); padding: 5px;">
                        <div class="position-absolute bottom-0 end-0 bg-success border border-dark rounded-circle"
                            style="width: 20px; height: 20px;"></div>
                    </div>

                    <h2 class="fw-bold text-white mb-1 font-serif">{{ Auth::user()->name }}</h2>
                    <span class="text-gold small letter-spacing-3 text-uppercase opacity-75">Elite Member</span>

                    <div class="mt-4 mb-4 d-flex justify-content-center gap-2">
                        <div class="flex-fill stats-box p-3">
                            <h3 class="m-0 text-white fw-bold">
                                {{ Auth::user()->reservations()->where('status', 'done')->count() }}</h3>
                            <small class="text-gold-dim small uppercase">Visits</small>
                        </div>
                        <div class="flex-fill stats-box p-3">
                            <h3 class="m-0 text-white fw-bold">Level</h3>
                            <small class="text-gold-dim small uppercase">Gold</small>
                        </div>
                    </div>

                    <p class="text-white-50 small mb-4 italic">"Style is a reflection of your attitude and your
                        personality."</p>

                    <a href="{{ route('profile.edit') }}"
                        class="btn btn-gold-luxury w-100 py-3 fw-bold letter-spacing-2">
                        MANAGE ACCOUNT
                    </a>
                </div>
            </div>
        </div>

        {{-- BAGIAN KANAN: HISTORY --}}
        <div class="col-lg-8" data-aos="fade-left">
            <div class="p-5" style="background: #111; border: 1px solid #222;">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <div>
                        <h6 class="text-gold letter-spacing-3 mb-2">CHRONICLES</h6>
                        <h3 class="text-white fw-bold m-0 font-serif">SERVICE HISTORY</h3>
                    </div>
                    <i class="bi bi-stars text-gold fs-2"></i>
                </div>

                <div class="table-responsive">
                    <table class="table table-luxury align-middle">
                        <thead>
                            <tr>
                                <th>Schedule</th>
                                <th>Ritual</th>
                                <th>Investment</th>
                                <th class="text-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Auth::user()->reservations()->with('barber')->latest()->get() as $res)
                            <tr>
                                <td>
                                    <div class="text-white fw-bold">
                                        {{ \Carbon\Carbon::parse($res->date)->format('d.M.Y') }}</div>
                                    <small
                                        class="text-gold opacity-75">{{ \Carbon\Carbon::parse($res->time)->format('H:i') }}
                                        WIB</small>
                                </td>
                                <td>
                                    <div class="text-white">{{ $res->service->name ?? 'Premium Cut' }}</div>
                                    <small class="text-white-50">with
                                        {{ $res->barber->name ?? 'Master Artist' }}</small>
                                </td>
                                <td class="text-gold font-serif">Rp
                                    {{ number_format($res->service->price ?? 0, 0, ',', '.') }}</td>
                                <td class="text-end">
                                    @php
                                    $status = strtolower($res->status);
                                    $hasReview = \App\Models\Review::where('reservation_id', $res->id)->exists();
                                    $badgeClass = match($status) {
                                    'done','selesai' => 'bg-success text-white',
                                    'approved','dikonfirmasi' => 'bg-info text-white',
                                    'pending','menunggu' => 'bg-warning text-black',
                                    default => 'bg-danger text-white'
                                    };
                                    @endphp

                                    <span class="status-badge {{ $badgeClass }}">{{ strtoupper($status) }}</span>

                                    @if(($status == 'done' || $status == 'selesai') && !$hasReview && $res->barber_id)
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-outline-warning text-gold py-1 px-3 rounded-0"
                                            data-bs-toggle="modal" data-bs-target="#reviewModal{{ $res->id }}"
                                            style="font-size: 0.65rem;">
                                            LEAVE A REVIEW
                                        </button>
                                    </div>

                                    {{-- MODAL REVIEW LUXURY --}}
                                    <div class="modal fade" id="reviewModal{{ $res->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content modal-content-luxury">
                                                <div class="modal-header border-secondary p-4">
                                                    <h5 class="modal-title font-serif text-gold">Rate Your Ritual</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('review.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="reservation_id" value="{{ $res->id }}">
                                                    <div class="modal-body p-4">
                                                        <p class="text-white-50 mb-4">How was your experience with
                                                            Master <span
                                                                class="text-gold">{{ $res->barber->name }}</span>?</p>
                                                        <div class="mb-4">
                                                            <label
                                                                class="text-gold small uppercase letter-spacing-2 mb-2 d-block">Rating</label>
                                                            <select name="rating"
                                                                class="form-select bg-black text-white border-secondary rounded-0 py-3"
                                                                required>
                                                                <option value="5">★★★★★ Excellent</option>
                                                                <option value="4">★★★★ Very Good</option>
                                                                <option value="3">★★★ Average</option>
                                                                <option value="2">★★ Poor</option>
                                                                <option value="1">★ Disappointing</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label
                                                                class="text-gold small uppercase letter-spacing-2 mb-2 d-block">Comment</label>
                                                            <textarea name="comment"
                                                                class="form-control bg-black text-white border-secondary rounded-0"
                                                                rows="4"
                                                                placeholder="Share your experience..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="p-4 pt-0">
                                                        <button type="submit"
                                                            class="btn btn-gold-luxury w-100 py-3 fw-bold">SUBMIT
                                                            REVIEW</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif($hasReview)
                                    <div class="mt-2">
                                        <i class="bi bi-star-fill text-warning small"></i>
                                        <small class="text-white-50 fst-italic ms-1" style="font-size: 0.7rem;">Review
                                            Submitted</small>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="opacity-25 mb-3"><i class="bi bi-journal-x display-4"></i></div>
                                    <p class="text-white-50 letter-spacing-2 small">NO RITUAL HISTORY FOUND</p>
                                    <a href="{{ route('reservasi') }}"
                                        class="btn btn-sm btn-outline-warning mt-3 rounded-0 px-4">START RITUAL</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection