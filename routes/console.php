<?php
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schedule;


Schedule::call(function () {
    $sekarang = Carbon::now('Asia/Jakarta'); 
    $tanggalHariIni = $sekarang->toDateString();
    $jamSekarang = $sekarang->toTimeString();

    $sudahLewatWaktu = function ($query) use ($tanggalHariIni, $jamSekarang) {
        $query->where('tanggal', '<', $tanggalHariIni)
              ->orWhere(function ($q) use ($tanggalHariIni, $jamSekarang) {
                  $q->where('tanggal', $tanggalHariIni)
                    ->where('jam_selesai', '<=', $jamSekarang);
              });
    };

    Reservasi::where('status', 'disetujui')
        ->where($sudahLewatWaktu)
        ->update(['status' => 'selesai']);

    Reservasi::where('status', 'pending')
        ->where($sudahLewatWaktu)
        ->update(['status' => 'dibatalkan']);

})->everyMinute();