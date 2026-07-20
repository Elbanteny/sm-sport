@extends('layouts.app')

@section('title', 'Selesaikan Pembayaran - SM Sport Center')

@section('content')
<section class="relative min-h-screen flex items-center justify-center pt-28 pb-20 overflow-hidden">
    <!-- Background Gradients Mesh -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(163,230,53,0.1),rgba(255,255,255,0))] pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        
        <!-- Header Rincian Pembayaran -->
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h1 class="font-syne text-3xl sm:text-4xl font-black text-white leading-tight mb-3">
                METODE <span class="text-transparent bg-clip-text bg-linear-to-r from-lime-400 to-emerald-400">PEMBAYARAN</span>
            </h1>
            <p class="text-zinc-400 text-xs sm:text-sm">Silakan pilih opsi dompet digital atau transfer bank di bawah ini untuk mengunci slot jadwal pertandingan Anda.</p>
        </div>

        @if($errors->any())
            <div class="max-w-3xl mx-auto mb-6 p-4 bg-rose-500/10 border border-rose-500/30 rounded-2xl text-rose-400 text-xs">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulir Upload & Grid Informasi Detail -->
        <form action="{{ route('pemesanan.storePembayaran') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            @csrf

            <!-- KIRI: Pemilihan Tujuan & Upload Berkas Bukti -->
            <div class="lg:col-span-7 bg-zinc-900/50 border border-zinc-800 rounded-3xl p-6 sm:p-8 space-y-6 backdrop-blur-md">
                
                <h3 class="font-syne text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-lime-400 rounded-full"></span>
                    1. Pilih Saluran Pembayaran
                </h3>

                <!-- Akordeon  -->
                <div x-data="{ method: 'ovo' }" class="space-y-3">
                    
                    <!-- OPSI 1: OVO -->
                    <label class="block p-4 rounded-2xl border transition-all cursor-pointer bg-zinc-950" 
                           :class="method === 'ovo' ? 'border-lime-400 bg-lime-400/5' : 'border-zinc-800 hover:border-zinc-700'">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="metode_pembayaran" value="ovo" x-model="method" class="sr-only" checked>
                                <span class="text-sm font-bold text-white font-syne uppercase">🟣 OVO E-Wallet</span>
                            </div>
                            <span class="text-[10px] text-zinc-500 font-medium">Verifikasi Otomatis</span>
                        </div>
                        <div x-show="method === 'ovo'" class="mt-3 pt-3 border-t border-zinc-800 text-xs text-zinc-400 space-y-1" x-transition>
                            <p>Nomor Rekening Tujuan OVO SM Sport:</p>
                            <p class="font-mono text-white text-sm font-bold tracking-wider">0851-9988-1234</p>
                            <p class="text-[10px] text-zinc-500">A/N PT. SM SPORT CENTER INDONESIA</p>
                        </div>
                    </label>

                    <!-- OPSI 2: GOPAY -->
                    <label class="block p-4 rounded-2xl border transition-all cursor-pointer bg-zinc-950" 
                           :class="method === 'gopay' ? 'border-lime-400 bg-lime-400/5' : 'border-zinc-800 hover:border-zinc-700'">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="metode_pembayaran" value="gopay" x-model="method" class="sr-only">
                                <span class="text-sm font-bold text-white font-syne uppercase">🟢 GOPAY Merchant</span>
                            </div>
                            <span class="text-[10px] text-zinc-500 font-medium">Proses Cepat</span>
                        </div>
                        <div x-show="method === 'gopay'" class="mt-3 pt-3 border-t border-zinc-800 text-xs text-zinc-400 space-y-1" x-transition>
                            <p>Nomor Rekening Tujuan GoPay / GoTo:</p>
                            <p class="font-mono text-white text-sm font-bold tracking-wider">0812-7766-4321</p>
                            <p class="text-[10px] text-zinc-500">A/N SM SPORT CENTER OFFICIAL</p>
                        </div>
                    </label>

                    <!-- OPSI 3: BANK TRANSFER -->
                    <label class="block p-4 rounded-2xl border transition-all cursor-pointer bg-zinc-950" 
                           :class="method === 'bank_transfer' ? 'border-lime-400 bg-lime-400/5' : 'border-zinc-800 hover:border-zinc-700'">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="metode_pembayaran" value="bank_transfer" x-model="method" class="sr-only">
                                <span class="text-sm font-bold text-white font-syne uppercase">🏦 VIRTUAL ACCOUNT BANK</span>
                            </div>
                            <span class="text-[10px] text-zinc-500 font-medium">Transfer Manual</span>
                        </div>
                        <div x-show="method === 'bank_transfer'" class="mt-3 pt-3 border-t border-zinc-800 text-xs text-zinc-400 space-y-1" x-transition>
                            <p>Nomor Rekening Virtual BCA:</p>
                            <p class="font-mono text-white text-sm font-bold tracking-wider">1002-0038-9918-223</p>
                            <p class="text-[10px] text-zinc-500">Bank BCA KCP Jakarta - A/N SM SPORT CENTER</p>
                        </div>
                    </label>
                </div>

                <!-- SEKSI LAMPIRAN BUKTI TRANSAKSI -->
                <div class="space-y-3 pt-2">
                    <h3 class="font-syne text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-lime-400 rounded-full"></span>
                        2. Unggah Bukti Transfer Resmi
                    </h3>
                    <p class="text-[11px] text-zinc-500 -mt-1">Lampirkan tangkapan layar (screenshot) mutasi transfer sukses dalam ekstensi JPG/PNG.</p>
                    
                    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-4">
                        <input 
                            type="file" 
                            name="bukti_pembayaran" 
                            id="bukti_pembayaran" 
                            class="w-full text-xs text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-zinc-900 file:text-lime-400 file:cursor-pointer hover:file:bg-zinc-800 transition"
                            required
                        >
                    </div>
                </div>

            </div>

            <!-- KANAN: Ringkasan Total Invoice & Tombol Submit -->
            <div class="lg:col-span-5 bg-zinc-900/50 border border-zinc-800 rounded-3xl p-6 sm:p-8 space-y-6 backdrop-blur-md">
                <h3 class="font-syne text-base font-bold text-white uppercase tracking-wider">Ringkasan Tagihan</h3>
                
                <div class="space-y-3 text-xs text-zinc-400 border-b border-zinc-800 pb-5">
                    <div class="flex justify-between">
                        <span>Penyewa</span>
                        <span class="text-white font-semibold">{{ $booking['nama_pemesan'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Nama Lapangan</span>
                        <span class="text-white font-semibold">{{ $booking['nama_lapangan'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Jadwal Bermain</span>
                        <span class="text-zinc-300 text-right">
                            {{ \Carbon\Carbon::parse($booking['tanggal'])->translatedFormat('d M Y') }}<br>
                            <span class="text-[10px] text-zinc-500">{{ substr($booking['jam_mulai'], 0, 5) }} - {{ substr($booking['jam_selesai'], 0, 5) }} WIB</span>
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span>Durasi Sewa</span>
                        <span class="text-white font-semibold">{{ $booking['durasi'] }} Jam</span>
                    </div>
                    
                    <div class="pt-2 flex justify-between border-t border-dashed border-zinc-800">
                        <span>Harga Dasar Sewa</span>
                        <span class="text-zinc-300">Rp {{ number_format($booking['base_total'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-amber-400">
                        <span>Biaya Admin (Ditanggung User)</span>
                        <span>Rp {{ number_format($biayaAdmin, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Tampilan Grand Total Akhir -->
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] text-zinc-500 uppercase font-bold tracking-wider">Total Harus Dibayar</p>
                        <p class="text-[9px] text-zinc-400 mt-0.5">*Sudah termasuk PPN & Admin</p>
                    </div>
                    <p class="font-syne text-xl font-black text-lime-400">Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
                </div>

                <!-- Tombol Eksekusi Aksi Akhir -->
                <div class="pt-2 space-y-3">
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-5 py-3.5 rounded-xl bg-linear-to-r from-lime-400 to-emerald-500 hover:opacity-95 text-zinc-950 text-xs font-black uppercase tracking-wider shadow-lg shadow-lime-400/5 active:scale-[0.99] transition cursor-pointer font-syne">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pesan & Kirim Reservasi
                    </button>
                    
                    <a href="{{ route('pemesanan') }}" class="block w-full text-center px-5 py-3.5 rounded-xl bg-zinc-950 border border-zinc-800 text-zinc-400 hover:text-zinc-300 text-xs font-bold uppercase tracking-wider transition">
                        Kembali ke Formulir
                    </a>
                </div>
            </div>

        </form>
    </div>
</section>
@endsection