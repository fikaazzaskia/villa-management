<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\VillaProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserManagementController;

// ============ PUBLIK (tanpa login) ============
Route::get('/', [PublicController::class, 'home']);
Route::get('/villa/galeri', [PublicController::class, 'galeri']);
Route::get('/villa/booking', [PublicController::class, 'bookingForm']);
Route::post('/villa/booking-store', [PublicController::class, 'bookingStore']);
Route::get('/villa/booking-sukses/{id}', [PublicController::class, 'bookingSukses']);

// ============ AUTH (untuk staff/admin) ============
Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// ============ ADMIN/STAFF AREA (wajib login) ============
Route::middleware('ceklogin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::middleware('cekadmin')->group(function () {
        Route::get('/galeri', [GaleriController::class, 'index']);
        Route::get('/galeri-create', [GaleriController::class, 'create']);
        Route::post('/galeri-store', [GaleriController::class, 'store']);
        Route::delete('/galeri-hapus/{id}', [GaleriController::class, 'destroy']);

        Route::get('/profile', [VillaProfileController::class, 'edit']);
        Route::put('/profile-update', [VillaProfileController::class, 'update']);

        Route::get('/user', [UserManagementController::class, 'index']);
        Route::get('/user-create', [UserManagementController::class, 'create']);
        Route::post('/user-store', [UserManagementController::class, 'store']);
        Route::get('/user-edit/{username}', [UserManagementController::class, 'edit']);
        Route::put('/user-update/{username}', [UserManagementController::class, 'update']);
        Route::delete('/user-hapus/{username}', [UserManagementController::class, 'destroy']);
    });

    // Tamu - CRUD
    Route::get('/tamu', [TamuController::class, 'index']);
    Route::get('/tamu-create', [TamuController::class, 'create']);
    Route::post('/tamu-store', [TamuController::class, 'store']);
    Route::get('/tamu-edit/{id}', [TamuController::class, 'edit']);
    Route::put('/tamu-update/{id}', [TamuController::class, 'update']);
    Route::delete('/tamu-hapus/{id}', [TamuController::class, 'destroy']);

    // Booking - CRUD
    Route::get('/booking', [BookingController::class, 'index']);
    Route::get('/booking-create', [BookingController::class, 'create']);
    Route::post('/booking-store', [BookingController::class, 'store']);
    Route::get('/booking-edit/{id}', [BookingController::class, 'edit']);
    Route::put('/booking-update/{id}', [BookingController::class, 'update']);
    Route::delete('/booking-hapus/{id}', [BookingController::class, 'destroy']);

    // Pembayaran - CRUD
    Route::get('/pembayaran', [PembayaranController::class, 'index']);
    Route::get('/pembayaran-create', [PembayaranController::class, 'create']);
    Route::post('/pembayaran-store', [PembayaranController::class, 'store']);
    Route::get('/pembayaran-edit/{id}', [PembayaranController::class, 'edit']);
    Route::put('/pembayaran-update/{id}', [PembayaranController::class, 'update']);
    Route::delete('/pembayaran-hapus/{id}', [PembayaranController::class, 'destroy']);
});