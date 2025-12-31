<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi ke Service (Layanan)
     * Digunakan untuk: $res->service->name
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Relasi ke User (Pelanggan)
     * Digunakan untuk mengetahui siapa yang booking
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Barber (Tukang Cukur)
     * PENTING: Tambahkan ini karena dipanggil di Dashboard ($res->barber->name)
     * Asumsi: Nama kolom foreign key di database adalah 'barber_id'
     */
    public function barber()
    {
        // Ganti 'Barber::class' dengan 'User::class' jika barber Anda juga diambil dari tabel users
        // Tapi jika Anda punya Model khusus bernama Barber, gunakan ini:
        return $this->belongsTo(Barber::class, 'barber_id');
    }
}