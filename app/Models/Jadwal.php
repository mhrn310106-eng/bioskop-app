<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model {
    protected $fillable = ['film_id','studio_id','tanggal','jam_tayang','harga'];

    public function film() { return $this->belongsTo(Film::class); }
    public function studio() { return $this->belongsTo(Studio::class); }
    public function bookings() { return $this->hasMany(Booking::class); }
    public function kursis() { return $this->hasMany(Kursi::class); }
}


