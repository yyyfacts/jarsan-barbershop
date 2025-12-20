<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi (mass assignment)
    protected $guarded = ['id'];

    // PERBAIKAN 2: Tambahkan Relasi ke Service
    // Agar perintah Reservation::with('service') di controller bisa jalan
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relasi ke User (Opsional, buat jaga-jaga)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}