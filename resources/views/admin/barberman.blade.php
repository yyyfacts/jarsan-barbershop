@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark m-0">Daftar Barberman</h3>
    <button class="btn btn-gold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg me-1"></i> Tambah Barber
    </button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th width="10%">Foto</th>
                        <th>Nama & Spesialisasi</th>
                        <th>Bio Singkat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barbers as $barber)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ $barber->photo_path ?? 'https://ui-avatars.com/api/?name='.urlencode($barber->name) }}"
                                class="rounded-circle object-fit-cover shadow-sm" width="45" height="45">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $barber->name }}</div>
                            <span class="badge bg-warning text-dark bg-opacity-25">{{ $barber->specialty }}</span>
                        </td>
                        <td class="text-muted small">
                            {{ Str::limit($barber->bio, 50) }}
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada data barberman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Barber</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.barbers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name"
                            class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Spesialisasi</label><input type="text" name="specialty"
                            class="form-control" required></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-gold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection