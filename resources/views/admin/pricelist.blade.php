@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    {{-- ALERT SUKSES --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show fw-bold" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <h3 class="fw-bold mb-4">Daftar Layanan (Pricelist)</h3>

    {{-- TOMBOL TAMBAH --}}
    <button type="button" class="btn btn-primary mb-3 fw-bold" data-bs-toggle="modal"
        data-bs-target="#modalTambahService">
        + Tambah Layanan
    </button>

    {{-- TABEL DATA --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Durasi</th> {{-- PERBAIKAN TAMPILAN --}}
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-bold">{{ $service->name }}</td>

                        {{-- PERBAIKAN 1: Panggil duration_minutes, BUKAN duration --}}
                        <td>{{ $service->duration_minutes ?? 0 }} menit</td>

                        <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td>
                            @if($service->image_path)
                            <img src="{{ asset('storage/' . $service->image_path) }}" width="50" height="50"
                                class="rounded object-fit-cover">
                            @else
                            <span class="text-muted small">No Img</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                {{-- TOMBOL EDIT --}}
                                <button type="button" class="btn btn-warning btn-sm fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#modalEditService{{ $service->id }}">
                                    Edit
                                </button>

                                {{-- FORM HAPUS --}}
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus layanan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT SERVICE --}}
                    <div class="modal fade" id="modalEditService{{ $service->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Edit Layanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
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
                                                {{-- PERBAIKAN 2: Value Edit mengambil duration_minutes --}}
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
                                            <label class="form-label fw-bold">Ganti Gambar</label>
                                            <input type="file" name="image" class="form-control">
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
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada layanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH SERVICE --}}
<div class="modal fade" id="modalTambahService" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
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
                        <label class="form-label fw-bold">Gambar</label>
                        <input type="file" name="image" class="form-control">
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