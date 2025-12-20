@extends('layouts.admin')

@section('content')
<div class="text-center mb-4">
    <h3 class="fw-bold">Daftar Reservasi Pelanggan</h3>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

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
                    <td>
                        @if($res->service)
                        <span class="fw-bold">{{ $res->service->name }}</span>
                        @else
                        <span class="text-danger small fst-italic">Layanan Dihapus</span>
                        @endif
                    </td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($res->date)->format('d M Y') }} <br>
                        <small class="text-muted">{{ $res->time }}</small>
                    </td>
                    <td class="text-center">
                        {{-- Cek Status dengan strtolower agar tidak sensitif huruf besar/kecil --}}
                        @if(strtolower($res->status) == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                        @else
                        <span class="badge bg-success">Done</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">

                            {{-- FORM GANTI STATUS --}}
                            <form action="{{ route('admin.reservations.status', $res->id) }}" method="POST">
                                @csrf @method('PUT')

                                {{-- LOGIKA TOMBOL: Kirim status yang berlawanan --}}
                                @if(strtolower($res->status) == 'pending')
                                {{-- Jika Pending, tombolnya kirim 'done' --}}
                                <input type="hidden" name="status" value="done">
                                <button class="btn btn-sm btn-success" title="Tandai Selesai">✔ Done</button>
                                @else
                                {{-- Jika Done, tombolnya kirim 'pending' --}}
                                <input type="hidden" name="status" value="pending">
                                <button class="btn btn-sm btn-secondary" title="Kembalikan ke Pending">↺ Undo</button>
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
                    <td colspan="7" class="text-center py-4 text-muted">Belum ada reservasi masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection