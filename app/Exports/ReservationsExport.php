<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // TAMBAHKAN INI
use Maatwebsite\Excel\Concerns\WithStyles; // TAMBAHKAN INI UNTUK DESAIN
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReservationsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
    * Mengambil data dari database
    */
    public function collection()
    {
        return Reservation::with('service')->latest()->get();
    }

    /**
    * Header kolom
    */
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

    /**
    * Mapping data
    */
    public function map($reservation): array
    {
        static $no = 1;
        return [
            $no++,
            $reservation->name,
            "'" . $reservation->phone, // Tetap gunakan petik agar nol di depan tidak hilang
            $reservation->service->name ?? '-',
            \Carbon\Carbon::parse($reservation->date)->format('d-m-Y'),
            $reservation->time . ' WIB',
            ucfirst($reservation->status),
            $reservation->notes ?? '-',
        ];
    }

    /**
    * Memberikan styling otomatis (Borders & Bold Header)
    */
    public function styles(Worksheet $sheet)
    {
        return [
            // Membuat Baris 1 (Header) menjadi Bold
            1    => ['font' => ['bold' => true]],

            // Opsional: Memberikan border ke seluruh tabel yang ada isinya
            'A1:H100' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }
}