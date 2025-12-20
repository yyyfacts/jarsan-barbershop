@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show fw-bold" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <h3 class="fw-bold mb-4">Daftar Barberman</h3>

    <button type="button" class="btn btn-primary mb-3 fw-bold" data-bs-toggle="modal"
        data-bs-target="#modalTambahBarber">
        + Tambah Barber
    </button>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
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
                            {{-- TAMPILKAN BASE64 LANGSUNG --}}
                            @if($barber->photo_path)
                            <img src="{{ $barber->photo_path }}" width="50" height="50"
                                class="rounded-circle object-fit-cover">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($barber->name) }}&background=random"
                                width="50" height="50" class="rounded-circle">
                            @endif
                        </td>
                        <td class="fw-bold">{{ $barber->name }}</td>
                        <td>{{ $barber->specialty ?? '-' }}</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td>
                            <div class="d-flex gap-2">
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

                    {{-- MODAL EDIT --}}
                    <div class="modal fade" id="modalEditBarber{{ $barber->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Edit Barber</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                {{-- WAJIB PAKAI ENCTYPE MULTIPART --}}
                                <form action="{{ route('admin.barbers.update', $barber->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
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
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada data barber.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahBarber" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
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