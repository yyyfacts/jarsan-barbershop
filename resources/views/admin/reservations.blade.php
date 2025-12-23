@extends('layouts.admin')

@section('content')
<div class="mb-5">
    <h3 class="fw-bold text-white">Client Reservations</h3>
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
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center py-4">NO</th>
                        <th class="py-4">CLIENT</th>
                        <th class="py-4">SERVICE</th>
                        <th class="py-4">SCHEDULE</th>
                        <th class="text-center py-4">STATUS</th>
                        <th class="text-center py-4">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $res)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-white">{{ $res->name }}</div>
                            <small class="text-muted">{{ $res->phone }}</small>
                        </td>
                        <td><span class="text-white">{{ $res->service->name ?? '-' }}</span></td>
                        <td>
                            <div class="text-gold">{{ \Carbon\Carbon::parse($res->date)->format('d M Y') }}</div>
                            <small class="text-muted">{{ $res->time }}</small>
                        </td>
                        <td class="text-center">
                            @if(strtolower($res->status) == 'pending')
                            <span
                                class="badge border border-warning text-warning bg-transparent rounded-0 px-3">PENDING</span>
                            @else
                            <span
                                class="badge border border-success text-success bg-transparent rounded-0 px-3">DONE</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <form action="{{ route('admin.reservations.status', $res->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status"
                                        value="{{ strtolower($res->status) == 'pending' ? 'done' : 'pending' }}">
                                    <button
                                        class="btn btn-sm {{ strtolower($res->status) == 'pending' ? 'btn-outline-success' : 'btn-outline-secondary' }} rounded-0">
                                        {{ strtolower($res->status) == 'pending' ? '✓' : '↺' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.reservations.destroy', $res->id) }}" method="POST"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-0">✕</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">No reservations.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection