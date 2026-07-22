<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lapangan extends Model
{
    protected $fillable = [
        'nama_lapangan', 'jenis_lapangan', 'kategori', 'tipe', 
        'image_url', 'tarif_per_jam', 'rating', 'reviews', 
        'badge', 'deskripsi', 'facilities'
    ];

    protected $casts = [
        'facilities' => 'array',
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'lapangan_id', 'id');
    }

    public function getSedangDisewaAttribute()
    {
        $sekarang = Carbon::now('Asia/Jakarta');
        $tanggalHariIni = $sekarang->toDateString();
        $jamSekarang = $sekarang->toTimeString();

        return $this->reservasis()
            ->where('tanggal', $tanggalHariIni)
            ->where('status', 'disetujui')
            ->where('jam_mulai', '<=', $jamSekarang)
            ->where('jam_selesai', '>=', $jamSekarang)
            ->exists();
    }
}