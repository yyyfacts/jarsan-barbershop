<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'duration' => 'nullable|integer', // Nama di form html
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
        }

        // SIMPAN KE DATABASE
        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration, // Mapping: input 'duration' -> kolom 'duration_minutes'
            'description' => $request->description,
            'image_path' => $imagePath,
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