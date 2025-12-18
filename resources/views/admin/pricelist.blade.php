@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-4">Daftar Layanan (Pricelist)</h3>

<a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3 fw-bold">+ Tambah Layanan</a>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Durasi</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-start ps-4">{{ $service->name }}</td>
                    <td>{{ $service->duration ?? '-' }} menit</td>
                    <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                    <td><span class="badge bg-success">Aktif</span></td>
                    <td>
                        @if($service->image_path)
                        <img src="{{ asset('storage/' . $service->image_path) }}" width="50" height="50"
                            class="rounded object-fit-cover">
                        @else
                        <span class="text-muted small">No Img</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service->id) }}"
                            class="btn btn-warning btn-sm fw-bold">Edit</a>
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Hapus layanan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-muted py-4">Belum ada data layanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection