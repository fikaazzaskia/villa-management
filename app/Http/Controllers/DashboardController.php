<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooking = DB::table('bookings')->count();
        $totalTamu = DB::table('tamus')->count();
        $totalPembayaran = DB::table('pembayarans')->count();
        $bookingPending = DB::table('bookings')->where('status', 'pending')->count();

        return view('dashboard', [
            'totalBooking' => $totalBooking,
            'totalTamu' => $totalTamu,
            'totalPembayaran' => $totalPembayaran,
            'bookingPending' => $bookingPending,
        ]);
    }
}