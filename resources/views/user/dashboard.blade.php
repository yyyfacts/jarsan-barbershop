@extends('layouts.app')

@section('title', 'Profil Member')

@push('styles')
<style>
:root {
    --luxury-gold: #D4AF37;
    --matte-black: #0f0f0f;
}

/* --- PERBAIKAN MODAL (Mencegah tampilan layar beku) --- */
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

/* --- DESAIN KARTU MEMBER --- */
.elite-card {
    background: linear-gradient(145deg, #161616, #000);
    border: 1px solid rgba(212, 175, 55, 0.2);
    padding: 40px 25px;
    position: relative;
    overflow: hidden;
}

.elite-card::after {
    content: "MEMBER";
    position: absolute;
    top: -10px;
    right: -10px;
    font-size: 5rem;
    font-weight: 900;
    color: rgba(212, 175, 55, 0.03);
    z-index: 0;
}

/* --- KOTAK STATISTIK --- */
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

/* --- TABEL RIWAYAT --- */
.table-luxury {
    --bs-table-bg: transparent;
    --bs-table-color: #fff;
}

.table-luxury thead th {
    font-family: 'Montserrat', sans-serif;
    color: var(--luxury-gold) !important;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-bottom: 2px solid var(--luxury-gold) !important;
    padding: 20px 15px;
    font-size: 0.85rem;
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
    border-radius: 2px;
}
</style>
@endpush

@section('content')
<div class="container py-5" style="margin-top: 100px; margin-bottom: 120px;">

    {{-- NOTIFIKASI FEEDBACK --}}
    @if(session('success'))
    <div class="alert alert-success border-0 bg-dark text-gold mb-5 rounded-0 border-start border-gold border-3 shadow">
        <i class="bi bi-patch-check-fill me-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="row g-5">
        {{-- BAGIAN KIRI: KARTU PROFIL --}}
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

                    <h2 class="fw-bold text-white mb-1">{{ Auth::user()->name }}</h2>
                    <span class="text-gold small letter-spacing-3 text-uppercase opacity-75">Pelanggan Setia</span>

                    <div class="mt-4 mb-4 d-flex justify-content-center gap-2">
                        <div class="flex-fill stats-box p-3">
                            <h3 class="m-0 text-white fw-bold">
                                {{ Auth::user()->reservations()->where('status', 'done')->count() }}</h3>
                            <small class="text-gold opacity-75 small text-uppercase">Total Cukur</small>
                        </div>
                        <div class="flex-fill stats-box p-3">
                            <h3 class="m-0 text-white fw-bold">Aktif</h3>
                            <small class="text-gold opacity-75 small text-uppercase">Status Akun</small>
                        </div>
                    </div>

                    <p class="text-white-50 small mb-4 fst-italic">"Kerapian adalah bentuk penghormatan terhadap diri
                        sendiri."</p>

                    <a href="{{ route('profile.edit') }}"
                        class="btn btn-gold-luxury w-100 py-3 fw-bold letter-spacing-2">
                        PENGATURAN AKUN
                    </a>
                </div>
            </div>
        </div>

        {{-- BAGIAN KANAN: RIWAYAT KUNJUNGAN --}}
        <div class="col-lg-8" data-aos="fade-left">
            <div class="p-5" style="background: #111; border: 1px solid #222;">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <div>
                        <h6 class="text-gold letter-spacing-3 mb-2">RIWAYAT</h6>
                        <h3 class="text-white fw-bold m-0">DAFTAR KUNJUNGAN</h3>
                    </div>
                    <i class="bi bi-clock-history text-gold fs-2"></i>
                </div>

                <div class="table-responsive">
                    <table class="table table-luxury align-middle">
                        <thead>
                            <tr>
                                <th>Jadwal</th>
                                <th>Layanan</th>
                                <th>Biaya</th>
                                <th class="text-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Auth::user()->reservations()->with('barber')->latest()->get() as $res)
                            <tr>
                                <td>
                                    <div class="text-white fw-bold">
                                        {{ \Carbon\Carbon::parse($res->date)->translatedFormat('d M Y') }}</div>
                                    <small
                                        class="text-gold opacity-75">{{ \Carbon\Carbon::parse($res->time)->format('H:i') }}
                                        WIB</small>
                                </td>
                                <td>
                                    <div class="text-white">{{ $res->service->name ?? 'Potong Rambut' }}</div>
                                    <small class="text-white-50">dengan {{ $res->barber->name ?? 'Barber' }}</small>
                                </td>
                                <td class="text-gold">Rp {{ number_format($res->service->price ?? 0, 0, ',', '.') }}
                                </td>
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
                                            BERI ULASAN
                                        </button>
                                    </div>

                                    {{-- MODAL ULASAN --}}
                                    <div class="modal fade" id="reviewModal{{ $res->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 rounded-0"
                                                style="background: #1a1a1a; border: 1px solid var(--luxury-gold) !important;">
                                                <div class="modal-header border-secondary p-4">
                                                    <h5 class="modal-title text-gold">Ulasan Layanan</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('review.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="reservation_id" value="{{ $res->id }}">
                                                    <div class="modal-body p-4 text-start">
                                                        <p class="text-white-50 mb-3">Bagaimana pengalaman Anda dengan
                                                            Barber <span
                                                                class="text-gold">{{ $res->barber->name }}</span>?</p>
                                                        <div class="mb-3">
                                                            <label
                                                                class="text-gold small fw-bold mb-2 d-block">Penilaian
                                                                (Bintang)</label>
                                                            <select name="rating"
                                                                class="form-select bg-black text-white border-secondary rounded-0 py-2"
                                                                required>
                                                                <option value="5">Sangat Puas (5 Bintang)</option>
                                                                <option value="4">Puas (4 Bintang)</option>
                                                                <option value="3">Cukup (3 Bintang)</option>
                                                                <option value="2">Kurang (2 Bintang)</option>
                                                                <option value="1">Sangat Kurang (1 Bintang)</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label
                                                                class="text-gold small fw-bold mb-2 d-block">Komentar</label>
                                                            <textarea name="comment"
                                                                class="form-control bg-black text-white border-secondary rounded-0"
                                                                rows="3"
                                                                placeholder="Tulis masukan Anda di sini..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="p-4 pt-0">
                                                        <button type="submit"
                                                            class="btn btn-gold-luxury w-100 py-2 fw-bold">KIRIM
                                                            ULASAN</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif($hasReview)
                                    <div class="mt-2">
                                        <i class="bi bi-star-fill text-warning small"></i>
                                        <small class="text-white-50 fst-italic ms-1" style="font-size: 0.7rem;">Ulasan
                                            telah dikirim</small>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="opacity-25 mb-3"><i class="bi bi-calendar-x display-4"></i></div>
                                    <p class="text-white-50 small">BELUM ADA RIWAYAT KUNJUNGAN</p>
                                    <a href="{{ route('reservasi') }}"
                                        class="btn btn-sm btn-outline-warning mt-3 rounded-0 px-4">PESAN JADWAL</a>
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