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
            'photo' => 'nullable|image|max:1024'
        ]);

        $photoBase64 = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->getRealPath();
            $base64 = base64_encode(file_get_contents($path));
            $photoBase64 = 'data:image/' . $request->file('photo')->extension() . ';base64,' . $base64;
        }

        Barber::create([
            'name' => $request->name,
            'specialty' => $request->specialty,
            'bio' => $request->bio,
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
            'photo' => 'nullable|image|max:1024'
        ]);

        $updateData = [
            'name' => $request->name,
            'specialty' => $request->specialty,
            'bio' => $request->bio,
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