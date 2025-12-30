@extends('layouts.app')

@section('title', 'Member Profile')

@push('styles')
<style>
/* Table Styling Override for Dark Theme */
.table-luxury {
    background-color: transparent !important;
    color: white !important;
}

.table-luxury th {
    background-color: transparent !important;
    color: var(--luxury-gold) !important;
    border-bottom: 1px solid var(--luxury-gold) !important;
    font-weight: 600;
    letter-spacing: 1px;
    padding-bottom: 15px;
}

.table-luxury td {
    background-color: transparent !important;
    color: white !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding-top: 15px;
    padding-bottom: 15px;
}

.table-luxury tr:hover td {
    background-color: rgba(212, 175, 55, 0.05) !important;
    /* Efek hover emas tipis */
    color: white !important;
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
    <div class="row g-4">

        {{-- BAGIAN KIRI: PROFIL CARD --}}
        <div class="col-lg-4" data-aos="fade-right">
            <div class="p-4 rounded-0 bg-matte text-center h-100"
                style="border: 1px solid var(--gold-accent); box-shadow: 0 0 20px rgba(0,0,0,0.5);">

                <div class="mb-4 position-relative d-inline-block">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 100px; height: 100px; border: 2px solid var(--luxury-gold);">
                        <i class="bi bi-person-fill display-4 text-white"></i>
                    </div>
                    <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-success border border-dark">
                        Active
                    </span>
                </div>

                <h3 class="fw-bold text-white mb-1">{{ Auth::user()->name }}</h3>
                <p class="text-white-50 small mb-4">{{ Auth::user()->email }}</p>

                <hr style="border-color: var(--gold-accent); opacity: 0.5;">

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

                <form action="{{ route('logout') }}" method="POST" class="mt-5">
                    @csrf
                    <button class="btn btn-outline-danger w-100 rounded-0 py-2 fw-bold letter-spacing-1 hover-shadow">
                        <i class="bi bi-box-arrow-right me-2"></i> LOGOUT SYSTEM
                    </button>
                </form>
            </div>
        </div>

        {{-- BAGIAN KANAN: RIWAYAT CARD --}}
        <div class="col-lg-8" data-aos="fade-left">
            <div class="p-4 rounded-0 bg-matte h-100"
                style="border: 1px solid var(--gold-accent); box-shadow: 0 0 20px rgba(0,0,0,0.5);">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold text-white m-0">
                        <i class="bi bi-clock-history me-2 text-gold"></i>RIWAYAT LAYANAN
                    </h4>
                    <span class="badge border border-warning text-gold bg-transparent">History</span>
                </div>

                <div class="table-responsive">
                    <table class="table table-luxury align-middle">
                        <thead>
                            <tr>
                                <th>TANGGAL</th>
                                <th>LAYANAN</th>
                                <th>HARGA</th>
                                <th class="text-end">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Auth::user()->reservations()->latest()->get() as $res)
                            <tr>
                                <td class="text-white small">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-calendar-event text-white-50"></i>
                                        {{ \Carbon\Carbon::parse($res->date)->translatedFormat('d F Y') }}
                                    </div>
                                    <div class="small text-gold ps-4">
                                        {{ \Carbon\Carbon::parse($res->time)->format('H:i') }} WIB
                                    </div>
                                </td>

                                <td>
                                    <span
                                        class="fw-bold text-white d-block">{{ $res->service->name ?? 'Layanan' }}</span>
                                    <small class="text-white-50">{{ $res->barber->name ?? 'Any Barber' }}</small>
                                </td>

                                <td class="text-gold fw-bold">
                                    Rp {{ number_format($res->service->price ?? 0, 0, ',', '.') }}
                                </td>

                                <td class="text-end">
                                    @php
                                    $status = strtolower($res->status);
                                    @endphp

                                    @if($status == 'done' || $status == 'selesai')
                                    <span class="badge bg-success bg-opacity-75 text-white px-3 py-2 rounded-1">
                                        <i class="bi bi-check-circle-fill me-1"></i> SELESAI
                                    </span>
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
                                        <p class="text-white-50 small">Anda belum melakukan reservasi cukur rambut.</p>
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