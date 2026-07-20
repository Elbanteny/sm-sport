<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Reservasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index()
    {
    $hariIni = Carbon::today('Asia/Jakarta')->toDateString();
    $sekarang = Carbon::now('Asia/Jakarta')->toTimeString();

    // 1. Jumlah Lapangan yang tersedia di database
    $totalLapangan = Lapangan::count();

    // 2. Jumlah Lapangan yang SEDANG di-sewa saat ini
    // Kondisi: Tanggal hari ini, di antara jam_mulai dan jam_selesai, dan status disetujui/selesai
    $lapanganDisewa = Reservasi::where('tanggal', $hariIni)
        ->where('jam_mulai', '<=', $sekarang)
        ->where('jam_selesai', '>=', $sekarang)
        ->whereIn('status', ['disetujui', 'selesai'])
        ->distinct('lapangan_id')
        ->count();

    // 3. Jumlah seluruh customer terdaftar
    $totalUser = User::where('role', 'customer')->count();

    // 4. Ringkasan Penyewaan Harian (Total pendapatan hari ini dari transaksi sukses)
    $pendapatanHariIni = Reservasi::where('tanggal', $hariIni)
        ->whereIn('status', ['disetujui', 'selesai'])
        ->sum('total_harga');

    // 5. Mengambil 5 Reservasi terbaru untuk komponen Bento Grid
    $reservasiTerbaru = Reservasi::with(['user', 'lapangan'])
        ->latest()
        ->take(5)
        ->get();

    return view('admin.dashboard', compact(
        'totalLapangan',
        'lapanganDisewa',
        'totalUser',
        'pendapatanHariIni',
        'reservasiTerbaru'
    ));
    }

    public function profile()
    {
        $user = Auth::user();
        
        // Membuat inisial 2 huruf pertama dari nama admin untuk avatar
        $words = explode(' ', $user->name);
        $initials = '';
        if (count($words) >= 2) {
            $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        } else {
            $initials = strtoupper(substr($user->name, 0, 2));
        }

        return view('admin.profile', compact('user', 'initials'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.profile')->with('success', 'Nama profil administrator berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.profile')->with('success', 'Kata sandi keamanan admin berhasil diperbarui!');
    }
}