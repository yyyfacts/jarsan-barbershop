<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Kita gunakan $fillable agar lebih aman dan jelas
    protected $fillable = [
        'app_name',
        'logo_path',
        'instagram_link', // Kolom baru untuk Instagram
        'tiktok_link',    // Kolom baru untuk TikTok
        'maps_embed',  
        'whatsapp_number',  
        'hero_title',
    'hero_subtitle', // Kolom baru untuk Google Maps
    ];
}