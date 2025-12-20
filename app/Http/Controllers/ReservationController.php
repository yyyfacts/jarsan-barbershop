<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk ambil ID User

class ReservationController extends Controller
{
    // USER: FORM BOOKING
    public function create()
    {
        // Ambil data service yang aktif saja
        $services = Service::where('is_active', 1)->get();
        
        // Pastikan nama view sesuai dengan file blade kamu (user.reservasi atau reservasi)
        // Berdasarkan kode blade kamu di atas, sepertinya file view-nya ada di root views
        return view('user.reservasi', compact('services')); 
    }

    // USER: KIRIM DATA
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'service_id' => 'required|exists:services,id', // Pastikan ID layanan valid
            'notes' => 'nullable|string',
        ]);

        // Simpan ke Database
        Reservation::create([
            'user_id' => Auth::id(),        // Simpan ID user yang sedang login
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'service_id' => $request->service_id, // PERBAIKAN UTAMA: Pakai service_id, BUKAN service_name
            'notes' => $request->notes,
            'status' => 'Pending'           // Default status huruf besar awal biar rapi
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dikirim! Menunggu konfirmasi admin.');
    }

    // ADMIN: LIHAT DATA
    public function index()
    {
        // Menggunakan with('service') agar nama layanan bisa muncul di tabel admin
        $reservations = Reservation::with('service')->latest()->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    // ADMIN: GANTI STATUS
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        // Update status sesuai input dari tombol/form di admin
        // Jika request status kosong, lakukan toggle sederhana
        if ($request->has('status')) {
            $reservation->update(['status' => $request->status]);
        } else {
            $reservation->status = $reservation->status == 'pending' ? 'done' : 'pending';
            $reservation->save();
        }

        return redirect()->back()->with('success', 'Status diperbarui.');
    }

    // ADMIN: HAPUS
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        
        return redirect()->back()->with('success', 'Data reservasi dihapus.');
    }
}