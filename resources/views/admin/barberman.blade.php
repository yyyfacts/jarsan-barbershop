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
<div class="alert alert-dark border-0 shadow-sm text-center mb-4"
    style="border-left: 4px solid var(--gold-accent) !important;">
    <span class="text-gold">{{ session('success') }}</span>
</div>
@endif

<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th>PROFILE</th>
                        <th>NAME</th>
                        <th>SPECIALTY</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barbers as $barber)
                    <tr>
                        <td class="text-center text-secondary">{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ $barber->photo_path ?? 'https://ui-avatars.com/api/?name='.urlencode($barber->name).'&background=D4AF37&color=000' }}"
                                width="50" height="50" class="rounded-circle object-fit-cover border border-secondary">
                        </td>
                        <td class="fw-bold text-white">{{ $barber->name }}</td>
                        <td class="text-secondary">{{ $barber->specialty }}</td>
                        <td class="text-center"><span
                                class="badge border border-success text-success bg-transparent rounded-0 px-3">ACTIVE</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-outline-light rounded-0" data-bs-toggle="modal"
                                    data-bs-target="#modalEditBarber{{ $barber->id }}">EDIT</button>
                                <form action="{{ route('admin.barbers.destroy', $barber->id) }}" method="POST"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-0">DEL</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEditBarber{{ $barber->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Barber</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.barbers.update', $barber->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body text-start" style="white-space: normal;">
                                        <div class="mb-3"><label
                                                class="form-label text-secondary small">NAME</label><input type="text"
                                                name="name" class="form-control" value="{{ $barber->name }}"></div>
                                        <div class="mb-3"><label
                                                class="form-label text-secondary small">SPECIALTY</label><input
                                                type="text" name="specialty" class="form-control"
                                                value="{{ $barber->specialty }}"></div>
                                        <div class="mb-3"><label
                                                class="form-label text-secondary small">BIO</label><textarea name="bio"
                                                class="form-control" rows="3">{{ $barber->bio }}</textarea></div>
                                        <div class="mb-3"><label
                                                class="form-label text-secondary small">PHOTO</label><input type="file"
                                                name="photo" class="form-control"></div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="submit" class="btn btn-gold">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-secondary">No data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahBarber" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Barber</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>