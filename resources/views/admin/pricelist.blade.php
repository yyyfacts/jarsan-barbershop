@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold m-0 text-dark">Manajemen Layanan (Pricelist)</h3>
        <p class="small text-muted">Kelola daftar harga dan jenis layanan yang tersedia.</p>
    </div>
    {{-- Tombol Trigger Modal Tambah --}}
    <button class="btn btn-warning fw-bold shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#modalTambahService">
        <i class="bi bi-plus-lg me-2"></i> Tambah Layanan
    </button>
</div>

{{-- ALERT SUCCESS --}}
@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4 alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- ALERT ERROR --}}
@if($errors->any())
<div class="alert alert-danger border-0 shadow-sm mb-4 alert-dismissible fade show" role="alert">
    <ul class="mb-0 ps-3">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- TABEL DAFTAR LAYANAN --}}
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
        <h6 class="fw-bold m-0 text-dark"><i class="bi bi-scissors me-2"></i>Daftar Layanan Tersedia</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-nowrap">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="text-center py-3" width="5%">No</th>
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
                            <img src="{{ $service->image_path }}" width="60" height="45"
                                class="rounded object-fit-cover border shadow-sm">
                            @else
                            <div class="rounded border d-flex align-items-center justify-content-center bg-light text-muted"
                                style="width: 60px; height: 45px;">
                                <i class="bi bi-image"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $service->name }}</div>
                            <div class="small text-muted text-truncate" style="max-width: 250px;">
                                {{ $service->description }}
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $service->duration_minutes }} Menit</span>
                        </td>
                        <td class="fw-bold text-success">
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Tombol Edit --}}
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalEditService{{ $service->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT (Looping untuk setiap item) --}}
                    <div class="modal fade" id="modalEditService{{ $service->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title fw-bold">Edit Layanan</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body pt-0">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold text-muted">NAMA LAYANAN</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $service->name }}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label class="form-label small fw-bold text-muted">HARGA (RP)</label>
                                                <input type="number" name="price" class="form-control"
                                                    value="{{ $service->price }}" required>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label small fw-bold text-muted">DURASI
                                                    (MENIT)</label>
                                                <input type="number" name="duration" class="form-control"
                                                    value="{{ $service->duration_minutes }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold text-muted">DESKRIPSI</label>
                                            <textarea name="description" class="form-control"
                                                rows="3">{{ $service->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold text-muted">GANTI GAMBAR
                                                (OPSIONAL)</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah
                                                gambar.</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-link text-muted text-decoration-none"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary fw-bold px-4">Simpan
                                            Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-clipboard-x fs-1 d-block mb-3 opacity-25"></i>
                            Belum ada layanan yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH BARU --}}
<div class="modal fade" id="modalTambahService" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold">Tambah Layanan Baru</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-0">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">NAMA LAYANAN</label>
                        <input type="text" name="name" class="form-control" required
                            placeholder="Contoh: Gentleman Cut">
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label small fw-bold text-muted">HARGA (RP)</label>
                            <input type="number" name="price" class="form-control" required placeholder="50000">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label small fw-bold text-muted">DURASI (MENIT)</label>
                            <input type="number" name="duration" class="form-control" placeholder="45">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">DESKRIPSI</label>
                        <textarea name="description" class="form-control" rows="3"
                            placeholder="Jelaskan detail layanan..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">GAMBAR (OPSIONAL)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link text-muted text-decoration-none"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning fw-bold px-4">Simpan Layanan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection