@extends('layouts.admin')

@section('content')
<div class="mb-5">
    <h6 class="text-gold small-caps mb-1">Bookings</h6>
    <h3 class="fw-bold m-0 text-white">Client Reservations</h3>
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
                    <th>Client Details</th>
                    <th>Service</th>
                    <th>Schedule</th>
                    <th class="w-fit text-center">Status</th>
                    <th class="w-fit text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $res)
                <tr>
                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                    <td>
                        <div class="fw-bold text-white">{{ $res->name }}</div>
                        <div class="small text-muted"><i class="bi bi-telephone me-1"></i>{{ $res->phone }}</div>
                    </td>
                    <td><span
                            class="badge bg-secondary bg-opacity-25 text-white fw-normal border border-secondary border-opacity-25">{{ $res->service->name ?? '-' }}</span>
                    </td>
                    <td>
                        <div class="text-gold fw-medium">{{ \Carbon\Carbon::parse($res->date)->format('d M Y') }}</div>
                        <div class="small text-muted">{{ $res->time }}</div>
                    </td>
                    <td class="text-center">
                        @if(strtolower($res->status) == 'pending')
                        <span
                            class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3 py-2">Pending</span>
                        @else
                        <span
                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">Finished</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <form action="{{ route('admin.reservations.status', $res->id) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="status"
                                    value="{{ strtolower($res->status) == 'pending' ? 'done' : 'pending' }}">
                                <button
                                    class="btn btn-sm {{ strtolower($res->status) == 'pending' ? 'btn-outline-success' : 'btn-outline-secondary' }} btn-icon rounded-circle"
                                    title="Toggle Status">
                                    <i
                                        class="bi {{ strtolower($res->status) == 'pending' ? 'bi-check-lg' : 'bi-arrow-counterclockwise' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.reservations.destroy', $res->id) }}" method="POST"
                                onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger btn-icon rounded-circle" title="Delete">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">No reservations found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection