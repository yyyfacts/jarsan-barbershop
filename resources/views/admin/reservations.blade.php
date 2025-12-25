@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-dark m-0">Data Reservasi</h3>
    <p class="text-muted small">Pantau jadwal booking pelanggan.</p>
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
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $res->name }}</div>
                            <div class="small text-muted"><i class="bi bi-telephone me-1"></i>{{ $res->phone }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $res->service->name ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($res->date)->format('d M Y') }}
                            </div>
                            <div class="small text-primary">{{ $res->time }} WIB</div>
                        </td>
                        <td class="text-center">
                            @if(strtolower($res->status) == 'pending')
                            <span class="badge bg-warning text-dark bg-opacity-25 border border-warning">Pending</span>
                            @else
                            <span
                                class="badge bg-success text-success bg-opacity-10 border border-success">Selesai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <form action="{{ route('admin.reservations.status', $res->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status"
                                        value="{{ strtolower($res->status) == 'pending' ? 'done' : 'pending' }}">
                                    <button
                                        class="btn btn-sm {{ strtolower($res->status) == 'pending' ? 'btn-outline-success' : 'btn-outline-secondary' }}"
                                        title="Ubah Status">
                                        <i
                                            class="bi {{ strtolower($res->status) == 'pending' ? 'bi-check-lg' : 'bi-arrow-counterclockwise' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.reservations.destroy', $res->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data reservasi ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Tidak ada data reservasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection