<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable {
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_telpon'
    ];

    protected $hidden = [
        'password',
    ];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}