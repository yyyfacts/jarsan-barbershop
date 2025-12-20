<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // --- USER: FORM BOOKING ---
    public function create()
    {
        // Ambil layanan yang aktif
        $services = Service::where('is_active', 1)->get();
        
        // PERBAIKAN 1: Hapus 'user.' jika file ada di resources/views/reservasi.blade.php
        return view('reservasi', compact('services')); 
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
            'notes' => 'nullable|string',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),        
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'service_id' => $request->service_id, 
            'notes' => $request->notes,
            'status' => 'Pending'           
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dikirim! Menunggu konfirmasi admin.');
    }

    // --- ADMIN: LIHAT DATA ---
    public function index()
    {
        // Ini butuh relasi 'service' di Model Reservation (Lihat langkah 2 di bawah)
        $reservations = Reservation::with('service')->latest()->get();
        
        // Pastikan Anda punya file: resources/views/admin/reservations.blade.php
        // Jika error view not found lagi, coba ganti jadi: view('admin.reservations')
        return view('admin.reservations', compact('reservations'));
    }

    // --- ADMIN: GANTI STATUS ---
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        if ($request->has('status')) {
            $reservation->update(['status' => $request->status]);
        } else {
            // Toggle manual jika tidak ada input status
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