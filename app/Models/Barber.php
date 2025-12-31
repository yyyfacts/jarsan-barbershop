<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Daftar kolom yang boleh diisi secara massal (create/update)
     */
    protected $fillable = [
        'name',
        'specialty',
        'bio',
        'schedule',   // PENTING: Kolom jadwal kerja (JSON)
        'photo_path', // Foto Base64
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     * Mengubah tipe data otomatis saat diambil dari database
     */
    protected $casts = [
        // PENTING: Ini agar data di kolom 'schedule' otomatis diubah 
        // dari JSON (Database) menjadi Array (PHP) dan sebaliknya.
        'schedule' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * RELASI KE TABLE REVIEWS
     * Wajib ada agar bisa memanggil $barber->reviews di halaman reservasi
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}