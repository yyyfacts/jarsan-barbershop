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
        // Ini view buat Pengunjung (bukan admin)
        $services = Service::all();
        return view('pricelist', compact('services'));
    }

    // === BAGIAN ADMIN (BACKEND) ===
    
    // 1. ADMIN: LIST LAYANAN
    public function adminIndex()
    {
        $services = Service::all();
        // PERBAIKAN: Langsung ke file 'admin/pricelist.blade.php'
        return view('admin.pricelist', compact('services'));
    }

    // 2. ADMIN: SIMPAN BARU
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);

        // Redirect balik ke list admin
        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan!');
    }

    // 3. ADMIN: UPDATE
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($service->image_path) {
                Storage::disk('public')->delete($service->image_path);
            }
            $data['image_path'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);

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