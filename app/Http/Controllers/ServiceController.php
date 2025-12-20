<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // === BAGIAN USER (FRONTEND) ===
    public function index()
    {
        $services = Service::all();
        return view('pricelist', compact('services'));
    }

    // === BAGIAN ADMIN (BACKEND) ===
    
    // 1. ADMIN: LIST LAYANAN
    public function adminIndex()
    {
        $services = Service::all();
        return view('admin.pricelist', compact('services'));
    }

    // 2. ADMIN: SIMPAN BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
        }

        // PERBAIKAN DISINI: Mapping 'duration' ke 'duration_minutes'
        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration, // INI KUNCINYA
            'description' => $request->description,
            'image_path' => $imagePath,
            'is_active' => 1
        ]);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan!');
    }

    // 3. ADMIN: UPDATE
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $updateData = [
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration, // UPDATE JUGA DISINI
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($service->image_path) {
                Storage::disk('public')->delete($service->image_path);
            }
            $updateData['image_path'] = $request->file('image')->store('services', 'public');
        }

        $service->update($updateData);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui!');
    }

    // 4. ADMIN: HAPUS
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        if ($service->image_path) {
            Storage::disk('public')->delete($service->image_path);
        }
        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Layanan dihapus!');
    }
}