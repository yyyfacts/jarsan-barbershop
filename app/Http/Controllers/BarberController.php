<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();
        return view('admin.barberman', compact('barbers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialty' => 'required',
            'photo' => 'nullable|image|max:2048',
            'schedule' => 'nullable|array' // Validasi array untuk jadwal
        ]);

        $photoBase64 = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->getRealPath();
            $base64 = base64_encode(file_get_contents($path));
            $photoBase64 = 'data:image/' . $request->file('photo')->extension() . ';base64,' . $base64;
        }

        // Simpan data
        Barber::create([
            'name' => $request->name,
            'specialty' => $request->specialty,
            'bio' => $request->bio,
            'schedule' => $request->schedule, // Laravel otomatis convert ke JSON karena di-cast di Model
            'photo_path' => $photoBase64,
            'is_active' => 1
        ]);

        return redirect()->back()->with('success', 'Barber berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'specialty' => 'required',
            'photo' => 'nullable|image|max:2048',
            'schedule' => 'nullable|array'
        ]);

        $updateData = [
            'name' => $request->name,
            'specialty' => $request->specialty,
            'bio' => $request->bio,
            'schedule' => $request->schedule, // Update jadwal
        ];

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->getRealPath();
            $base64 = base64_encode(file_get_contents($path));
            $updateData['photo_path'] = 'data:image/' . $request->file('photo')->extension() . ';base64,' . $base64;
        }

        $barber->update($updateData);
        return redirect()->back()->with('success', 'Data barber berhasil diperbarui');
    }

    public function destroy($id)
    {
        Barber::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Barber dihapus');
    }
}