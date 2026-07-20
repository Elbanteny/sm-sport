<?php
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schedule;


Schedule::call(function () {
    $sekarang = Carbon::now('Asia/Jakarta'); 
    $tanggalHariIni = $sekarang->toDateString();
    $jamSekarang = $sekarang->toTimeString();

    Reservasi::where('status', 'disetujui')
        ->where(function ($query) use ($tanggalHariIni, $jamSekarang) {
            $query->where('tanggal', '<', $tanggalHariIni)
                  ->orWhere(function ($q) use ($tanggalHariIni, $jamSekarang) {
                      $q->where('tanggal', $tanggalHariIni)
                        ->where('jam_selesai', '<=', $jamSekarang);
                  });
        })
        ->update(['status' => 'selesai']);
})->everyMinute();