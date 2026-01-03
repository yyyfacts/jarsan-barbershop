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

    // --- PERBAIKAN DI SINI ---
    // Fungsi ini WAJIB ada dan tidak boleh dikomentari 
    // agar 'with([reviews])' di Controller bisa jalan.
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}