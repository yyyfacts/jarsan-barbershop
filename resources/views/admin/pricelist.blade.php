@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark m-0">Layanan & Harga</h3>
        <p class="text-muted small">Kelola daftar layanan barbershop Anda.</p>
    </div>
    <button type="button" class="btn btn-gold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahService">
        <i class="bi bi-plus-lg me-1"></i> Tambah Layanan
    </button>
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
                        <th width="10%">Gambar</th>
                        <th>Nama Layanan</th>
                        <th>Durasi</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td>
                            @if($service->image_path)
                            <img src="{{ $service->image_path }}" width="50" height="40"
                                class="rounded object-fit-cover border">
                            @else
                            <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 40px;">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $service->name }}</div>
                            <div class="text-muted small text-truncate" style="max-width: 200px;">
                                {{ $service->description }}</div>
                        </td>
                        <td class="text-muted">{{ $service->duration_minutes }} Menit</td>
                        <td class="fw-bold text-dark">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                data-bs-target="#modalEditService{{ $service->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Hapus layanan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEditService{{ $service->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header bg-white border-bottom-0">
                                    <h5 class="modal-title fw-bold">Edit Layanan</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3"><label class="form-label">Nama Layanan</label><input
                                                type="text" name="name" class="form-control"
                                                value="{{ $service->name }}"></div>
                                        <div class="row">
                                            <div class="col-6 mb-3"><label class="form-label">Harga (Rp)</label><input
                                                    type="number" name="price" class="form-control"
                                                    value="{{ $service->price }}"></div>
                                            <div class="col-6 mb-3"><label class="form-label">Durasi
                                                    (Menit)</label><input type="number" name="duration"
                                                    class="form-control" value="{{ $service->duration_minutes }}"></div>
                                        </div>
                                        <div class="mb-3"><label class="form-label">Deskripsi</label><textarea
                                                name="description" class="form-control"
                                                rows="3">{{ $service->description }}</textarea></div>
                                        <div class="mb-3"><label class="form-label">Gambar</label><input type="file"
                                                name="image" class="form-control"></div>
                                    </div>
                                    <div class="modal-footer border-top-0">
                                        <button type="submit" class="btn btn-gold w-100">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada layanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahService" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom-0">
                <h5 class="modal-title fw-bold">Tambah Layanan Baru</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Nama Layanan</label><input type="text" name="name"
                            class="form-control" required></div>
                    <div class="row">
                        <div class="col-6 mb-3"><label class="form-label">Harga (Rp)</label><input type="number"
                                name="price" class="form-control" required></div>
                        <div class="col-6 mb-3"><label class="form-label">Durasi (Menit)</label><input type="number"
                                name="duration" class="form-control"></div>
                    </div>
                    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="description"
                            class="form-control" rows="3"></textarea></div>
                    <div class="mb-3"><label class="form-label">Gambar</label><input type="file" name="image"
                            class="form-control"></div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="submit" class="btn btn-gold w-100">Simpan Layanan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection