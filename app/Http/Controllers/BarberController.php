<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\About; // <--- WAJIB: Import Model About untuk pengaturan judul
use Illuminate\Http\Request;

class BarberController extends Controller
{
    // === 1. HALAMAN USER (FRONTEND) ===
    public function index()
    {
        // Ambil data barber yang aktif
        $barbers = Barber::where('is_active', 1)->get();
        
        // Ambil data pengaturan teks (Judul Halaman) dari tabel abouts
        $pageConfig = About::first(); 

        // Pastikan nama view sesuai dengan file di resources/views/barberman.blade.php
        return view('barberman', compact('barbers', 'pageConfig'));
    }

    // === 2. HALAMAN ADMIN (MANAJEMEN) ===
    public function indexAdmin()
    {
        // Ambil semua data barber urut dari yang terbaru
        $barbers = Barber::latest()->get();
        
        // Ambil data settings (untuk form edit judul di bagian atas admin)
        $about = About::first(); 

        // Arahkan ke view admin: resources/views/admin/barberman.blade.php
        return view('admin.barberman', compact('barbers', 'about'));
    }

    // === 3. SIMPAN DATA BARBER BARU ===
    public function store(Request $request)
    {
        // Validasi input khusus untuk Data Barber
        $request->validate([
            'name'      => 'required|string|max:255',
            'specialty' => 'required|string|max:100',
            'bio'       => 'nullable|string',
            'photo'     => 'nullable|image|max:2048', // Max 2MB
            'schedule'  => 'nullable|array',
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

        // Simpan Barber ke Database
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

    // === 4. UPDATE DATA BARBER ===
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

    // === 5. HAPUS DATA BARBER ===
    public function destroy($id)
    {
        $barber = Barber::findOrFail($id);
        $barber->delete();
        
        return redirect()->back()->with('success', 'Barber berhasil dihapus.');
    }
}