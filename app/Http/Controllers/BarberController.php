<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    // === BAGIAN ADMIN (BACKEND) ===
    
    // 1. ADMIN: LIST BARBER
    public function index()
    {
        // Ambil semua data barber
        $barbers = Barber::all();
        
        // PERBAIKAN DISINI: 
        // Arahkan ke folder 'admin', file 'barberman.blade.php'
        return view('admin.barberman', compact('barbers'));
    }

    // 2. ADMIN: SIMPAN BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialty' => 'nullable',
            'bio' => 'nullable',
            'photo' => 'nullable|image|max:1024' // Validasi gambar max 1MB
        ]);

        $photoBase64 = null;
        if ($request->hasFile('photo')) {
            // Ubah gambar jadi teks kode (Base64) agar bisa disimpan di database
            $path = $request->file('photo')->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $photoBase64 = 'data:image/' . $request->file('photo')->extension() . ';base64,' . $base64;
        }

        Barber::create([
            'name' => $request->name,
            'specialty' => $request->specialty,
            'bio' => $request->bio,
            'photo_path' => $photoBase64, // Simpan kodenya ke DB
            'is_active' => 1
        ]);

        return redirect()->back()->with('success', 'Barber berhasil ditambahkan');
    }

    // 3. ADMIN: UPDATE
    public function update(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'specialty' => 'nullable',
            'bio' => 'nullable',
            'photo' => 'nullable|image|max:1024'
        ]);

        $updateData = [
            'name' => $request->name,
            'specialty' => $request->specialty,
            'bio' => $request->bio,
        ];

        if ($request->hasFile('photo')) {
            // Ubah foto baru jadi teks Base64
            $path = $request->file('photo')->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $updateData['photo_path'] = 'data:image/' . $request->file('photo')->extension() . ';base64,' . $base64;
        }

        $barber->update($updateData);

        return redirect()->back()->with('success', 'Data diperbarui');
    }

    // 4. ADMIN: HAPUS
    public function destroy($id)
    {
        $barber = Barber::findOrFail($id);
        $barber->delete();

        return redirect()->back()->with('success', 'Barber dihapus');
    }
}