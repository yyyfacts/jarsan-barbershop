<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Service; // <--- Nanti kalau sudah punya Model, aktifkan baris ini

class ServiceController extends Controller
{
    // 1. Tampilkan Halaman Form Upload
    public function create()
    {
        // Pastikan kamu nanti bikin file: resources/views/upload.blade.php
        return view('upload'); 
    }

    // 2. Proses Simpan Foto ke Cloudinary
    public function store(Request $request)
    {
        // Validasi (Wajib ada file foto)
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // --- INI BAGIAN AJAIBNYA ---
        // Upload langsung ke Cloudinary ke folder 'jarsan_barbershop'
        $upload = $request->file('foto')->storeOnCloudinary('jarsan_barbershop');
        
        // Ambil Link Gambar (https://...) buat disimpan di database
        $linkGambar = $upload->getSecurePath();
        
        // Cek hasilnya di layar (Sementara)
        return "Berhasil Upload! Link fotomu ada di: " . $linkGambar;
        
        // Nanti kalau database sudah siap, baris return di atas diganti jadi:
        /*
        Service::create([
            'nama' => $request->nama,
            'foto' => $linkGambar
        ]);
        return redirect()->back();
        */
    }
}