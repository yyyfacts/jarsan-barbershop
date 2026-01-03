@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold m-0 text-dark">Daftar Tim Barber</h3>
        <p class="small text-muted">Kelola data barberman, spesialisasi, dan jadwal kerja mingguan.</p>
    </div>
    {{-- Tombol Trigger Modal Tambah --}}
    <button class="btn btn-warning fw-bold shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-person-plus-fill me-2"></i> Tambah Barber
    </button>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
</div>
@endif

{{-- TABEL DATA BARBER --}}
<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="text-center py-3" width="5%">No</th>
                        <th width="10%">Foto</th>
                        <th width="25%">Nama & Spesialisasi</th>
                        <th>Jadwal Kerja</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barbers as $barber)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ $barber->photo_path ?? 'https://ui-avatars.com/api/?name='.urlencode($barber->name).'&background=random' }}"
                                class="rounded-circle object-fit-cover border shadow-sm" width="50" height="50">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $barber->name }}</div>
                            <span class="badge bg-warning text-dark small mb-1">{{ $barber->specialty }}</span>
                            <div class="small text-muted fst-italic text-truncate" style="max-width: 200px;">
                                {{ $barber->bio }}
                            </div>
                        </td>
                        <td class="small">
                            @if($barber->schedule && is_array($barber->schedule))
                            <div class="row g-1">
                                @foreach($barber->schedule as $day => $time)
                                @if($time && strtoupper($time) !== 'OFF')
                                <div class="col-6 col-lg-4">
                                    <span class="d-block text-muted border rounded px-2 py-1 bg-light">
                                        <strong class="text-dark">{{ substr($day, 0, 3) }}:</strong> {{ $time }}
                                    </span>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            @else
                            <span class="text-muted fst-italic">Belum ada jadwal</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Tombol Edit --}}
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $barber->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.barbers.destroy', $barber->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus {{ $barber->name }}? Data tidak bisa dikembalikan.');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT (Per Item Loop) --}}
                    <div class="modal fade" id="modalEdit{{ $barber->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title fw-bold">Edit Data: {{ $barber->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.barbers.update', $barber->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body pt-0">
                                        <div class="row g-4">
                                            {{-- Kolom Kiri --}}
                                            <div class="col-md-6 border-end">
                                                <h6 class="fw-bold text-primary mb-3">Informasi Dasar</h6>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-muted">NAMA
                                                        LENGKAP</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $barber->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label small fw-bold text-muted">SPESIALISASI</label>
                                                    <input type="text" name="specialty" class="form-control"
                                                        value="{{ $barber->specialty }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-muted">BIO
                                                        SINGKAT</label>
                                                    <textarea name="bio" class="form-control"
                                                        rows="3">{{ $barber->bio }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold text-muted">GANTI
                                                        FOTO</label>
                                                    <input type="file" name="photo" class="form-control"
                                                        accept="image/*">
                                                </div>
                                            </div>
                                            {{-- Kolom Kanan (Jadwal) --}}
                                            <div class="col-md-6">
                                                <h6 class="fw-bold text-success mb-3">Jadwal Kerja</h6>
                                                <div class="bg-light p-3 rounded border">
                                                    @php $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu',
                                                    'Minggu']; @endphp
                                                    @foreach($days as $day)
                                                    <div class="row mb-2 align-items-center">
                                                        <label
                                                            class="col-3 col-form-label small fw-bold">{{ $day }}</label>
                                                        <div class="col-9">
                                                            <input type="text" name="schedule[{{ $day }}]"
                                                                class="form-control form-control-sm"
                                                                value="{{ $barber->schedule[$day] ?? '' }}"
                                                                placeholder="OFF / 10:00 - 21:00">
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
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
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-1 d-block mb-3 opacity-25"></i>
                            Belum ada data barber. Silakan tambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH BARU --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold">Tambah Barber Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.barbers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-0">
                    <div class="row g-4">
                        {{-- Kolom Kiri --}}
                        <div class="col-md-6 border-end">
                            <h6 class="fw-bold text-primary mb-3">Informasi Dasar</h6>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                                <input type="text" name="name" class="form-control" required
                                    placeholder="Contoh: Zain Arifin">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">SPESIALISASI</label>
                                <input type="text" name="specialty" class="form-control" required
                                    placeholder="Contoh: Senior Barber">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">BIO SINGKAT</label>
                                <textarea name="bio" class="form-control" rows="3"
                                    placeholder="Deskripsi singkat..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">FOTO PROFIL</label>
                                <input type="file" name="photo" class="form-control" accept="image/*">
                            </div>
                        </div>

                        {{-- Kolom Kanan (Jadwal) --}}
                        <div class="col-md-6">
                            <h6 class="fw-bold text-success mb-3">Jadwal Kerja</h6>
                            <div class="bg-light p-3 rounded border">
                                <p class="small text-muted mb-3 fst-italic">Isi "OFF" jika libur.</p>
                                @php $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']; @endphp
                                @foreach($days as $day)
                                <div class="row mb-2 align-items-center">
                                    <label class="col-3 col-form-label small fw-bold">{{ $day }}</label>
                                    <div class="col-9">
                                        <input type="text" name="schedule[{{ $day }}]"
                                            class="form-control form-control-sm" value="10:00 - 21:00"
                                            placeholder="OFF / 10:00 - 21:00">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link text-muted text-decoration-none"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning fw-bold px-4">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection