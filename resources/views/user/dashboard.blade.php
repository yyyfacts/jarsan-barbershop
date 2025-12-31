@extends('layouts.app')

@section('title', 'Member Profile')

@push('styles')
<style>
/* --- FIX MODAL ERROR (Supaya tidak layar hitam/freeze) --- */
.modal-backdrop {
    display: none !important;
    z-index: -1 !important;
}

.modal {
    background-color: rgba(0, 0, 0, 0.85) !important;
}

.modal-dialog {
    z-index: 10000 !important;
    margin-top: 10vh;
}

/* --- TABLE LUXURY STYLE --- */
.table-luxury {
    background-color: transparent !important;
    color: #fff !important;
    /* Pastikan teks putih */
}

/* Header Tabel Gelap dengan Garis Emas */
.table-luxury thead th {
    background-color: #1a1a1a !important;
    /* Latar belakang gelap */
    color: var(--luxury-gold) !important;
    /* Teks Emas */
    border-bottom: 1px solid var(--luxury-gold) !important;
    font-weight: 600;
    letter-spacing: 1px;
    padding: 15px;
    text-transform: uppercase;
    font-size: 0.85rem;
}

/* Body Tabel Transparan */
.table-luxury tbody td {
    background-color: transparent !important;
    color: #e0e0e0 !important;
    /* Putih agak abu biar mata nyaman */
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding: 20px 15px;
    vertical-align: middle;
}

/* Hover Baris */
.table-luxury tbody tr:hover td {
    background-color: rgba(212, 175, 55, 0.05) !important;
    /* Efek hover emas tipis */
    color: #fff !important;
}

/* Stats Box Hover Effect */
.stats-box {
    transition: transform 0.3s;
}

.stats-box:hover {
    transform: translateY(-5px);
    border-color: var(--luxury-gold) !important;
}
</style>
@endpush

