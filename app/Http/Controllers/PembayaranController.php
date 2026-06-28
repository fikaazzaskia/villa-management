<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = DB::table('pembayarans')
            ->join('bookings', 'pembayarans.booking_id', '=', 'bookings.id')
            ->select('pembayarans.*', 'bookings.nama_tamu')
            ->orderBy('pembayarans.created_at', 'desc')
            ->get();
        return view('pembayaran.index', ['pembayarans' => $pembayarans]);
    }

    public function create()
    {
        $bookings = DB::table('bookings')->whereNotIn('id', function($q){
            $q->select('booking_id')->from('pembayarans');
        })->get();
        return view('pembayaran.create', ['bookings' => $bookings]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'jumlah' => 'required|numeric',
            'metode' => 'required',
            'bukti_bayar' => 'nullable|image|max:5120',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_bayar')) {
            $buktiPath = $request->file('bukti_bayar')->store('pembayaran/bukti', 'public');
        }

        DB::table('pembayarans')->insert([
            'booking_id' => $request->booking_id,
            'jumlah' => $request->jumlah,
            'metode' => $request->metode,
            'status' => 'pending',
            'bukti_bayar' => $buktiPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/pembayaran')->with('success', 'Pembayaran berhasil dicatat!');
    }

    public function edit($id)
    {
        $pembayaran = DB::table('pembayarans')->where('id', $id)->first();
        $bookings = DB::table('bookings')->get();
        return view('pembayaran.edit', ['pembayaran' => $pembayaran, 'bookings' => $bookings]);
    }

    public function update(Request $request, $id)
    {
        $pembayaran = DB::table('pembayarans')->where('id', $id)->first();

        $data = [
            'booking_id' => $request->booking_id,
            'jumlah' => $request->jumlah,
            'metode' => $request->metode,
            'status' => $request->status,
            'updated_at' => now(),
        ];

        if ($request->hasFile('bukti_bayar')) {
            if ($pembayaran->bukti_bayar) Storage::disk('public')->delete($pembayaran->bukti_bayar);
            $data['bukti_bayar'] = $request->file('bukti_bayar')->store('pembayaran/bukti', 'public');
        }

        DB::table('pembayarans')->where('id', $id)->update($data);
        return redirect('/pembayaran')->with('success', 'Pembayaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pembayaran = DB::table('pembayarans')->where('id', $id)->first();
        if ($pembayaran->bukti_bayar) Storage::disk('public')->delete($pembayaran->bukti_bayar);

        DB::table('pembayarans')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}