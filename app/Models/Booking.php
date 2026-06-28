<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tamu_id', 'nama_tamu', 'email_tamu', 'tanggal_checkin',
        'tanggal_checkout', 'jumlah_tamu', 'status', 'catatan'
    ];

    public function tamu()
    {
        return $this->belongsTo(Tamu::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}