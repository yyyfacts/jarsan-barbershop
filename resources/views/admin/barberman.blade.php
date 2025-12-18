@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-4">Daftar Barberman</h3>

{{-- Tombol Tambah --}}
<a href="{{ route('admin.barbers.create') }}" class="btn btn-primary mb-3 fw-bold">+ Tambah Barber</a>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Spesialis</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barbers as $barber)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($barber->photo_path)
                        <img src="{{ asset('storage/' . $barber->photo_path) }}" width="50" height="50"
                            class="rounded-circle object-fit-cover">
                        @else
                        {{-- Placeholder jika tidak ada foto --}}
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($barber->name) }}&background=random"
                            width="50" height="50" class="rounded-circle">
                        @endif
                    </td>
                    <td class="text-start ps-4 fw-bold">{{ $barber->name }}</td>
                    <td>{{ $barber->specialty ?? '-' }}</td>
                    <td>
                        <span class="badge bg-success">Aktif</span>
                    </td>
                    <td>
                        {{-- Tombol Edit --}}
                        <a href="{{ route('admin.barbers.edit', $barber->id) }}"
                            class="btn btn-warning btn-sm fw-bold">Edit</a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.barbers.destroy', $barber->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus barber ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted py-4 text-center">Belum ada data barberman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection