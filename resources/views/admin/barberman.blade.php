@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold m-0">Daftar Barberman</h3>
        <p class="small text-muted">Kelola tim profesional barbershop Anda.</p>
    </div>
    <button class="btn btn-gold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg me-1"></i> Tambah Barber
    </button>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th width="10%">Foto</th>
                        <th>Nama & Spesialisasi</th>
                        <th>Bio</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barbers as $barber)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ $barber->photo_path ?? 'https://ui-avatars.com/api/?name='.urlencode($barber->name) }}"
                                class="rounded-circle object-fit-cover border shadow-sm" width="45" height="45">
                        </td>
                        <td>
                            <div class="fw-bold">{{ $barber->name }}</div>
                            <span class="badge bg-warning text-dark small">{{ $barber->specialty }}</span>
                        </td>
                        <td class="small text-muted">{{ Str::limit($barber->bio, 50) }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary rounded-circle me-1" data-bs-toggle="modal"
                                data-bs-target="#modalEdit{{ $barber->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <form action="{{ route('admin.barbers.destroy', $barber->id) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Hapus barber ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-circle">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEdit{{ $barber->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-bottom">
                                    <h5 class="modal-title fw-bold">Edit Barber</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.barbers.update', $barber->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">NAMA LENGKAP</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $barber->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">SPESIALISASI</label>
                                            <input type="text" name="specialty" class="form-control"
                                                value="{{ $barber->specialty }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">BIO SINGKAT</label>
                                            <textarea name="bio" class="form-control"
                                                rows="3">{{ $barber->bio }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">FOTO BARU (Opsional)</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top">
                                        <button type="submit" class="btn btn-primary w-100">Update Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Tambah Barber</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.barbers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">NAMA LENGKAP</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">SPESIALISASI</label>
                        <input type="text" name="specialty" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">BIO SINGKAT</label>
                        <textarea name="bio" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">FOTO PROFIL</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="submit" class="btn btn-gold w-100">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection