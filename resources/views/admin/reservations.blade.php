@extends('layouts.admin')

@section('content')
<div class="text-center mb-4">
    <h3 class="fw-bold">Daftar Reservasi Pelanggan</h3>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped m-0 align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Layanan</th>
                    <th>Tanggal & Jam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>alex</td>
                    <td>08999999</td>
                    <td>HAIR SMOOTH</td>
                    <td class="text-center">20/11/2025<br><small>19:30</small></td>
                    <td class="text-center"><span class="badge bg-warning text-dark">Pending</span></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Inra Sepriadi</td>
                    <td>089601620705</td>
                    <td>BLEACHING</td>
                    <td class="text-center">15/11/2025<br><small>15:00</small></td>
                    <td class="text-center"><span class="badge bg-success">Done</span></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection