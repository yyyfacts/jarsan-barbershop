<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarberController extends Controller
{
    // ADMIN: LIST BARBER
    public function index()
    {
        $barbers = Barber::all();
        return view('admin.barberman', compact('barbers'));
    }

    // ADMIN: FORM TAMBAH
    public function create()
    {
        return view('admin.barbers.create');
    }

    // ADMIN: SIMPAN BARU
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'specialty' => 'nullable',
            'bio' => 'nullable',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('barbers', 'public');
        }

        Barber::create($data);
        return redirect()->route('admin.barberman')->with('success', 'Barber berhasil ditambahkan');
    }

    // ADMIN: FORM EDIT
    public function edit($id)
    {
        $barber = Barber::findOrFail($id);
        return view('admin.barbers.edit', compact('barber'));
    }

    // ADMIN: UPDATE
    public function update(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'specialty' => 'nullable',
            'bio' => 'nullable',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            if ($barber->photo_path) Storage::disk('public')->delete($barber->photo_path);
            $data['photo_path'] = $request->file('photo')->store('barbers', 'public');
        }

        $barber->update($data);
        return redirect()->route('admin.barberman')->with('success', 'Data diperbarui');
    }

    // ADMIN: HAPUS
    public function destroy($id)
    {
        $barber = Barber::findOrFail($id);
        if ($barber->photo_path) Storage::disk('public')->delete($barber->photo_path);
        $barber->delete();
        return redirect()->back()->with('success', 'Barber dihapus');
    }
}