@extends('layouts.admin')

@section('content')
<div class="mb-5">
    <h6 class="text-gold small-caps mb-1">Inbox</h6>
    <h3 class="fw-bold m-0 text-white">Incoming Messages</h3>
</div>

<div class="card border-0 rounded-3 overflow-hidden" style="background-color: #141414;">
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead>
                <tr>
                    <th class="w-fit text-center">#</th>
                    <th style="min-width: 200px;">Sender Details</th>
                    <th>Message Content</th>
                    <th class="w-fit" style="min-width: 150px;">Date Received</th>
                    <th class="w-fit text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr>
                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-dark border border-secondary d-flex align-items-center justify-content-center text-gold fw-bold"
                                style="width: 40px; height: 40px; font-size: 1.2rem;">
                                {{ substr($contact->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-bold text-white">{{ $contact->name }}</div>
                                <div class="small text-muted">{{ $contact->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="p-2 rounded" style="background: rgba(255,255,255,0.03); border: 1px solid #2a2a2a;">
                            <p class="mb-0 text-light small" style="line-height: 1.6;">
                                {{ Str::limit($contact->message, 120) }}
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="text-white small">{{ $contact->created_at->format('d M Y') }}</div>
                        <div class="text-muted small" style="font-size: 0.75rem;">
                            {{ $contact->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                            onsubmit="return confirm('Delete this message permanently?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger btn-icon rounded-circle"
                                title="Delete Message">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                        No new messages found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection