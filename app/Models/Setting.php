<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        // 1. Identitas & Kontak
        'app_name',
        'logo_path',
        'instagram_link',
        'tiktok_link',
        'whatsapp_number',
        'maps_embed',

        // 2. Hero Section (Banner Utama)
        'hero_title',
        'hero_subtitle',
        'hero_btn_text',
        'hero_image', // <--- PENTING: Wajib ada agar gambar bisa tersimpan

        // 3. Services Section (Judul Bagian Layanan)
        'services_subtext', 
        'services_title',   

        // 4. Service Card 1
        'service_1_title',
        'service_1_desc',

        // 5. Service Card 2
        'service_2_title',
        'service_2_desc',

        // 6. Service Card 3
        'service_3_title',
        'service_3_desc',

        // 7. Testimonial Section
        'testimonial_title',
    ];
}