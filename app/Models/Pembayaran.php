<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['booking_id', 'jumlah', 'metode', 'status', 'bukti_bayar'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}