<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // === USER ===
    public function index()
    {
        $services = Service::where('is_active', 1)->get();
        return view('pricelist', compact('services'));
    }

    // === ADMIN ===
    public function adminIndex()
    {
        $services = Service::all();
        return view('admin.pricelist', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
            'description' => 'nullable|string',
            // Wajib gambar, max 1MB biar database ga keberatan
            'image' => 'nullable|image|max:1024' 
        ]);

        $imageBase64 = null;
        if ($request->hasFile('image')) {
            // UBAH GAMBAR JADI TEKS BASE64
            $path = $request->file('image')->getRealPath();
            $logo = file_get_contents($path);
            $base64 = base64_encode($logo);
            // Tambahkan header agar browser tahu ini gambar
            $imageBase64 = 'data:image/' . $request->file('image')->extension() . ';base64,' . $base64;
        }

        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration,
            'description' => $request->description,
            'image_path' => $imageBase64, // Simpan kodenya ke DB
            'is_active' => 1
        ]);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:1024'
        ]);

        $updateData = [
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            // UBAH GAMBAR JADI TEKS BASE64
            $path = $request->file('image')->getRealPath();
            $logo = file_get_contents($path);
            $base64 = base64_encode($logo);
            $updateData['image_path'] = 'data:image/' . $request->file('image')->extension() . ';base64,' . $base64;
        }

        $service->update($updateData);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Tinggal hapus row saja, karena gambar nempel di database
        Service::findOrFail($id)->delete();
        return redirect()->route('admin.services')->with('success', 'Layanan dihapus!');
    }
}