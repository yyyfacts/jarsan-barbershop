@extends('layouts.admin')

@section('content')
<div class="mb-4 text-center text-md-start">
    <h3 class="fw-bold">Daftar Reservasi Pelanggan</h3>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show fw-bold shadow-sm" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark text-nowrap text-center">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="text-start">Nama & Kontak</th>
                        <th>Layanan</th>
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $res)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-start">
                            <div class="fw-bold">{{ $res->name }}</div>
                            <div class="small text-muted">{{ $res->phone }}</div>
                        </td>
                        <td class="text-center">
                            @if($res->service)
                            <span class="badge bg-light text-dark border">{{ $res->service->name }}</span>
                            @else
                            <span class="text-danger small fst-italic">Layanan Dihapus</span>
                            @endif
                        </td>
                        <td class="text-center text-nowrap">
                            {{ \Carbon\Carbon::parse($res->date)->format('d M Y') }} <br>
                            <small class="text-primary fw-bold">{{ $res->time }}</small>
                        </td>
                        <td class="text-center">
                            @if(strtolower($res->status) == 'pending')
                            <span class="badge bg-warning text-dark rounded-pill px-3">Pending</span>
                            @else
                            <span class="badge bg-success rounded-pill px-3">Done</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- FORM GANTI STATUS --}}
                                <form action="{{ route('admin.reservations.status', $res->id) }}" method="POST">
                                    @csrf @method('PUT')

                                    {{-- Kirim status lawannya --}}
                                    @if(strtolower($res->status) == 'pending')
                                    <input type="hidden" name="status" value="done">
                                    <button class="btn btn-sm btn-success fw-bold" title="Tandai Selesai">✔
                                        Done</button>
                                    @else
                                    <input type="hidden" name="status" value="pending">
                                    <button class="btn btn-sm btn-secondary" title="Kembalikan ke Pending">↺
                                        Undo</button>
                                    @endif
                                </form>

                                {{-- FORM HAPUS --}}
                                <form action="{{ route('admin.reservations.destroy', $res->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus reservasi ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted fst-italic">Belum ada reservasi masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection