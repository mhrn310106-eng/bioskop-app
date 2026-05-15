<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model {
    protected $fillable = ['judul','genre','durasi','sinopsis','poster','status'];

    public function jadwals() {
        return $this->hasMany(Jadwal::class);
    }
}

