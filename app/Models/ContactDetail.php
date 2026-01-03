<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use HasFactory;

    // Tabel: 'contact_details' (harus ditulis manual karena nama tabelnya beda)
    protected $table = 'contact_details';

    protected $fillable = [
        'page_title', 
        'page_subtitle',
        'address', 
        'whatsapp', 
        'email', 
        'maps_link',
        'hours_night',
        'hours_mon_fri', 
        'hours_tue_wed', 
        'hours_sat_sun',
    ];
}