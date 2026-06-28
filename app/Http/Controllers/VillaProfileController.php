<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VillaProfileController extends Controller
{
    public function edit()
    {
        $profile = DB::table('villa_profile')->first();
        return view('profile.edit', ['profile' => $profile]);
    }

    public function update(Request $request)
    {
        $data = [
            'nama' => htmlspecialchars($request->nama),
            'deskripsi' => htmlspecialchars($request->deskripsi),
            'alamat' => htmlspecialchars($request->alamat),
            'no_telp' => htmlspecialchars($request->no_telp),
            'fasilitas_umum' => $request->fasilitas_umum ? implode(', ', $request->fasilitas_umum) : null,
            'harga_per_malam' => $request->harga_per_malam,
            'kapasitas' => $request->kapasitas,
            'jumlah_kamar_tidur' => $request->jumlah_kamar_tidur,
            'tersedia' => $request->has('tersedia') ? 1 : 0,
            'updated_at' => now(),
        ];

        $profile = DB::table('villa_profile')->first();

        if ($request->hasFile('foto_utama')) {
            if ($profile && $profile->foto_utama) Storage::disk('public')->delete($profile->foto_utama);
            $data['foto_utama'] = $request->file('foto_utama')->store('profile', 'public');
        }

        if ($profile) {
            DB::table('villa_profile')->where('id', $profile->id)->update($data);
        } else {
            $data['created_at'] = now();
            DB::table('villa_profile')->insert($data);
        }

        return redirect('/profile')->with('success', 'Profil villa berhasil diupdate!');
    }
}