<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
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
            'image' => 'nullable|image|max:1024' // Batas 1MB biar DB Cloud aman
        ]);

        $imageBase64 = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->getRealPath();
            $fileData = file_get_contents($path);
            $base64 = base64_encode($fileData);
            // Simpan format base64 lengkap
            $imageBase64 = 'data:image/' . $request->file('image')->extension() . ';base64,' . $base64;
        }

        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration, // Sesuaikan nama kolom DB
            'description' => $request->description,
            'image_path' => $imageBase64,
            'is_active' => 1
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $updateData = [
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->getRealPath();
            $base64 = base64_encode(file_get_contents($path));
            $updateData['image_path'] = 'data:image/' . $request->file('image')->extension() . ';base64,' . $base64;
        }

        $service->update($updateData);
        return redirect()->back()->with('success', 'Layanan diperbarui!');
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Layanan dihapus!');
    }
}