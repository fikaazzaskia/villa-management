<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $fillable = ['nama', 'email', 'no_hp', 'no_ktp', 'jenis_kelamin', 'alamat'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}