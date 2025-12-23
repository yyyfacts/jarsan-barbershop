@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-5 text-white">Incoming Messages</h3>

<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center py-4">NO</th>
                        <th class="py-4">SENDER</th>
                        <th class="py-4">MESSAGE</th>
                        <th class="py-4 text-nowrap">DATE</th>
                        <th class="text-center py-4">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-white">{{ $contact->name }}</div>
                            <div class="small text-muted">{{ $contact->email }}</div>
                        </td>
                        <td class="text-muted">{{ Str::limit($contact->message, 100) }}</td>
                        <td class="text-nowrap small text-muted">{{ $contact->created_at->format('d M Y, H:i') }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-0">DEL</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No messages.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection