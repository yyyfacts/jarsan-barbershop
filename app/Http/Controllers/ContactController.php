<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactDetail; // <--- Import Model Baru
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // ==========================================
    // BAGIAN USER (PENGUNJUNG)
    // ==========================================

    // Simpan Pesan dari Form User
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        Contact::create($data);

        return redirect()->back()->with('success', 'Pesan Anda telah terkirim!');
    }

    // ==========================================
    // BAGIAN ADMIN (DASHBOARD)
    // ==========================================

    // 1. TAMPILKAN HALAMAN ADMIN (Form Edit Info + Tabel Pesan)
    public function index()
    {
        // Ambil daftar pesan masuk (untuk tabel bawah)
        $contacts = Contact::latest()->get();
        
        // Ambil konfigurasi info kontak (untuk form atas)
        // Kita pakai first() karena datanya cuma ada 1 baris
        $config = ContactDetail::first(); 
        
        // Jika null (belum ada data), buat object kosong agar tidak error di view
        if (!$config) {
            $config = new ContactDetail();
        }

        // PERUBAHAN DISINI: Nama view diganti jadi 'admin.contact'
        return view('admin.contact', compact('contacts', 'config'));
    }

    // 2. UPDATE INFO KONTAK (Alamat, WA, Jam Buka, dll)
    public function updateDetails(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'page_title'    => 'nullable|string',
            'page_subtitle' => 'nullable|string',
            'whatsapp'      => 'nullable|string',
            'email'         => 'nullable|email',
            'address'       => 'nullable|string',
            'maps_link'     => 'nullable|string',
            'hours_night'   => 'nullable|string',
            'hours_mon_fri' => 'nullable|string',
            'hours_tue_wed' => 'nullable|string',
            'hours_sat_sun' => 'nullable|string',
        ]);

        // Update data pertama (id 1) atau Buat baru jika belum ada
        ContactDetail::updateOrCreate(
            ['id' => 1], // Cari ID 1
            $data        // Update dengan data baru
        );

        return redirect()->back()->with('success', 'Informasi Kontak berhasil diperbarui!');
    }

    // 3. HAPUS PESAN MASUK
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Pesan dihapus.');
    }
}