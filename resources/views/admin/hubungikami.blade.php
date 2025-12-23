@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-4">📬 Pesan Masuk dari Pengunjung</h3>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark text-nowrap">
                    <tr>
                        <th class="text-center p-3">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th class="text-nowrap">Waktu</th>
                        <th class="text-center p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="fw-bold text-nowrap">{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td class="text-start" style="min-width: 250px;">{{ Str::limit($contact->message, 80) }}</td>
                        <td class="text-nowrap small text-muted">{{ $contact->created_at->format('d M Y, H:i') }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm shadow-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted fst-italic">Tidak ada pesan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection