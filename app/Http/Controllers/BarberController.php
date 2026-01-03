<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    // === 1. HALAMAN USER (FRONTEND) ===
    public function index()
    {
        // Menampilkan semua barber yang aktif ke halaman pengunjung
        $barbers = Barber::where('is_active', 1)->get();
        return view('barber', compact('barbers'));
    }

    // === 2. HALAMAN ADMIN (CRUD) ===
    public function indexAdmin()
    {
        // Menampilkan semua barber di dashboard admin
        $barbers = Barber::latest()->get();
        
        // Pastikan nama file view sesuai dengan folder kamu:
        // resources/views/admin/barber/index.blade.php
        return view('admin.barber.index', compact('barbers'));
    }

    // === 3. SIMPAN DATA BARU ===
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'specialty' => 'required|string|max:100',
            'bio'       => 'nullable|string',
            'photo'     => 'nullable|image|max:2048', // Max 2MB
            'schedule'  => 'nullable|array' // Validasi array karena di model di-cast
        ]);

        $photoBase64 = null;
        
        // Proses Upload Foto ke Base64
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $photoBase64 = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // Simpan ke Database
        Barber::create([
            'name'       => $request->name,
            'specialty'  => $request->specialty,
            'bio'        => $request->bio,
            'schedule'   => $request->schedule, // Laravel otomatis ubah jadi JSON
            'photo_path' => $photoBase64,
            'is_active'  => 1
        ]);

        return redirect()->back()->with('success', 'Barber berhasil ditambahkan!');
    }

    // === 4. UPDATE DATA ===
    public function update(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'specialty' => 'required|string|max:100',
            'bio'       => 'nullable|string',
            'photo'     => 'nullable|image|max:2048',
            'schedule'  => 'nullable|array'
        ]);

        $updateData = [
            'name'      => $request->name,
            'specialty' => $request->specialty,
            'bio'       => $request->bio,
            'schedule'  => $request->schedule,
        ];

        // Cek jika ada foto baru yang diupload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $updateData['photo_path'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        $barber->update($updateData);

        return redirect()->back()->with('success', 'Data barber berhasil diperbarui!');
    }

    // === 5. HAPUS DATA ===
    public function destroy($id)
    {
        $barber = Barber::findOrFail($id);
        $barber->delete();
        
        return redirect()->back()->with('success', 'Barber berhasil dihapus.');
    }
}