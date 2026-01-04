<?php

namespace App\Http\Controllers;

use App\Models\Service; // Cuma pakai Model ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // Path file penyimpanan setting (tanpa database)
    private $settingsPath = 'settings/service-page.json';

    // === 1. HALAMAN ADMIN (MANAJEMEN) ===
    public function adminIndex()
    {
        // 1. Ambil Data Service dari DB
        $services = Service::all();

        // 2. Ambil Data Setting Halaman dari File JSON
        // Jika file belum ada, kita buat data default kosong
        $pageConfig = $this->getSettings();

        return view('admin.pricelist', compact('services', 'pageConfig'));
    }

    // === 2. UPDATE TAMPILAN HALAMAN (JUDUL & BG) ===
    public function updatePageConfig(Request $request)
    {
        $request->validate([
            'pricelist_title'       => 'nullable|string|max:100',
            'pricelist_subtitle'    => 'nullable|string|max:100',
            'pricelist_description' => 'nullable|string|max:500',
            'pricelist_bg'          => 'nullable|image|max:2048'
        ]);

        // Ambil settingan lama
        $currentSettings = $this->getSettings();

        // Siapkan data baru
        $dataToSave = [
            'pricelist_title'       => $request->pricelist_title,
            'pricelist_subtitle'    => $request->pricelist_subtitle,
            'pricelist_description' => $request->pricelist_description,
            'pricelist_bg_path'     => $currentSettings->pricelist_bg_path ?? null, // Default pake yg lama
        ];

        // Proses Ganti Background (Base64)
        if ($request->hasFile('pricelist_bg')) {
            $file = $request->file('pricelist_bg');
            $base64 = base64_encode(file_get_contents($file->getRealPath()));
            $dataToSave['pricelist_bg_path'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // Simpan ke file JSON
        Storage::put($this->settingsPath, json_encode($dataToSave));

        return redirect()->back()->with('success', 'Tampilan halaman berhasil diperbarui!');
    }

    // === HELPER: AMBIL SETTING DARI JSON ===
    private function getSettings()
    {
        if (Storage::exists($this->settingsPath)) {
            return json_decode(Storage::get($this->settingsPath));
        }

        // Default jika file belum ada
        return (object) [
            'pricelist_title' => 'SERVICE MENU',
            'pricelist_subtitle' => 'CURATED GROOMING',
            'pricelist_description' => 'Layanan perawatan rambut terbaik...',
            'pricelist_bg_path' => null
        ];
    }

    // ==========================================
    // CRUD SERVICE (TETAP SAMA SEPERTI SEBELUMNYA)
    // ==========================================

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
            'image' => 'nullable|image|max:1024',
            'description' => 'nullable|string'
        ]);

        $imageBase64 = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $base64 = base64_encode(file_get_contents($file->getRealPath()));
            $imageBase64 = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration,
            'description' => $request->description,
            'image_path' => $imageBase64,
            'is_active' => 1
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
            'image' => 'nullable|image|max:1024',
            'description' => 'nullable|string'
        ]);

        $updateData = [
            'name' => $request->name,
            'price' => $request->price,
            'duration_minutes' => $request->duration,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $base64 = base64_encode(file_get_contents($file->getRealPath()));
            $updateData['image_path'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        $service->update($updateData);
        
        return redirect()->back()->with('success', 'Layanan diperbarui!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        
        return redirect()->back()->with('success', 'Layanan dihapus!');
    }
}