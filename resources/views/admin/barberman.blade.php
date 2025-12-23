@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
    <h3 class="fw-bold m-0">Daftar Barberman</h3>
    <button type="button" class="btn btn-primary fw-bold w-100 w-md-auto" data-bs-toggle="modal"
        data-bs-target="#modalTambahBarber">
        <i class="bi bi-plus-lg me-1"></i> Tambah Barber
    </button>
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
                <thead class="table-dark text-nowrap">
                    <tr>
                        <th class="text-center p-3">No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Spesialis</th>
                        <th class="text-center">Status</th>
                        <th class="text-center p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barbers as $barber)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            @if($barber->photo_path)
                            <img src="{{ $barber->photo_path }}" width="50" height="50"
                                class="rounded-circle object-fit-cover border">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($barber->name) }}&background=random"
                                width="50" height="50" class="rounded-circle border">
                            @endif
                        </td>
                        <td class="fw-bold text-nowrap">{{ $barber->name }}</td>
                        <td>{{ $barber->specialty ?? '-' }}</td>
                        <td class="text-center"><span class="badge bg-success rounded-pill px-3">Aktif</span></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-warning btn-sm fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#modalEditBarber{{ $barber->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('admin.barbers.destroy', $barber->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus barber ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT (HARUS DALAM LOOP AGAR ID UNIK) --}}
                    <div class="modal fade" id="modalEditBarber{{ $barber->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Edit Barber</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.barbers.update', $barber->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $barber->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Spesialisasi</label>
                                            <input type="text" name="specialty" class="form-control"
                                                value="{{ $barber->specialty }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Bio</label>
                                            <textarea name="bio" class="form-control"
                                                rows="3">{{ $barber->bio }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Ganti Foto (Max 1MB)</label>
                                            <input type="file" name="photo" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success fw-bold">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted fst-italic">Belum ada data barber.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH BARBER (DI LUAR LOOP) --}}
<div class="modal fade" id="modalTambahBarber" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Barber Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.barbers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Spesialisasi</label>
                        <input type="text" name="specialty" class="form-control" placeholder="Contoh: Hair Tattoo">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Bio</label>
                        <textarea name="bio" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Foto (Max 1MB)</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection