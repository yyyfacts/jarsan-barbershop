@extends('layouts.admin')

@section('content')
<div class="text-center mb-4">
    <h3 class="fw-bold">Daftar Reservasi Pelanggan</h3>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped mb-0 align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Layanan</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $res)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $res->name }}</td>
                    <td>{{ $res->phone }}</td>
                    <td>{{ $res->service_name }}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($res->date)->format('d M Y') }} <br>
                        <small class="text-muted">{{ $res->time }}</small>
                    </td>
                    <td class="text-center">
                        @if($res->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                        @else
                        <span class="badge bg-success">Done</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            {{-- Ubah Status --}}
                            <form action="{{ route('admin.reservations.status', $res->id) }}" method="POST">
                                @csrf @method('PUT')
                                @if($res->status == 'pending')
                                <button class="btn btn-sm btn-success" title="Tandai Selesai">✔ Done</button>
                                @else
                                <button class="btn btn-sm btn-secondary" title="Kembalikan ke Pending">↺ Undo</button>
                                @endif
                            </form>

                            {{-- Hapus --}}
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
                    <td colspan="7" class="text-center py-4 text-muted">Belum ada reservasi masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection