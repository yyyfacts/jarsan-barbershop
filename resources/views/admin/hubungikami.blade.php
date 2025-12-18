@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-4 text-center">📬 Pesan Masuk dari Pengunjung</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Dikirim</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td class="text-start">{{ Str::limit($contact->message, 50) }}</td>
                    <td>{{ $contact->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                            onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted py-4">Tidak ada pesan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection