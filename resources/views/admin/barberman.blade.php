@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
    <h3 class="fw-bold m-0 text-white">Master Barberman</h3>
    <button type="button" class="btn btn-gold px-4 py-2 w-100 w-md-auto shadow" data-bs-toggle="modal"
        data-bs-target="#modalTambahBarber">
        + ADD NEW BARBER
    </button>
</div>

@if(session('success'))
<div class="alert alert-dark border-0 shadow-sm text-center mb-4" role="alert"
    style="border-left: 4px solid var(--gold-accent) !important;">
    <span style="color: var(--gold-accent);">{{ session('success') }}</span>
</div>
@endif

<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center py-4">NO</th>
                        <th class="py-4">PROFILE</th>
                        <th class="py-4">NAME</th>
                        <th class="py-4">SPECIALTY</th>
                        <th class="text-center py-4">STATUS</th>
                        <th class="text-center py-4">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barbers as $barber)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ $barber->photo_path ?? 'https://ui-avatars.com/api/?name='.urlencode($barber->name).'&background=D4AF37&color=000' }}"
                                width="50" height="50" class="rounded-circle object-fit-cover border border-secondary">
                        </td>
                        <td class="fw-bold text-white">{{ $barber->name }}</td>
                        <td class="text-muted">{{ $barber->specialty ?? 'General' }}</td>
                        <td class="text-center">
                            <span
                                class="badge bg-transparent border border-success text-success px-3 py-2 rounded-0">ACTIVE</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-outline-light rounded-0" data-bs-toggle="modal"
                                    data-bs-target="#modalEditBarber{{ $barber->id }}">EDIT</button>
                                <form action="{{ route('admin.barbers.destroy', $barber->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this barber?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-0">DEL</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT --}}
                    <div class="modal fade" id="modalEditBarber{{ $barber->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Barber Profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.barbers.update', $barber->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">FULL NAME</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $barber->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">SPECIALTY</label>
                                            <input type="text" name="specialty" class="form-control"
                                                value="{{ $barber->specialty }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">BIOGRAPHY</label>
                                            <textarea name="bio" class="form-control"
                                                rows="3">{{ $barber->bio }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">UPDATE PHOTO</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-outline-light"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-gold">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">No barbers found in database.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahBarber" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Barber</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.barbers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small">FULL NAME</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">SPECIALTY</label>
                        <input type="text" name="specialty" class="form-control" placeholder="e.g. Classic Cut">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">BIOGRAPHY</label>
                        <textarea name="bio" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">PHOTO UPLOAD</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-gold">Create Barber</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection