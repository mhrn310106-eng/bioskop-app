<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    protected $fillable = [
    'user_id','jadwal_id','jumlah_tiket','total_harga',
    'status','kode_booking',
    'metode_bayar','bukti_bayar','status_bayar' 
];

    public function user() { return $this->belongsTo(User::class); }
    public function jadwal() { return $this->belongsTo(Jadwal::class); }
    public function kursis() { return $this->hasMany(Kursi::class); }
}


