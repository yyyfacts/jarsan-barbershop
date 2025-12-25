@extends('layouts.admin')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
    <div>
        <h6 class="text-gold small-caps mb-1">Catalog</h6>
        <h3 class="fw-bold m-0 text-white">Service List</h3>
    </div>
    <button type="button" class="btn btn-gold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahService">
        <i class="bi bi-plus-lg me-1"></i> Add Service
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
                    <th class="w-fit">Img</th>
                    <th>Service Name</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th class="w-fit text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                    <td>
                        @if($service->image_path)
                        <img src="{{ $service->image_path }}" width="50" height="35"
                            class="rounded object-fit-cover border border-secondary">
                        @else
                        <div class="rounded border border-secondary d-flex align-items-center justify-content-center bg-dark"
                            style="width: 50px; height: 35px;">
                            <i class="bi bi-image text-muted small"></i>
                        </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-bold text-white">{{ $service->name }}</div>
                        <div class="text-muted small text-truncate" style="max-width: 200px;">
                            {{ $service->description }}</div>
                    </td>
                    <td class="text-muted">{{ $service->duration_minutes }} Mins</td>
                    <td class="text-gold font-serif fw-bold">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <button class="btn btn-icon text-white" data-bs-toggle="modal"
                                data-bs-target="#modalEditService{{ $service->id }}"><i
                                    class="bi bi-pencil-square"></i></button>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-icon text-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="modalEditService{{ $service->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-serif">Edit Service</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3"><label class="text-muted small mb-1">Name</label><input
                                            type="text" name="name" class="form-control" value="{{ $service->name }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3"><label class="text-muted small mb-1">Price
                                                (Rp)</label><input type="number" name="price" class="form-control"
                                                value="{{ $service->price }}"></div>
                                        <div class="col-6 mb-3"><label class="text-muted small mb-1">Duration
                                                (Min)</label><input type="number" name="duration" class="form-control"
                                                value="{{ $service->duration_minutes }}"></div>
                                    </div>
                                    <div class="mb-3"><label class="text-muted small mb-1">Description</label><textarea
                                            name="description" class="form-control"
                                            rows="3">{{ $service->description }}</textarea></div>
                                    <div class="mb-3"><label class="text-muted small mb-1">Image</label><input
                                            type="file" name="image" class="form-control"></div>
                                </div>
                                <div class="modal-footer border-0"><button type="submit" class="btn btn-gold w-100">Save
                                        Update</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">No services found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambahService" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-serif">Add New Service</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3"><label class="text-muted small mb-1">Name</label><input type="text" name="name"
                            class="form-control" required></div>
                    <div class="row">
                        <div class="col-6 mb-3"><label class="text-muted small mb-1">Price (Rp)</label><input
                                type="number" name="price" class="form-control" required></div>
                        <div class="col-6 mb-3"><label class="text-muted small mb-1">Duration (Min)</label><input
                                type="number" name="duration" class="form-control"></div>
                    </div>
                    <div class="mb-3"><label class="text-muted small mb-1">Description</label><textarea
                            name="description" class="form-control" rows="3"></textarea></div>
                    <div class="mb-3"><label class="text-muted small mb-1">Image</label><input type="file" name="image"
                            class="form-control"></div>
                </div>
                <div class="modal-footer border-0"><button type="submit" class="btn btn-gold w-100">Create
                        Service</button></div>
            </form>
        </div>
    </div>
</div>
@endsection