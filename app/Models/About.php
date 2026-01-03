<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional, tapi bagus untuk kepastian)
    protected $table = 'abouts';

    // Mendaftarkan semua kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        // 1. Hero Section (Banner Atas)
        'hero_title',
        'hero_subtitle',

        // 2. History Section (Sejarah)
        'history',
        'history_image',
        'founded_year',
        'founded_text',

        // 3. Mission Section (Visi Misi)
        'mission',
        'mission_image',
        'philosophy_title',
        'philosophy_quote',

        // 4. Why Choose Us (Kenapa Memilih Kami)
        'why_title',
        'why_1_title', 'why_1_desc',
        'why_2_title', 'why_2_desc',
        'why_3_title', 'why_3_desc',
    ];
}