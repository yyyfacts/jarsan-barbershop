@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
    <h3 class="fw-bold m-0">Daftar Layanan (Pricelist)</h3>
    <button type="button" class="btn btn-primary fw-bold w-100 w-md-auto" data-bs-toggle="modal"
        data-bs-target="#modalTambahService">
        <i class="bi bi-plus-lg me-1"></i> Tambah Layanan
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
                        <th>Nama Layanan</th>
                        <th>Durasi</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th class="text-center p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="fw-bold">{{ $service->name }}</td>
                        <td>{{ $service->duration_minutes ?? 0 }} menit</td>
                        <td class="text-nowrap">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td>
                            @if($service->image_path)
                            <img src="{{ $service->image_path }}" width="50" height="50"
                                class="rounded object-fit-cover border">
                            @else
                            <span class="text-muted small fst-italic">No Img</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-warning btn-sm fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#modalEditService{{ $service->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus layanan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT SERVICE (DALAM LOOP) --}}
                    <div class="modal fade" id="modalEditService{{ $service->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Edit Layanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Nama Layanan</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $service->name }}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label class="form-label fw-bold">Harga (Rp)</label>
                                                <input type="number" name="price" class="form-control"
                                                    value="{{ $service->price }}" required>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label fw-bold">Durasi (Menit)</label>
                                                <input type="number" name="duration" class="form-control"
                                                    value="{{ $service->duration_minutes }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Deskripsi</label>
                                            <textarea name="description" class="form-control"
                                                rows="3">{{ $service->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Ganti Gambar (Max 1MB)</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin ganti.</small>
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
                        <td colspan="6" class="text-center py-5 text-muted fst-italic">Belum ada layanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH SERVICE (DI LUAR LOOP) --}}
<div class="modal fade" id="modalTambahService" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Layanan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Layanan</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">Durasi (Menit)</label>
                            <input type="number" name="duration" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Gambar (Max 1MB)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
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