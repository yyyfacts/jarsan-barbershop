<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\About; // <--- WAJIB IMPORT INI
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // === 1. HALAMAN ADMIN (MANAJEMEN) ===
    public function adminIndex()
    {
        // Ambil semua data layanan
        $services = Service::all();

        // Ambil data pengaturan teks (Judul Halaman) dari tabel abouts
        // INI PENTING AGAR FORM EDIT JUDUL DI ADMIN TIDAK ERROR
        $about = About::first(); 

        return view('admin.pricelist', compact('services', 'about'));
    }

    // === 2. SIMPAN DATA BARU ===
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'      => 'required|string|max:255',
            'price'     => 'required|numeric',
            'duration'  => 'nullable|integer',
            'image'     => 'nullable|image|max:1024', // Max 1MB
            'description' => 'nullable|string'
        ]);

        $imageBase64 = null;
        
        // Proses Upload Foto ke Base64
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->getRealPath();
            $fileData = file_get_contents($path);
            $base64 = base64_encode($fileData);
            $imageBase64 = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // Simpan ke Database
        Service::create([
            'name'             => $request->name,
            'price'            => $request->price,
            'duration_minutes' => $request->duration, // Pastikan nama kolom di DB 'duration_minutes'
            'description'      => $request->description,
            'image_path'       => $imageBase64,
            'is_active'        => 1
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil ditambah!');
    }

    // === 3. UPDATE DATA ===
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        // TAMBAHKAN VALIDASI DI SINI (PENTING)
        $request->validate([
            'name'      => 'required|string|max:255',
            'price'     => 'required|numeric',
            'duration'  => 'nullable|integer',
            'image'     => 'nullable|image|max:1024',
            'description' => 'nullable|string'
        ]);

        $updateData = [
            'name'             => $request->name,
            'price'            => $request->price,
            'duration_minutes' => $request->duration,
            'description'      => $request->description,
        ];

        // Cek jika ada foto baru
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->getRealPath();
            $base64 = base64_encode(file_get_contents($path));
            $updateData['image_path'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        $service->update($updateData);
        
        return redirect()->back()->with('success', 'Layanan diperbarui!');
    }

    // === 4. HAPUS DATA ===
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        
        return redirect()->back()->with('success', 'Layanan dihapus!');
    }
}