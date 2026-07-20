<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReservasiController extends Controller
{
    private int $biayaAdmin = 2500;

    public function create(Request $request)
    {
        $lapangans = Lapangan::all();
        $user = Auth::user();
        $selectedLapanganId = $request->query('lapangan');

        return view('user.pemesanan', compact('lapangans', 'user', 'selectedLapanganId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id'      => 'required|exists:lapangans,id',
            'tanggal'         => 'required|date|after_or_equal:today', 
            'jam_mulai'        => 'required',
            'durasi'           => 'required|integer|min:1|max:3',
            'nama_pemesan'     => 'required|string|max:255',
            'whatsapp'         => 'required|string|max:20',
            'email'            => 'required|email|max:255',
            'catatan'          => 'nullable|string|max:500',
            'syarat_ketentuan' => 'required|accepted',
        ], [
            'syarat_ketentuan.accepted' => 'Anda wajib menyetujui syarat dan ketentuan untuk melanjutkan.'
        ]);
        $waktuSekarang = Carbon::now('Asia/Jakarta');
        $tanggalHariIni = $waktuSekarang->toDateString();
        $lapangan = Lapangan::findOrFail($request->lapangan_id);
        $durasi = (int) $request->durasi; 
        
        $jamMulai = Carbon::createFromFormat('H:i', $request->jam_mulai, 'Asia/Jakarta');
        $durasi = (int) $request->durasi; 
        $jamSelesai = (clone $jamMulai)->addHours($durasi);

        if ($request->tanggal === $tanggalHariIni) {
        if ($jamMulai->toTimeString() <= $waktuSekarang->toTimeString()) {
            return back()->withErrors(['jam_mulai' => 'Maaf, jam yang Anda pilih untuk hari ini sudah terlewat. Silakan pilih jam berikutnya.'])->withInput();
            }
        }

        $bentrok = Reservasi::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', 'disetujui')
            ->where(function($query) use ($jamMulai, $jamSelesai) {
                $query->whereBetween('jam_mulai', [$jamMulai->toTimeString(), $jamSelesai->toTimeString()])
                      ->orWhereBetween('jam_selesai', [$jamMulai->toTimeString(), $jamSelesai->toTimeString()]);
            })->exists();

        if ($bentrok) {
            return back()->withErrors(['jam_mulai' => 'Maaf, slot jam pada tanggal tersebut sudah di-booking tim lain.'])->withInput();
        }

        $bookingData = [
            'lapangan_id'   => $request->lapangan_id,
            'nama_lapangan' => $lapangan->nama_lapangan,
            'tarif_per_jam' => $lapangan->tarif_per_jam,
            'tanggal'       => $request->tanggal,
            'jam_mulai'     => $jamMulai->toTimeString(),
            'jam_selesai'   => $jamSelesai->toTimeString(),
            'durasi'        => $durasi,
            'nama_pemesan'  => $request->nama_pemesan,
            'whatsapp'      => $request->whatsapp,
            'email'         => $request->email,
            'catatan'       => $request->catatan,
            'base_total'    => $lapangan->tarif_per_jam * $durasi
        ];

        session(['pending_booking' => $bookingData]);

        return redirect()->route('pemesanan.pembayaran');
    }

    public function pembayaran()
    {
        $booking = session('pending_booking');
        if (!$booking) {
            return redirect()->route('pemesanan')->withErrors(['session' => 'Sesi pemesanan Anda telah kedaluwarsa, silakan isi kembali.']);
        }

        $biayaAdmin = $this->biayaAdmin;
        $grandTotal = $booking['base_total'] + $biayaAdmin;

        return view('user.pembayaran', compact('booking', 'biayaAdmin', 'grandTotal'));
    }

    public function storePembayaran(Request $request)
    {
        $booking = session('pending_booking');
        if (!$booking) {
            return redirect()->route('pemesanan')->withErrors(['session' => 'Sesi pemesanan kedaluwarsa.']);
        }
        
        $request->validate([
            'metode_pembayaran' => 'required|in:ovo,gopay,bank_transfer', 
            'bukti_pembayaran'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Proses unggah berkas bukti transfer
        $path = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = 'bukti_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('bukti_pembayaran', $filename, 'public');
        }

        $finalTotal = $booking['base_total'] + $this->biayaAdmin;
        Reservasi::create([
            'user_id'           => Auth::id() ?? 1,
            'lapangan_id'       => $booking['lapangan_id'],
            'tanggal'           => $booking['tanggal'],
            'jam_mulai'         => $booking['jam_mulai'],
            'jam_selesai'       => $booking['jam_selesai'],
            'total_harga'       => $finalTotal,
            'status'            => 'pending',
            'catatan'           => $booking['catatan'],
            'bukti_pembayaran'  => $path,
            'metode_pembayaran' => $request->metode_pembayaran 
        ]);

        session()->forget('pending_booking');

        return redirect()->route('dashboard')->with('success', 'Reservasi berhasil dibuat! Bukti pembayaran terunggah, menunggu verifikasi Admin.');
    }

    public function indexAdmin()
    {
        $reservasis = Reservasi::with(['user', 'lapangan'])->orderBy('created_at', 'desc')->get();

        return view('admin.sewa', compact('reservasis'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,selesai,dibatalkan'
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.sewa')->with('success', 'Status reservasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        if ($reservasi->bukti_pembayaran) {
            Storage::disk('public')->delete($reservasi->bukti_pembayaran);
        }
        
        $reservasi->delete();

        return redirect()->back()->with('success', 'Data transaksi pesanan berhasil dihapus secara permanen.');
    }
}