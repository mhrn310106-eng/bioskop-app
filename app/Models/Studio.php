<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model {
    protected $fillable = ['nama','kapasitas'];

    public function jadwals() {
        return $this->hasMany(Jadwal::class);
    }
}

