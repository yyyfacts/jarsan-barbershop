<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $table = 'barbers';

    /**
     * KHUSUS DATA ORANG/KAPSTER
     * Jangan masukkan judul halaman web di sini.
     */
    protected $fillable = [
        'name',
        'specialty',
        'bio',
        'schedule',   // Jadwal (JSON)
        'photo_path', // Foto
        'is_active',  // Status Aktif
    ];

    protected $casts = [
        'schedule' => 'array',
        'is_active' => 'boolean',
    ];

    // Relasi Review (Opsional)
    /*
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    */
}