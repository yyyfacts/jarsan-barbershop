@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold m-0">Data Reservasi</h3>
        <p class="small" style="color: var(--text-muted);">Pantau booking masuk dan kelola status reservasi.</p>
    </div>
    <a href="{{ route('admin.reservations.export') }}" class="btn btn-success shadow-sm">
        <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
    </a>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger border-0 shadow-sm mb-4">
    <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
</div>
@endif

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Pelanggan</th>
                        <th>Layanan & Barber</th>
                        <th>Jadwal</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $res)
                    <tr>
                        <td class="text-center" style="color: var(--text-muted);">{{ $loop->iteration }}</td>

                        {{-- KOLOM PELANGGAN --}}
                        <td>
                            <div class="fw-bold">{{ $res->name }}</div>
                            <div class="small" style="color: var(--text-muted);">
                                <i class="bi bi-telephone me-1"></i>{{ $res->phone }}
                            </div>
                        </td>

                        {{-- KOLOM LAYANAN --}}
                        <td>
                            <span class="badge border fw-normal mb-1"
                                style="color: var(--text-main); background-color: var(--bg-body); border-color: var(--border-color) !important;">
                                {{ $res->service->name ?? '-' }}
                            </span>
                            <div class="small text-muted">
                                <i class="bi bi-person-fill me-1"></i> {{ $res->barber->name ?? 'Any Barber' }}
                            </div>
                        </td>

                        {{-- KOLOM JADWAL --}}
                        <td>
                            <div class="fw-bold">{{ \Carbon\Carbon::parse($res->date)->translatedFormat('d M Y') }}
                            </div>
                            <div class="small" style="color: var(--gold-primary);">{{ $res->time }} WIB</div>
                        </td>

                        {{-- KOLOM STATUS (Visual Badge) --}}
                        <td class="text-center">
                            @if($res->status == 'Pending')
                            <span class="badge bg-warning text-dark border border-warning">
                                <i class="bi bi-hourglass-split me-1"></i> Pending
                            </span>
                            @elseif($res->status == 'Approved')
                            <span class="badge bg-info text-dark border border-info">
                                <i class="bi bi-calendar-check me-1"></i> Dikonfirmasi
                            </span>
                            @elseif($res->status == 'Done')
                            <span class="badge bg-success border border-success">
                                <i class="bi bi-check-circle-fill me-1"></i> Selesai
                            </span>
                            @elseif($res->status == 'Canceled')
                            <span class="badge bg-danger border border-danger">
                                <i class="bi bi-x-circle me-1"></i> Batal
                            </span>
                            @else
                            <span class="badge bg-secondary">{{ $res->status }}</span>
                            @endif
                        </td>

                        {{-- KOLOM AKSI (LOGIKA UTAMA) --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                {{-- JIKA STATUS PENDING: Munculkan Tombol ACC & TOLAK --}}
                                @if($res->status == 'Pending')
                                {{-- Tombol ACC --}}
                                <form action="{{ route('admin.reservations.status', $res->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="Approved">
                                    <button class="btn btn-sm btn-success text-white" title="Terima Booking">
                                        <i class="bi bi-check-lg"></i> ACC
                                    </button>
                                </form>

                                {{-- Tombol Tolak --}}
                                <form action="{{ route('admin.reservations.status', $res->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="Canceled">
                                    <button class="btn btn-sm btn-outline-danger" title="Tolak Booking"
                                        onclick="return confirm('Yakin ingin menolak booking ini?')">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>

                                {{-- JIKA STATUS APPROVED: Munculkan Tombol SELESAI --}}
                                @elseif($res->status == 'Approved')
                                <form action="{{ route('admin.reservations.status', $res->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="Done">
                                    <button class="btn btn-sm btn-primary w-100" title="Tandai Selesai">
                                        <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                    </button>
                                </form>

                                {{-- JIKA STATUS DONE/CANCELED: Tidak ada tombol aksi status --}}
                                @else
                                <span class="text-muted small fst-italic">-</span>
                                @endif

                                {{-- Tombol Hapus (Selalu Ada) --}}
                                <form action="{{ route('admin.reservations.destroy', $res->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data reservasi ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-secondary rounded-circle" title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5" style="color: var(--text-muted);">
                            <i class="bi bi-inbox display-6 d-block mb-3 opacity-25"></i>
                            Belum ada data reservasi masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection