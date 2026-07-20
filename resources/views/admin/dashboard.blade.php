@extends('layouts.admin')

@section('title', 'Admin Overview')

@section('admin_content')
    <!-- Header Section di dalam Bento Card -->
    <div class="border-b border-zinc-800 pb-5 mb-8">
        <h2 class="font-syne text-xl font-bold text-white uppercase tracking-wider flex items-center gap-2">
            <span class="w-1.5 h-5 bg-lime-400 rounded-full"></span>
            Statistik & Analitik Real-Time
        </h2>
        <p class="text-xs text-zinc-500 mt-1">Laporan instan terkait aset lapangan, pengguna aktif, dan riwayat transaksi sewa hari ini.</p>
    </div>

    <!-- BENTO GRID SYSTEM -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-6">
        
        <!-- CARD 1: Jumlah Lapangan (Bento Column-3) -->
        <div class="lg:col-span-3">
            <x-admin.stat-card 
                title="Total Lapangan" 
                value="{{ $totalLapangan }} Unit" 
                desc="Tersedia di katalog olahraga"
                type="default"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </x-admin.stat-card>
        </div>

        <!-- CARD 2: Lapangan Sedang Disewa (Bento Column-3) -->
        <div class="lg:col-span-3">
            <x-admin.stat-card 
                title="Sedang Disewa" 
                value="{{ $lapanganDisewa }} Lapangan" 
                desc="Sedang aktif digunakan saat ini"
                type="danger"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-admin.stat-card>
        </div>

        <!-- CARD 3: Jumlah User (Bento Column-3) -->
        <div class="lg:col-span-3">
            <x-admin.stat-card 
                title="Member Terdaftar" 
                value="{{ $totalUser }} User" 
                desc="Customer berstatus aktif"
                type="default"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </x-admin.stat-card>
        </div>

        <!-- CARD 4: Ringkasan Pendapatan Harian (Bento Column-3) -->
        <div class="lg:col-span-3">
            <x-admin.stat-card 
                title="Pendapatan Hari Ini" 
                value="Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}" 
                desc="Dari akumulasi sewa disetujui"
                type="success"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-admin.stat-card>
        </div>

        <!-- CARD 5: Aktivitas Reservasi Terbaru (Bento Span Lebar - Column 12 / 8) -->
        <div class="lg:col-span-8 bg-zinc-950/30 border border-zinc-800 rounded-2xl p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-zinc-800/60 mb-4">
                    <h3 class="font-syne text-sm font-bold text-white uppercase tracking-wider">Aktivitas Reservasi Terbaru</h3>
                    <span class="text-[10px] text-lime-400 bg-lime-400/10 px-2 py-1 rounded-md font-bold uppercase">Real-Time Feed</span>
                </div>
                
                <div class="space-y-3.5">
                    @forelse($reservasiTerbaru as $res)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-zinc-900/40 border border-zinc-800 hover:border-zinc-700/60 transition">
                            <div class="flex items-center gap-3">
                                <!-- Initial User -->
                                <div class="w-8 h-8 rounded-lg bg-zinc-800 text-zinc-300 font-syne text-[10px] font-black flex items-center justify-center">
                                    {{ strtoupper(substr($res->user->name, 0, 2)) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-white">{{ $res->user->name }}</span>
                                    <span class="text-[10px] text-zinc-500">Menyewa {{ $res->lapangan->nama_lapangan ?? 'Lapangan' }}</span>
                                </div>
                            </div>
                            <div class="text-right flex flex-col items-end gap-1">
                                <span class="text-xs font-black text-white">Rp {{ number_format($res->total_harga, 0, ',', '.') }}</span>
                                @if($res->status === 'pending')
                                    <span class="text-[8px] font-extrabold text-amber-400 uppercase tracking-widest">⏱️ Pending</span>
                                @elseif($res->status === 'disetujui')
                                    <span class="text-[8px] font-extrabold text-emerald-400 uppercase tracking-widest">✅ Approved</span>
                                @elseif($res->status === 'selesai')
                                    <span class="text-[8px] font-extrabold text-blue-400 uppercase tracking-widest">🏆 Selesai</span>
                                @else
                                    <span class="text-[8px] font-extrabold text-rose-400 uppercase tracking-widest">❌ Cancelled</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 text-zinc-600 text-xs">
                            Tidak ada aktivitas reservasi baru hari ini.
                        </div>
                    @endforelse
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-zinc-850 text-right">
                <a href="{{ route('admin.sewa') }}" class="text-xs font-bold text-lime-400 hover:text-lime-300 hover:underline transition">
                    Lihat Semua Lapangan Di-Sewa &rarr;
                </a>
            </div>
        </div>

        <!-- CARD 6: Informasi Operasional Pintar (Bento Span Kecil - Column 4) -->
        <div class="lg:col-span-4 bg-zinc-950/30 border border-zinc-800 rounded-2xl p-6 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-500/5 rounded-full blur-2xl"></div>
            
            <div class="space-y-4">
                <div class="pb-4 border-b border-zinc-800/60">
                    <h3 class="font-syne text-sm font-bold text-white uppercase tracking-wider">Tips Manajemen</h3>
                    <p class="text-[10px] text-zinc-500 mt-0.5">Membantu optimasi pendapatan area SM Sport.</p>
                </div>
                
                <div class="space-y-3 text-xs text-zinc-400 leading-relaxed">
                    <p>💡 <strong class="text-white">Review berkala:</strong> Jadwal transaksi berstatus <span class="text-amber-400">pending</span> yang mendekati jam mulai sebaiknya segera dikonfirmasi untuk efisiensi lapangan.</p>
                    <p>💡 <strong class="text-white">Pemeliharaan:</strong> Atur waktu jeda setidaknya 15 menit di sela-sela penyewaan intensif untuk merawat kebersihan lapangan.</p>
                </div>
            </div>

            <div class="mt-6 p-3 rounded-xl bg-linear-to-br from-zinc-900 to-zinc-950 border border-zinc-800 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Status Portal: Optimal</span>
            </div>
        </div>

    </div>
@endsection