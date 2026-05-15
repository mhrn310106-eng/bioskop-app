<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kursi extends Model {
    protected $fillable = ['booking_id','jadwal_id','nomor_kursi'];

    public function booking() { return $this->belongsTo(Booking::class); }
    public function jadwal() { return $this->belongsTo(Jadwal::class); }
}

