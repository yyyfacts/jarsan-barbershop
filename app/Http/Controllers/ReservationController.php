<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\Barber; // TAMBAHAN: Jangan lupa import model Barber
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// IMPORT UNTUK EXCEL
use App\Exports\ReservationsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReservationController extends Controller
{
    // --- USER: FORM BOOKING ---
    public function create()
    {
        // Ambil data service yang aktif
        $services = Service::where('is_active', 1)->get();
        
        // TAMBAHAN: Ambil data barber untuk ditampilkan di pilihan
        $barbers = Barber::all(); 

        // Kirim $services DAN $barbers ke view
        // Pastikan nama view sesuai dengan lokasi file Anda (misal: 'user.reservasi' atau 'reservasi')
        return view('
        reservasi', compact('services', 'barbers')); 
    }

    // --- USER: KIRIM DATA ---
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'service_id' => 'required|exists:services,id', 
            'barber_id' => 'nullable|exists:barbers,id', // TAMBAHAN: Validasi barber (nullable karena bisa pilih 'Any Barber')
            'notes' => 'nullable|string',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),        
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'service_id' => $request->service_id,
            'barber_id' => $request->barber_id, // TAMBAHAN: Simpan ID Barber yang dipilih
            'notes' => $request->notes,
            'status' => 'Pending'           
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dikirim! Menunggu konfirmasi admin.');
    }

    // --- ADMIN: LIHAT DATA ---
    public function index()
    {
        // Menggunakan with('service', 'barber') agar nama barber juga terambil (Eager Loading)
        $reservations = Reservation::with(['service', 'barber'])->latest()->get();
        return view('admin.reservations', compact('reservations'));
    }

    // --- ADMIN: FUNGSI EXPORT EXCEL ---
    public function exportExcel()
    {
        return Excel::download(new ReservationsExport, 'Laporan_Reservasi_' . date('d-m-Y') . '.xlsx');
    }

    // --- ADMIN: GANTI STATUS ---
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        if ($request->has('status')) {
            $reservation->update(['status' => $request->status]);
        } else {
            // Toggle sederhana jika tidak ada input spesifik
            $reservation->status = $reservation->status == 'pending' ? 'done' : 'pending';
            $reservation->save();
        }

        return redirect()->back()->with('success', 'Status diperbarui.');
    }

    // --- ADMIN: HAPUS ---
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        
        return redirect()->back()->with('success', 'Data reservasi dihapus.');
    }
}