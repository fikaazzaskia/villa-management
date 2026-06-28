<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaProfile extends Model
{
    protected $table = 'villa_profile';
    protected $fillable = [
        'nama', 'deskripsi', 'alamat', 'no_telp', 'fasilitas_umum',
        'harga_per_malam', 'kapasitas', 'jumlah_kamar_tidur', 'tersedia', 'foto_utama'
    ];
}