@section('content')
<div class="container py-5" style="margin-bottom: 100px;">

    {{-- ALERT FEEDBACK --}}
    @if(session('success'))
    <div class="alert alert-success border-0 bg-success bg-opacity-25 text-white mb-4">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger border-0 bg-danger bg-opacity-25 text-white mb-4">
        <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
    </div>
    @endif

    <div class="row g-4">

        {{-- BAGIAN KIRI: PROFIL CARD --}}
        <div class="col-lg-4" data-aos="fade-right">
            <div class="mb-4 position-relative d-inline-block">
                <img src="{{ Auth::user()->avatar_blob ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=D4AF37&color=000' }}"
                    class="rounded-circle shadow-lg"
                    style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--luxury-gold); padding: 3px;"
                    alt="Foto Profil">

                <span
                    class="position-absolute bottom-0 end-0 badge rounded-pill bg-success border border-dark px-3 py-2">
                    Active
                </span>
            </div>

            <h3 class="fw-bold text-white mb-1">{{ Auth::user()->name }}</h3>
            <p class="text-white-50 small mb-4">{{ Auth::user()->email }}</p>

            <hr style="border-color: var(--luxury-gold); opacity: 0.5;">

            <div class="row g-2 text-center mt-4">
                <div class="col-6">
                    <div class="p-3 border border-secondary stats-box bg-dark bg-opacity-25">
                        <h2 class="fw-bold text-gold m-0">
                            {{ Auth::user()->reservations()->where('status', 'done')->count() }}
                        </h2>
                        <small class="text-white letter-spacing-1" style="font-size: 0.7rem;">TOTAL CUKUR</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 border border-secondary stats-box bg-dark bg-opacity-25">
                        <h2 class="fw-bold text-gold m-0">ELITE</h2>
                        <small class="text-white letter-spacing-1" style="font-size: 0.7rem;">MEMBERSHIP</small>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('profile.edit') }}"
                    class="btn btn-outline-light w-100 rounded-0 py-2 fw-bold letter-spacing-1 hover-gold-border"
                    style="opacity: 0.8;">
                    <i class="bi bi-pencil-square me-2"></i> EDIT PROFILE
                </a>
            </div>

            <style>
            .hover-gold-border:hover {
                border-color: var(--luxury-gold) !important;
                color: var(--luxury-gold) !important;
                opacity: 1 !important;
            }
            </style>
        </div>


        {{-- BAGIAN KANAN: RIWAYAT CARD --}}
        <div class="col-lg-8" data-aos="fade-left">
            <div class="p-4 rounded-0 bg-matte h-100"
                style="border: 1px solid var(--luxury-gold); box-shadow: 0 0 20px rgba(0,0,0,0.5); background-color: #0f0f0f;">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold text-white m-0">
                        <i class="bi bi-clock-history me-2 text-gold"></i>RIWAYAT LAYANAN
                    </h4>
                    <span class="badge border border-warning text-gold bg-transparent">History</span>
                </div>

                <div class="table-responsive">
                    {{-- HAPUS class 'table-hover', Ganti dengan class custom 'table-luxury' --}}
                    <table class="table table-luxury align-middle mb-0">
                        <thead>
                            <tr>
                                <th>TANGGAL</th>
                                <th>LAYANAN</th>
                                <th>HARGA</th>
                                <th class="text-end">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Auth::user()->reservations()->with('barber')->latest()->get() as $res)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2 text-white">
                                        <i class="bi bi-calendar-event text-white-50"></i>
                                        {{ \Carbon\Carbon::parse($res->date)->translatedFormat('d M Y') }}
                                    </div>
                                    <div class="small text-gold ps-4">
                                        {{ \Carbon\Carbon::parse($res->time)->format('H:i') }} WIB
                                    </div>
                                </td>

                                <td>
                                    <span
                                        class="fw-bold text-white d-block">{{ $res->service->name ?? 'Layanan' }}</span>
                                    <small class="text-white-50" style="font-size: 0.8rem;">
                                        <i class="bi bi-person me-1"></i> {{ $res->barber->name ?? 'Any Barber' }}
                                    </small>
                                </td>

                                <td class="text-gold fw-bold">
                                    Rp {{ number_format($res->service->price ?? 0, 0, ',', '.') }}
                                </td>

                                <td class="text-end">
                                    @php
                                    $status = strtolower($res->status);
                                    $hasReview = \App\Models\Review::where('reservation_id', $res->id)->exists();
                                    @endphp

                                    @if($status == 'done' || $status == 'selesai')
                                    <span class="badge bg-success bg-opacity-75 text-white px-3 py-2 rounded-1 mb-2">
                                        <i class="bi bi-check-circle-fill me-1"></i> SELESAI
                                    </span>

                                    @if(!$hasReview && $res->barber_id)
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-outline-warning text-gold border-warning"
                                            data-bs-toggle="modal" data-bs-target="#reviewModal{{ $res->id }}"
                                            style="font-size: 0.7rem; padding: 4px 10px;">
                                            <i class="bi bi-star-fill me-1"></i> Beri Ulasan
                                        </button>
                                    </div>

                                    {{-- MODAL REVIEW --}}
                                    <div class="modal fade" id="reviewModal{{ $res->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content"
                                                style="background: #1a1a1a; border: 1px solid var(--luxury-gold);">
                                                <div class="modal-header border-bottom border-secondary">
                                                    <h5 class="modal-title text-gold fw-bold">Ulas Pelayanan</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('review.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="reservation_id" value="{{ $res->id }}">
                                                    <div class="modal-body text-start">
                                                        <p class="text-white small mb-3">Bagaimana hasil cukuran dengan
                                                            <strong
                                                                class="text-gold">{{ $res->barber->name ?? 'Barber' }}</strong>?
                                                        </p>
                                                        <div class="mb-3">
                                                            <label class="text-white small fw-bold mb-2">Rating</label>
                                                            <select name="rating"
                                                                class="form-select bg-dark text-white border-secondary"
                                                                required>
                                                                <option value="5">⭐⭐⭐⭐⭐ (Sempurna)</option>
                                                                <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                                                                <option value="3">⭐⭐⭐ (Cukup)</option>
                                                                <option value="2">⭐⭐ (Kurang)</option>
                                                                <option value="1">⭐ (Buruk)</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="text-white small fw-bold mb-2">Komentar</label>
                                                            <textarea name="comment"
                                                                class="form-control bg-dark text-white border-secondary"
                                                                rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-top border-secondary">
                                                        <button type="submit" class="btn btn-gold-luxury w-100">Kirim
                                                            Ulasan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif($hasReview)
                                    <div class="mt-1">
                                        <small class="text-gold fst-italic" style="font-size: 0.65rem;">
                                            <i class="bi bi-star-fill text-warning"></i> Ulasan Terkirim
                                        </small>
                                    </div>
                                    @endif

                                    @elseif($status == 'approved' || $status == 'dikonfirmasi')
                                    <span class="badge bg-info bg-opacity-75 text-white px-3 py-2 rounded-1">
                                        <i class="bi bi-calendar-check me-1"></i> DIKONFIRMASI
                                    </span>
                                    <div class="mt-1">
                                        <small class="text-white-50" style="font-size: 0.65rem;">Datang sesuai
                                            jadwal.</small>
                                    </div>

                                    @elseif($status == 'pending' || $status == 'menunggu')
                                    <span class="badge bg-warning bg-opacity-75 text-black px-3 py-2 rounded-1">
                                        <i class="bi bi-hourglass-split me-1"></i> MENUNGGU
                                    </span>
                                    @elseif($status == 'canceled' || $status == 'batal')
                                    <span class="badge bg-danger bg-opacity-75 text-white px-3 py-2 rounded-1">
                                        <i class="bi bi-x-circle me-1"></i> BATAL
                                    </span>
                                    @else
                                    <span class="badge bg-secondary text-white px-3 py-2 rounded-1">
                                        {{ strtoupper($res->status) }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <i class="bi bi-scissors display-4 text-white-50 mb-3"
                                            style="opacity: 0.3;"></i>
                                        <p class="text-white mb-0 fs-5">Belum Ada Riwayat</p>
                                        <a href="{{ route('reservasi') }}" class="btn btn-sm btn-gold-luxury mt-3 px-4">
                                            BOOK NOW
                                        </a>
                                    </div>
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