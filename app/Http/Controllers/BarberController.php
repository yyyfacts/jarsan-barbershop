<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    // ADMIN: LIST BARBER
    public function index()
    {
        $barbers = Barber::all();
        return view('admin.barberman', compact('barbers'));
    }

    // ADMIN: SIMPAN BARU (UBAH JADI SIMPAN LINK)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'specialty' => 'nullable',
            'bio' => 'nullable',
            'photo' => 'nullable|string' // Ubah validasi jadi string biasa
        ]);

        // LOGIC UPLOAD DIHAPUS, karena Vercel menolak file upload.
        // Data 'photo' langsung tersimpan sebagai link dari input text.

        Barber::create($data);
        
        return redirect()->route('admin.barbers.index')->with('success', 'Barber berhasil ditambahkan');
    }

    // ADMIN: UPDATE (UBAH JADI UPDATE LINK)
    public function update(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'specialty' => 'nullable',
            'bio' => 'nullable',
            'photo' => 'nullable|string'
        ]);

        // LOGIC HAPUS FILE LAMA DIHAPUS JUGA

        $barber->update($data);
        
        return redirect()->route('admin.barbers.index')->with('success', 'Data diperbarui');
    }

    // ADMIN: HAPUS
    public function destroy($id)
    {
        $barber = Barber::findOrFail($id);
        // Hapus logic Storage::delete karena kita cuma simpan link
        $barber->delete();
        
        return redirect()->back()->with('success', 'Barber dihapus');
    }
}