@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-5 text-white">Incoming Messages</h3>

<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th>SENDER</th>
                        <th>MESSAGE CONTENT</th>
                        <th>DATE RECEIVED</th>
                        <th class="text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td class="text-center text-white">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-white">{{ $contact->name }}</div>
                            <div class="small" style="color: #AAA;">{{ $contact->email }}</div>
                        </td>
                        <td style="min-width: 300px; white-space: normal; color: #DDDDDD;">
                            {{ Str::limit($contact->message, 80) }}
                        </td>
                        <td class="small" style="color: var(--gold-accent);">
                            {{ $contact->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                onsubmit="return confirm('Delete message?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-0">DELETE</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-white">No messages in inbox.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection