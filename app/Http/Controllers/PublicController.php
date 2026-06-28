<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function home()
    {
        $profile = DB::table('villa_profile')->first();
        $galeris = DB::table('galeri')->orderBy('urutan')->get();

        return view('public.home', [
            'profile' => $profile,
            'galeris' => $galeris,
        ]);
    }

    public function galeri()
    {
        $galeris = DB::table('galeri')->orderBy('urutan')->get();
        return view('public.galeri', ['galeris' => $galeris]);
    }

    public function bookingForm()
    {
        $profile = DB::table('villa_profile')->first();
        if (!$profile) return redirect('/')->with('error', 'Profil villa belum diatur.');
        return view('public.booking-form', ['profile' => $profile]);
    }

    public function bookingStore(Request $request)
    {
        $request->validate([
            'nama_tamu' => 'required',
            'email_tamu' => 'required|email',
            'tanggal_checkin' => 'required|date|after_or_equal:today',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'jumlah_tamu' => 'required|integer|min:1',
        ]);

        $bookingId = DB::table('bookings')->insertGetId([
            'nama_tamu' => htmlspecialchars($request->nama_tamu),
            'email_tamu' => htmlspecialchars($request->email_tamu),
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'jumlah_tamu' => $request->jumlah_tamu,
            'status' => 'pending',
            'catatan' => htmlspecialchars($request->catatan),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/villa/booking-sukses/' . $bookingId);
    }

    public function bookingSukses($id)
    {
        $booking = DB::table('bookings')->where('id', $id)->first();
        if (!$booking) return redirect('/');
        return view('public.booking-sukses', ['booking' => $booking]);
    }
}