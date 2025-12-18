<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // ==========================================
    // BAGIAN PUBLIK (DILIHAT USER/CUSTOMER)
    // ==========================================
    
    public function index()
    {
        // Ambil semua data layanan dari database
        $services = Service::all();
        
        // Kirim data $services ke view pricelist
        return view('pricelist', compact('services'));
    }

    // ==========================================
    // BAGIAN ADMIN (CRUD)
    // ==========================================

    // 1. Tampilkan Daftar Layanan di Admin
    public function adminIndex()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services')); // Pastikan view ini ada nanti
    }

    // 2. Tampilkan Form Tambah
    public function create()
    {
        return view('admin.services.create');
    }

    // 3. Proses Simpan Data Baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->all();

        // Upload Gambar jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $data['image_path'] = $path;
        }

        Service::create($data);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan!');
    }

    // 4. Tampilkan Form Edit
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    // 5. Proses Update Data
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $data = $request->all();

        // Cek jika ada gambar baru diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama biar ga menuhin server
            if ($service->image_path) {
                Storage::disk('public')->delete($service->image_path);
            }
            $path = $request->file('image')->store('services', 'public');
            $data['image_path'] = $path;
        }

        $service->update($data);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui!');
    }

    // 6. Hapus Data
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