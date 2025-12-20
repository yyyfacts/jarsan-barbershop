<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage; // Hapus ini karena tidak dipakai lagi

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
            'image' => 'nullable|string' // Ganti validasi jadi string (URL)
        ]);

        // LANGSUNG SIMPAN URL (Tidak perlu logic upload file)
        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration,
            'description' => $request->description,
            'image_path' => $request->image, // Simpan Link URL-nya
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
            'image' => 'nullable|string' // Ganti jadi string
        ]);

        $updateData = [
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration,
            'description' => $request->description,
        ];

        // Jika ada input link baru, update link-nya
        if ($request->filled('image')) {
            $updateData['image_path'] = $request->image;
        }

        $service->update($updateData);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        // Hapus logika Storage::delete karena kita cuma simpan text URL
        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Layanan dihapus!');
    }
}