<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = DB::table('bookings')->orderBy('created_at', 'desc')->get();
        return view('booking.index', ['bookings' => $bookings]);
    }

    public function create()
    {
        $tamus = DB::table('tamus')->get();
        return view('booking.create', ['tamus' => $tamus]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tamu' => 'required',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'jumlah_tamu' => 'required|integer|min:1',
        ]);

        DB::table('bookings')->insert([
            'tamu_id' => $request->tamu_id ?: null,
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

        return redirect('/booking')->with('success', 'Booking berhasil dibuat!');
    }

    public function edit($id)
    {
        $booking = DB::table('bookings')->where('id', $id)->first();
        $tamus = DB::table('tamus')->get();
        return view('booking.edit', ['booking' => $booking, 'tamus' => $tamus]);
    }

    public function update(Request $request, $id)
    {
        DB::table('bookings')->where('id', $id)->update([
            'tamu_id' => $request->tamu_id ?: null,
            'nama_tamu' => htmlspecialchars($request->nama_tamu),
            'email_tamu' => htmlspecialchars($request->email_tamu),
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'jumlah_tamu' => $request->jumlah_tamu,
            'status' => $request->status,
            'catatan' => htmlspecialchars($request->catatan),
            'updated_at' => now(),
        ]);

        return redirect('/booking')->with('success', 'Booking berhasil diupdate!');
    }

    public function destroy($id)
    {
        DB::table('bookings')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}