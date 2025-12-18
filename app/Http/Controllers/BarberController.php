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

    // ADMIN: SIMPAN BARU (LINK)
    public function store(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'name' => 'required',
            'specialty' => 'nullable',
            'bio' => 'nullable',
            'photo_path' => 'nullable|string' // GANTI JADI photo_path
        ]);

        Barber::create($data);
        
        return redirect()->route('admin.barbers.index')->with('success', 'Barber berhasil ditambahkan');
    }

    // ADMIN: UPDATE (LINK)
    public function update(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required',
            'specialty' => 'nullable',
            'bio' => 'nullable',
            'photo_path' => 'nullable|string' // GANTI JADI photo_path
        ]);

        $barber->update($data);
        
        return redirect()->route('admin.barbers.index')->with('success', 'Data diperbarui');
    }

    // ADMIN: HAPUS
    public function destroy($id)
    {
        $barber = Barber::findOrFail($id);
        $barber->delete();
        
        return redirect()->back()->with('success', 'Barber dihapus');
    }
}