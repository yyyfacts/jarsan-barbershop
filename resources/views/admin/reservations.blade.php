@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold m-0">Data Reservasi</h3>
    <p class="small" style="color: var(--text-muted);">Pantau booking masuk dan status pelanggan.</p>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
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
                        <th>Layanan</th>
                        <th>Jadwal</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $res)
                    <tr>
                        <td class="text-center" style="color: var(--text-muted);">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold">{{ $res->name }}</div>
                            <div class="small" style="color: var(--text-muted);"><i
                                    class="bi bi-telephone me-1"></i>{{ $res->phone }}</div>
                        </td>
                        <td>
                            <span class="badge border fw-normal"
                                style="color: var(--text-main); background-color: var(--bg-body); border-color: var(--border-color) !important;">
                                {{ $res->service->name ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <div class="fw-bold">{{ \Carbon\Carbon::parse($res->date)->format('d M Y') }}</div>
                            <div class="small" style="color: var(--gold-primary);">{{ $res->time }} WIB</div>
                        </td>
                        <td class="text-center">
                            @if(strtolower($res->status) == 'pending')
                            <span
                                class="badge bg-warning bg-opacity-25 text-warning border border-warning">Pending</span>
                            @else
                            <span
                                class="badge bg-success bg-opacity-25 text-success border border-success">Selesai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <form action="{{ route('admin.reservations.status', $res->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status"
                                        value="{{ strtolower($res->status) == 'pending' ? 'done' : 'pending' }}">
                                    <button
                                        class="btn btn-sm rounded-circle {{ strtolower($res->status) == 'pending' ? 'btn-outline-success' : 'btn-outline-secondary' }}"
                                        style="width: 32px; height: 32px;" title="Ubah Status">
                                        <i
                                            class="bi {{ strtolower($res->status) == 'pending' ? 'bi-check-lg' : 'bi-arrow-counterclockwise' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.reservations.destroy', $res->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus reservasi ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-circle"
                                        style="width: 32px; height: 32px;" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5" style="color: var(--text-muted);">Tidak ada data
                            reservasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection