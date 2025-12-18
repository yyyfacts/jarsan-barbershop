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
        // Ini view untuk user (tampilan depan)
        return view('pricelist', compact('services'));
    }

    // === BAGIAN ADMIN (BACKEND) ===
    
    // 1. Menampilkan Daftar Layanan di Admin
    public function adminIndex()
    {
        $services = Service::all();
        // PENTING: Mengarah ke file 'resources/views/admin/pricelist.blade.php'
        return view('admin.pricelist', compact('services'));
    }

    // 2. Menampilkan Form Tambah (Kita pakai modal/halaman terpisah jika ada)
    public function create()
    {
        return view('admin.services_create'); // Pastikan file ini ada jika mau pakai halaman terpisah
    }

    // 3. Simpan Layanan Baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        // Upload Gambar
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);

        return redirect()->route('services')->with('success', 'Layanan berhasil ditambahkan!');
    }

    // 4. Form Edit
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        // Pastikan kamu punya file 'resources/views/admin/services_edit.blade.php'
        return view('admin.services_edit', compact('service'));
    }

    // 5. Update Layanan
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
            // Hapus gambar lama
            if ($service->image_path) {
                Storage::disk('public')->delete($service->image_path);
            }
            $data['image_path'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('services')->with('success', 'Layanan berhasil diperbarui!');
    }

    // 6. Hapus Layanan
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        if ($service->image_path) {
            Storage::disk('public')->delete($service->image_path);
        }
        
        $service->delete();

        return redirect()->route('services')->with('success', 'Layanan berhasil dihapus!');
    }
}