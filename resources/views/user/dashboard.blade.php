@extends('layouts.app')

@section('title', 'Member Profile')

@section('content')
<div class="container py-5" style="margin-bottom: 100px;">
    <div class="row g-4">
        <div class="col-lg-4" data-aos="fade-right">
            <div class="p-4 border border-warning rounded-0 bg-matte text-center">
                <div class="mb-4">
                    <i class="bi bi-person-circle display-1 text-gold"></i>
                </div>
                <h3 class="fw-bold text-white">{{ Auth::user()->name }}</h3>
                <p class="text-gold small mb-4">{{ Auth::user()->email }}</p>

                <hr class="border-secondary">

                <div class="row g-2 text-center mt-3">
                    <div class="col-6">
                        <div class="p-3 border border-secondary">
                            <h2 class="fw-bold text-white m-0">
                                {{ Auth::user()->reservations()->where('status', 'done')->count() }}</h2>
                            <small class="text-gold">TOTAL CUKUR</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 border border-secondary">
                            <h2 class="fw-bold text-white m-0">ELITE</h2>
                            <small class="text-gold">RANK</small>
                        </div>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button class="btn btn-outline-danger w-100 rounded-0">LOGOUT SYSTEM</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8" data-aos="fade-left">
            <div class="p-4 border border-secondary rounded-0 bg-matte">
                <h4 class="fw-bold text-white mb-4"><i class="bi bi-clock-history me-2 text-gold"></i>RIWAYAT LAYANAN
                </h4>

                <div class="table-responsive">
                    <table class="table table-dark table-hover border-secondary align-middle">
                        <thead>
                            <tr class="text-gold border-bottom border-warning">
                                <th>TANGGAL</th>
                                <th>LAYANAN</th>
                                <th>HARGA</th>
                                <th class="text-end">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Auth::user()->reservations()->latest()->get() as $res)
                            <tr class="border-bottom border-secondary">
                                <td class="py-3 text-white small">
                                    {{ \Carbon\Carbon::parse($res->date)->format('d M Y') }}</td>
                                <td class="fw-bold text-white">{{ $res->service->name ?? 'Layanan' }}</td>
                                <td class="text-white">Rp {{ number_format($res->service->price ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="text-end">
                                    @if(strtolower($res->status) == 'done' || strtolower($res->status) == 'selesai')
                                    <span class="badge bg-success px-3">COMPLETED</span>
                                    @else
                                    <span class="badge bg-warning text-dark px-3">{{ strtoupper($res->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">Belum ada riwayat pengerjaan.</td>
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