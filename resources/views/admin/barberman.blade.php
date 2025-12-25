@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
    <div>
        <h6 class="text-gold small-caps mb-1">Management</h6>
        <h3 class="fw-bold m-0 text-white">Barber Team</h3>
    </div>
    <button type="button" class="btn btn-gold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBarber">
        <i class="bi bi-plus-lg me-1"></i> Add New Barber
    </button>
</div>

@if(session('success'))
<div class="alert alert-dark border-0 d-flex align-items-center mb-4" role="alert">
    <i class="bi bi-check-circle-fill text-gold me-2"></i>
    <div class="text-white small">{{ session('success') }}</div>
</div>
@endif

<div class="card border-0 rounded-3 overflow-hidden" style="background-color: #141414;">
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead>
                <tr>
                    <th class="w-fit text-center">#</th>
                    <th class="w-fit">Profile</th>
                    <th>Name / Specialty</th>
                    <th class="d-none d-md-table-cell">Bio Summary</th>
                    <th class="w-fit text-center">Status</th>
                    <th class="w-fit text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barbers as $barber)
                <tr>
                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ $barber->photo_path ?? 'https://ui-avatars.com/api/?name='.urlencode($barber->name).'&background=1f1f1f&color=fff' }}"
                            width="48" height="48" class="rounded-circle object-fit-cover border border-secondary">
                    </td>
                    <td>
                        <div class="fw-bold text-white">{{ $barber->name }}</div>
                        <div class="small text-gold">{{ $barber->specialty }}</div>
                    </td>
                    <td class="d-none d-md-table-cell text-muted">
                        <div class="text-truncate" style="max-width: 250px;">{{ $barber->bio }}</div>
                    </td>
                    <td class="text-center">
                        <span
                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2 small">Active</span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <button class="btn btn-icon text-white" data-bs-toggle="modal"
                                data-bs-target="#modalEditBarber{{ $barber->id }}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.barbers.destroy', $barber->id) }}" method="POST"
                                onsubmit="return confirm('Delete this barber?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-icon text-danger" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="modalEditBarber{{ $barber->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-serif">Edit Barber</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('admin.barbers.update', $barber->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3"><label class="text-muted small mb-1">Name</label><input
                                            type="text" name="name" class="form-control" value="{{ $barber->name }}">
                                    </div>
                                    <div class="mb-3"><label class="text-muted small mb-1">Specialty</label><input
                                            type="text" name="specialty" class="form-control"
                                            value="{{ $barber->specialty }}"></div>
                                    <div class="mb-3"><label class="text-muted small mb-1">Bio</label><textarea
                                            name="bio" class="form-control" rows="3">{{ $barber->bio }}</textarea></div>
                                    <div class="mb-3"><label class="text-muted small mb-1">Photo</label><input
                                            type="file" name="photo" class="form-control"></div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="submit" class="btn btn-gold w-100">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">No barber data available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambahBarber" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-serif">Add New Barber</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.barbers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3"><label class="text-muted small mb-1">Name</label><input type="text" name="name"
                            class="form-control" required></div>
                    <div class="mb-3"><label class="text-muted small mb-1">Specialty</label><input type="text"
                            name="specialty" class="form-control" required></div>
                    <div class="mb-3"><label class="text-muted small mb-1">Bio</label><textarea name="bio"
                            class="form-control" rows="3"></textarea></div>
                    <div class="mb-3"><label class="text-muted small mb-1">Photo</label><input type="file" name="photo"
                            class="form-control"></div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-gold w-100">Create Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection