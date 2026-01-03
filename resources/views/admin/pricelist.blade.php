@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold m-0 text-dark">Manajemen Layanan (Pricelist)</h3>
        <p class="small text-muted">Atur judul halaman utama, CTA, dan daftar harga layanan.</p>
    </div>
    {{-- Tombol Trigger Modal Tambah --}}
    <button class="btn btn-warning fw-bold shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#modalTambahService">
        <i class="bi bi-plus-lg me-2"></i> Tambah Layanan
    </button>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
</div>
@endif

{{-- BAGIAN 1: PENGATURAN TEKS HALAMAN (Form ke AboutController) --}}
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
        <h6 class="fw-bold m-0 text-dark"><i class="bi bi-fonts me-2"></i>Edit Teks Halaman</h6>
    </div>
    <div class="card-body p-4">
        {{-- Form ini mengirim data ke route admin.about.update --}}
        <form action="{{ route('admin.about.update') }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-4">
                {{-- Bagian Atas (Hero) --}}
                <div class="col-12">
                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">Bagian Atas (Hero Section)</h6>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">SUB-JUDUL</label>
                    <input type="text" name="pricelist_subtitle" class="form-control"
                        value="{{ $about->pricelist_subtitle ?? 'EXCLUSIVE TREATMENTS' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">JUDUL UTAMA</label>
                    <input type="text" name="pricelist_title" class="form-control"
                        value="{{ $about->pricelist_title ?? 'SERVICE MENU' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">DESKRIPSI SINGKAT</label>
                    <textarea name="pricelist_description" class="form-control"
                        rows="1">{{ $about->pricelist_description ?? 'Layanan perawatan rambut terbaik...' }}</textarea>
                </div>

                {{-- Bagian Bawah (CTA) --}}
                <div class="col-12 mt-2">
                    <h6 class="fw-bold text-success border-bottom pb-2 mb-3">Bagian Bawah (Call to Action)</h6>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">JUDUL CTA</label>
                    <input type="text" name="pricelist_cta_title" class="form-control"
                        value="{{ $about->pricelist_cta_title ?? 'INGIN TAMPIL LEBIH BERANI?' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">TEKS CTA</label>
                    <input type="text" name="pricelist_cta_text" class="form-control"
                        value="{{ $about->pricelist_cta_text ?? 'Pesan jadwal pengerjaan Anda sekarang...' }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-dark w-100 fw-bold">
                        <i class="bi bi-save me-1"></i> Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- BAGIAN 2: TABEL DAFTAR LAYANAN --}}
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-bottom py-3">
        <h6 class="fw-bold m-0 text-dark"><i class="bi bi-scissors me-2"></i>Daftar Layanan Tersedia</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="text-center py-3" width="5%">No</th>
                        <th width="10%">Gambar</th>
                        <th>Nama & Deskripsi</th>
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
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalEditService{{ $service->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
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

                    {{-- MODAL EDIT (Per Item Loop) --}}
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
                                            <label class="form-label small fw-bold text-muted">GANTI GAMBAR</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
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