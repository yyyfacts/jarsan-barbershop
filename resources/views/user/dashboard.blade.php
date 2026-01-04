@extends('layouts.app')

@section('title', 'Profil Member')

@push('styles')
<style>
/* --- PERBAIKAN MODAL --- */
.modal-backdrop {
    display: none !important;
    z-index: -1 !important;
}

.modal {
    background-color: rgba(0, 0, 0, 0.8) !important;
    backdrop-filter: blur(4px);
}

.modal-dialog {
    z-index: 10000 !important;
    margin-top: 10vh;
}

/* --- KARTU PROFIL --- */
.kartu-member {
    background-color: #111;
    border: 1px solid #222;
    padding: 40px 20px;
    text-align: center;
}

.foto-profil {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 2px solid #D4AF37;
    padding: 4px;
    margin-bottom: 20px;
}

/* --- STATISTIK --- */
.kotak-info {
    background: #1a1a1a;
    border: 1px solid #333;
    padding: 15px;
    margin-bottom: 10px;
}

.angka-info {
    color: #D4AF37;
    font-size: 1.5rem;
    font-weight: bold;
    display: block;
}

.label-info {
    color: #888;
    font-size: 0.7rem;
    letter-spacing: 1px;
    text-transform: uppercase;
}

/* --- TABEL RIWAYAT --- */
.tabel-riwayat {
    background-color: transparent !important;
}

.tabel-riwayat thead th {
    background-color: #1a1a1a !important;
    color: #D4AF37 !important;
    border-bottom: 2px solid #D4AF37 !important;
    padding: 15px;
    font-size: 0.8rem;
    letter-spacing: 1px;
}

.tabel-riwayat tbody td {
    color: #ccc !important;
    padding: 20px 15px;
    border-bottom: 1px solid #222 !important;
    vertical-align: middle;
}

.tabel-riwayat tbody tr:hover td {
    background-color: #161616 !important;
}

.label-status {
    padding: 5px 12px;
    font-size: 0.7rem;
    font-weight: bold;
    border-radius: 2px;
    display: inline-block;
}

.btn-utama {
    background-color: #D4AF37;
    color: #000;
    border: none;
    padding: 12px;
    font-weight: bold;
    border-radius: 0;
    width: 100%;
    text-decoration: none;
    display: inline-block;
}

.btn-utama:hover {
    background-color: #b8962d;
    color: #000;
}
</style>
@endpush

@section('content')
<div class="container py-5" style="margin-top: 80px;">

    @if(session('success'))
    <div class="alert alert-success bg-dark border-success text-white rounded-0 mb-4">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="kartu-member shadow-sm">
                <img src="{{ Auth::user()->avatar_blob ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=D4AF37&color=000' }}"
                    class="rounded-circle foto-profil">

                <h4 class="text-white fw-bold mb-1">{{ Auth::user()->name }}</h4>
                <p class="text-muted small mb-4">{{ Auth::user()->email }}</p>

                <div class="row g-2 mb-4 text-center">
                    <div class="col-6">
                        <div class="kotak-info">
                            <span
                                class="angka-info">{{ Auth::user()->reservations()->where('status', 'done')->count() }}</span>
                            <span class="label-info">Kunjungan</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="kotak-info">
                            <span class="angka-info">Elite</span>
                            <span class="label-info">Status</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" class="btn-utama">
                    PENGATURAN AKUN
                </a>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="p-4" style="background-color: #111; border: 1px solid #222;">
                <h5 class="text-white fw-bold mb-4">RIWAYAT LAYANAN</h5>

                <div class="table-responsive">
                    <table class="table tabel-riwayat">
                        <thead>
                            <tr>
                                <th>WAKTU</th>
                                <th>LAYANAN</th>
                                <th>BIAYA</th>
                                <th class="text-end">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Auth::user()->reservations()->with('barber', 'service')->latest()->get() as $res)
                            <tr>
                                <td>
                                    <span
                                        class="text-white d-block">{{ \Carbon\Carbon::parse($res->date)->translatedFormat('d F Y') }}</span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($res->time)->format('H:i') }}
                                        WIB</small>
                                </td>
                                <td>
                                    <span class="text-white d-block">{{ $res->service->name ?? 'Layanan' }}</span>
                                    <small class="text-muted">Barber: {{ $res->barber->name ?? 'Umum' }}</small>
                                </td>
                                <td style="color: #D4AF37;">
                                    Rp {{ number_format($res->service->price ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="text-end">
                                    @php
                                    $status = strtolower($res->status);
                                    $hasReview = \App\Models\Review::where('reservation_id', $res->id)->exists();
                                    $warnaStatus = match($status) {
                                    'done','selesai' => 'bg-success',
                                    'approved','dikonfirmasi' => 'bg-primary',
                                    'pending','menunggu' => 'bg-warning text-dark',
                                    default => 'bg-danger'
                                    };
                                    @endphp

                                    <span class="label-status {{ $warnaStatus }}">
                                        {{ strtoupper($status) }}
                                    </span>

                                    @if(($status == 'done' || $status == 'selesai') && !$hasReview)
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-outline-light rounded-0" data-bs-toggle="modal"
                                            data-bs-target="#reviewModal{{ $res->id }}" style="font-size: 0.65rem;">
                                            BERI ULASAN
                                        </button>
                                    </div>

                                    <div class="modal fade" id="reviewModal{{ $res->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 rounded-0" style="background: #1a1a1a;">
                                                <div class="modal-header border-bottom border-secondary">
                                                    <h6 class="modal-title text-white">Berikan Ulasan Layanan</h6>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('review.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="reservation_id" value="{{ $res->id }}">
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="text-muted small mb-2">Penilaian</label>
                                                            <select name="rating"
                                                                class="form-select bg-black text-white border-secondary rounded-0"
                                                                required>
                                                                <option value="5">Sangat Puas</option>
                                                                <option value="4">Puas</option>
                                                                <option value="3">Cukup</option>
                                                                <option value="2">Kurang</option>
                                                                <option value="1">Kecewa</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="text-muted small mb-2">Komentar</label>
                                                            <textarea name="comment"
                                                                class="form-control bg-black text-white border-secondary rounded-0"
                                                                rows="3"
                                                                placeholder="Tuliskan pengalaman Anda..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="p-3 pt-0">
                                                        <button type="submit" class="btn-utama">KIRIM ULASAN</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted small">
                                    BELUM ADA RIWAYAT TRANSAKSI
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