@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
    <h3 class="fw-bold m-0 text-white">Service Pricelist</h3>
    <button type="button" class="btn btn-gold px-4 py-2 w-100 w-md-auto" data-bs-toggle="modal"
        data-bs-target="#modalTambahService">
        + ADD SERVICE
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
                        <th class="py-4">SERVICE NAME</th>
                        <th class="py-4">DURATION</th>
                        <th class="py-4">PRICE</th>
                        <th class="py-4">IMAGE</th>
                        <th class="text-center py-4">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td class="fw-bold text-white">{{ $service->name }}</td>
                        <td class="text-muted">{{ $service->duration_minutes }} Mins</td>
                        <td class="text-white"
                            style="font-family: 'Playfair Display'; color: var(--gold-accent) !important;">
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </td>
                        <td>
                            @if($service->image_path)
                            <img src="{{ $service->image_path }}" width="60" height="40"
                                class="rounded object-fit-cover border border-secondary">
                            @else
                            <span class="text-muted small fst-italic">No Image</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-outline-light rounded-0" data-bs-toggle="modal"
                                    data-bs-target="#modalEditService{{ $service->id }}">EDIT</button>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                    onsubmit="return confirm('Delete service?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-0">DEL</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT --}}
                    <div class="modal fade" id="modalEditService{{ $service->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Service</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">SERVICE NAME</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $service->name }}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label class="form-label text-muted small">PRICE (RP)</label>
                                                <input type="number" name="price" class="form-control"
                                                    value="{{ $service->price }}" required>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label text-muted small">DURATION (MIN)</label>
                                                <input type="number" name="duration" class="form-control"
                                                    value="{{ $service->duration_minutes }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">DESCRIPTION</label>
                                            <textarea name="description" class="form-control"
                                                rows="3">{{ $service->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">UPDATE IMAGE</label>
                                            <input type="file" name="image" class="form-control">
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
                        <td colspan="6" class="text-center py-5 text-muted">No services available.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahService" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small">SERVICE NAME</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label text-muted small">PRICE (RP)</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label text-muted small">DURATION (MIN)</label>
                            <input type="number" name="duration" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">DESCRIPTION</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">IMAGE UPLOAD</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-gold">Create Service</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection