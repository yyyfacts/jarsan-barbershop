<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    // USER: LIHAT DAFTAR BARBER (FRONTEND)
    public function index()
    {
        $barbers = Barber::where('is_active', 1)->get();
        return view('barberman', compact('barbers')); 
    }

    // ADMIN: LIST BARBER
    // (Jika kamu punya method index admin terpisah, sesuaikan saja)
    
    // ADMIN: SIMPAN BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialty' => 'nullable',
            'bio' => 'nullable',
            // Validasi gambar max 1MB (biar database ga berat)
            'photo' => 'nullable|image|max:1024' 
        ]);

        $photoBase64 = null;
        if ($request->hasFile('photo')) {
            // MAGIC NYA DISINI: Ubah file jadi teks kode
            $path = $request->file('photo')->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $photoBase64 = 'data:image/' . $request->file('photo')->extension() . ';base64,' . $base64;
        }

        Barber::create([
            'name' => $request->name,
            'specialty' => $request->specialty,
            'bio' => $request->bio,
            'photo_path' => $photoBase64, // Simpan teks panjang ini ke DB
            'is_active' => 1
        ]);

        return redirect()->back()->with('success', 'Barber berhasil ditambahkan');
    }

    // ADMIN: UPDATE
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
            // MAGIC UPDATE: Ubah foto baru jadi teks
            $path = $request->file('photo')->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $updateData['photo_path'] = 'data:image/' . $request->file('photo')->extension() . ';base64,' . $base64;
        }

        $barber->update($updateData);

        return redirect()->back()->with('success', 'Data diperbarui');
    }

    // ADMIN: HAPUS
    public function destroy($id)
    {
        // Gak perlu hapus file di storage, cukup hapus baris di DB
        $barber = Barber::findOrFail($id);
        $barber->delete();

        return redirect()->back()->with('success', 'Barber dihapus');
    }
}