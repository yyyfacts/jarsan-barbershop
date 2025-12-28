<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReservationsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Ambil data beserta relasi servicenya
        return Reservation::with('service')->latest()->get();
    }

    // Mengatur judul kolom di Excel
    public function headings(): array
    {
        return [
            'No',
            'Nama Pelanggan',
            'Telepon',
            'Layanan',
            'Tanggal',
            'Jam',
            'Status',
            'Catatan'
        ];
    }

    // Mengatur data apa saja yang muncul di baris Excel
    public function map($reservation): array
    {
        static $no = 1;
        return [
            $no++,
            $reservation->name,
            "'" . $reservation->phone, // Tambahkan petik agar nomor HP tidak berantakan di Excel
            $reservation->service->name ?? '-',
            $reservation->date,
            $reservation->time . ' WIB',
            $reservation->status,
            $reservation->notes ?? '-'
        ];
    }
}