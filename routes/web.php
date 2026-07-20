<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// ==========================================
// PUBLIC ROUTES (Bisa Diakses Siapa Saja)
// ==========================================
Route::get('/', [LapanganController::class, 'home'])->name('home');
Route::get('/lapangan', [LapanganController::class, 'index'])->name('lapangan');
Route::get('/kontak', function () {
    return view('user.kontak');
});

// ==========================================
// GUEST ONLY ROUTES (Belum Login)
// ==========================================
Route::middleware(['guest'])->group(function () {
    // Portal User
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    // Portal Admin Login
    Route::get('/admin-login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/admin-login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');
});

// ==========================================
// AUTHENTICATED ROUTES (Harus Login)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // 1. Rute Khusus Customer / User Biasa
    Route::get('/pemesanan', [ReservasiController::class, 'create'])->name('pemesanan');
    Route::post('/pemesanan', [ReservasiController::class, 'store'])->name('pemesanan.store');
    Route::get('/pemesanan/pembayaran', [ReservasiController::class, 'pembayaran'])->name('pemesanan.pembayaran');
    Route::post('/pemesanan/pembayaran/proses', [ReservasiController::class, 'storePembayaran'])->name('pemesanan.storePembayaran');
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::put('/dashboard/profile', [UserDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/dashboard/password', [UserDashboardController::class, 'updatePassword'])->name('password.update');
    
    // 2. Rute Khusus ADMIN (Hanya Bisa Diakses User dengan Role Admin)
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/lapangan', [LapanganController::class, 'indexAdmin'])->name('lapangan');
        
       Route::post('/lapangan', [LapanganController::class, 'store'])->name('lapangan.store');
   
        Route::put('/lapangan/{id}', [LapanganController::class, 'update'])->name('lapangan.update');
        Route::delete('/lapangan/{id}', [LapanganController::class, 'destroy'])->name('lapangan.destroy');

        Route::get('/sewa', [ReservasiController::class, 'indexAdmin'])->name('sewa');
        Route::put('/sewa/{id}/status', [ReservasiController::class, 'updateStatus'])->name('sewa.updateStatus');
        Route::delete('/admin/sewa/{id}', [ReservasiController::class, 'destroy'])->name('admin.sewa.destroy');

        Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('profile');
        Route::put('/profile/update', [AdminDashboardController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [AdminDashboardController::class, 'updatePassword'])->name('profile.password');
    });

    // Aksi Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});