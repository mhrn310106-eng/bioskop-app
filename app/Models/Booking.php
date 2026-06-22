<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'film_id',
        'studio_id',
        'tanggal_booking',
        'jam_booking',
        'jumlah_tiket',
        'harga_tiket',
        'total_harga',
        'status',
        'kode_booking',
        'metode_bayar',
        'bukti_bayar',
        'status_bayar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function kursis()
    {
        return $this->hasMany(Kursi::class);
    }
}