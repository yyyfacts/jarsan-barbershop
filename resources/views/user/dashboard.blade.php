@extends('layouts.app')
@section('title', 'Member Profile')
@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-4" data-aos="fade-right">
            <div class="p-4 border border-warning bg-dark text-center">
                <i class="bi bi-person-circle display-1 text-gold mb-3"></i>
                <h3 class="fw-bold text-white">{{ Auth::user()->name }}</h3>
                <p class="text-gold small mb-4">{{ Auth::user()->email }}</p>
                <div class="row g-2">
                    <div class="col-6 border border-secondary p-3">
                        <h2 class="text-white m-0">{{ Auth::user()->reservations()->where('status', 'done')->count() }}
                        </h2>
                        <small class="text-gold">TOTAL CUKUR</small>
                    </div>
                    <div class="col-6 border border-secondary p-3">
                        <h2 class="text-white m-0">ELITE</h2>
                        <small class="text-gold">RANK</small>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button class="btn btn-outline-danger w-100 rounded-0">LOGOUT SYSTEM</button>
                </form>
            </div>
        </div>
        <div class="col-lg-8" data-aos="fade-left">
            <div class="p-4 border border-secondary bg-dark">
                <h4 class="text-white fw-bold mb-4"><i class="bi bi-clock-history text-gold me-2"></i>RIWAYAT LAYANAN
                </h4>
                <div class="table-responsive">
                    <table class="table table-dark table-hover border-secondary">
                        <thead>
                            <tr class="text-gold">
                                <th>TANGGAL</th>
                                <th>LAYANAN</th>
                                <th class="text-end">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Auth::user()->reservations()->latest()->get() as $res)
                            <tr>
                                <td class="text-white small">{{ \Carbon\Carbon::parse($res->date)->format('d M Y') }}
                                </td>
                                <td class="fw-bold text-white">{{ $res->service->name ?? 'Layanan' }}</td>
                                <td class="text-end">
                                    <span
                                        class="badge {{ strtolower($res->status) == 'done' ? 'bg-success' : 'bg-warning text-dark' }} px-3">
                                        {{ strtoupper($res->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-white">Belum ada riwayat.</td>
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