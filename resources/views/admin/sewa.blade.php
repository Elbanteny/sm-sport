@extends('layouts.admin')

@section('title', 'Kelola Sewa & Reservasi')

@section('admin_content')

<!-- PEMBUNGKUS UTAMA X-DATA -->
<div x-data="{ 
isStatusOpen: false, 
    isDetailOpen: false,
    isBuktiOpen: false,
    buktiUrl: '',
    statusData: {
        id: '',
        nama_lapangan: '',
        pemesan: '',
        status: ''
    },
    detailData: {
        nama_lapangan: '',
        jenis_lapangan: '',
        tipe: '',
        kategori: '',
        tarif_per_jam: 0,
        pemesan: '',
        email: '',
        tanggal: '',
        jam_mulai: '',
        jam_selesai: '',
        total_harga: 0,
        catatan: '',
        bukti_pembayaran: '',
        metode_pembayaran: ''
    },
    openStatusModal(data) {
        this.statusData = { 
            id: data.id,
            nama_lapangan: data.lapangan.nama_lapangan,
            pemesan: data.user.name,
            status: data.status
        };
        this.isStatusOpen = true;
    },
    closeStatusModal() {
        this.isStatusOpen = false;
    },
    openDetailModal(data) {
        this.detailData = {
            nama_lapangan: data.lapangan.nama_lapangan,
            jenis_lapangan: data.lapangan.jenis_lapangan,
            tipe: data.lapangan.tipe,
            kategori: data.lapangan.kategori,
            tarif_per_jam: data.lapangan.tarif_per_jam,
            pemesan: data.user.name,
            email: data.user.email,
            tanggal: data.tanggal_formatted,
            jam_mulai: data.jam_mulai_formatted,
            jam_selesai: data.jam_selesai_formatted,
            total_harga: data.total_harga,
            catatan: data.catatan || 'Tidak ada catatan tambahan.',
            bukti_pembayaran: data.bukti_pembayaran ? '/storage/' + data.bukti_pembayaran : null,
            metode_pembayaran: data.metode_pembayaran === 'ovo' ? '🟣 OVO E-Wallet' : 
                       (data.metode_pembayaran === 'gopay' ? '🟢 GOPAY Merchant' : 
                       (data.metode_pembayaran === 'bank_transfer' ? '🏦 Virtual Account Bank' : 'Tidak Diketahui'))
        };
        this.isDetailOpen = true;
    },
    closeDetailModal() {
        this.isDetailOpen = false;
    },
    openBuktiModal(url) {
        this.buktiUrl = url;
        this.isBuktiOpen = true;
    },
    closeBuktiModal() {
        this.isBuktiOpen = false;
    }
}">


    <!-- TABLE AREA -->
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-zinc-800 pb-6 mb-8">
        <div>
            <h2 class="font-syne text-xl font-bold text-white uppercase tracking-wider flex items-center gap-2">
                <span class="w-1.5 h-5 bg-lime-400 rounded-full"></span>
                Daftar Lapangan Di-Sewa
            </h2>
            <p class="text-xs text-zinc-500 mt-1">Pantau jadwal pemakaian lapangan, konfirmasi booking masuk, dan perbarui status sewa secara real-time.</p>
        </div>
    </div>

    <!-- Alert Success Flash Message -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center gap-3 text-emerald-400 text-xs">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- TABLE AREA -->
    <div class="bg-zinc-950/40 border border-zinc-800 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left text-zinc-300">
                <thead>
                    <tr class="border-b border-zinc-800 bg-zinc-900/30 text-zinc-500 text-[10px] uppercase tracking-wider font-bold">
                        <th class="px-6 py-4">Lapangan</th>
                        <th class="px-6 py-4">Pemesan</th>
                        <th class="px-6 py-4">Jadwal Main</th>
                        <th class="px-6 py-4">Bukti Bayar</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900 text-xs">
                    @forelse($reservasis as $reservasi)
                        @php
                            $reservasiData = $reservasi->toArray();
                            $reservasiData['tanggal_formatted'] = \Carbon\Carbon::parse($reservasi->tanggal)->translatedFormat('d F Y');
                            $reservasiData['jam_mulai_formatted'] = \Carbon\Carbon::parse($reservasi->jam_mulai)->format('H:i');
                            $reservasiData['jam_selesai_formatted'] = \Carbon\Carbon::parse($reservasi->jam_selesai)->format('H:i');
                        @endphp
                        <tr class="hover:bg-zinc-900/20 transition-all duration-200">
                            <!-- Kolom Lapangan -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-white text-sm">{{ $reservasi->lapangan->nama_lapangan }}</div>
                                <div class="text-[10px] text-zinc-500 mt-0.5 uppercase tracking-wider">
                                    {{ $reservasi->lapangan->jenis_lapangan }} | {{ $reservasi->lapangan->tipe }}
                                </div>
                            </td>
                            
                            <!-- Kolom Pemesan -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-white">{{ $reservasi->user->name }}</div>
                                <div class="text-[10px] text-zinc-500 mt-0.5">{{ $reservasi->user->email }}</div>
                            </td>
                            
                            <!-- Kolom Jadwal -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold text-white">{{ $reservasiData['tanggal_formatted'] }}</div>
                                <div class="text-[10px] text-zinc-400 mt-0.5">
                                    {{ $reservasiData['jam_mulai_formatted'] }} - {{ $reservasiData['jam_selesai_formatted'] }} WIB
                                </div>
                            </td>
                            
                            <!-- Kolom Bukti Bayar (Klik Gambar untuk Membuka Modal) -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($reservasi->bukti_pembayaran)
                                    <button 
                                        type="button" 
                                        @click="openBuktiModal('{{ asset('storage/' . $reservasi->bukti_pembayaran) }}')"
                                        class="relative group w-14 h-10 rounded-lg overflow-hidden border border-zinc-800 bg-zinc-900 flex items-center justify-center transition hover:border-lime-400/40"
                                        title="Klik untuk memperbesar bukti"
                                    >
                                        <img src="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" alt="Bukti" class="w-full h-full object-cover opacity-70 group-hover:opacity-100 transition">
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition text-[9px] font-bold text-lime-400">LIHAT</div>
                                    </button>
                                @else
                                    <span class="text-zinc-600 italic text-[11px]">Belum diunggah</span>
                                @endif
                            </td>
                            
                            <!-- Kolom Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($reservasi->status === 'pending')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded-full text-[10px] font-bold uppercase">
                                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                        Pending
                                    </span>
                                @elseif($reservasi->status === 'disetujui')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-lime-500/10 text-lime-400 border border-lime-500/20 rounded-full text-[10px] font-bold uppercase">
                                        <span class="w-1.5 h-1.5 bg-lime-400 rounded-full"></span>
                                        Disetujui
                                    </span>
                                @elseif($reservasi->status === 'selesai')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-zinc-800 text-zinc-400 border border-zinc-700 rounded-full text-[10px] font-bold uppercase">
                                        Selesai
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-full text-[10px] font-bold uppercase">
                                        Dibatalkan
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Kolom Aksi -->
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                <!-- Tombol Detail Pesanan -->
                                <button 
                                    type="button"
                                    @click="openDetailModal({{ json_encode($reservasiData) }})" 
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white hover:border-zinc-700 rounded-xl transition text-[10px] font-bold uppercase tracking-wider"
                                >
                                    Detail
                                </button>
                                
                                <!-- Tombol Ubah Status -->
                                <button 
                                    type="button"
                                    @click="openStatusModal({{ json_encode($reservasi) }})" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-zinc-900 border border-zinc-800 text-zinc-300 hover:text-lime-400 hover:border-lime-400/30 rounded-xl transition text-[10px] font-bold uppercase tracking-wider"
                                >
                                    Ubah Status
                                </button>

                                <form 
                                action="{{ url('/admin/sewa/' . $reservasi->id) }}" 
                                method="POST" 
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus permanen data pesanan ini? Tindakan ini tidak dapat dibatalkan.');"
                                class="inline"
                            >
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-rose-950/20 border border-rose-900/30 text-rose-400 hover:text-rose-300 hover:bg-rose-900/30 hover:border-rose-500/40 rounded-xl transition text-[10px] font-bold uppercase tracking-wider"
                                    title="Hapus Pesanan"
                                >
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-zinc-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="text-3xl">📅</span>
                                    <p class="font-bold text-zinc-400">Belum ada transaksi sewa lapangan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL EDIT STATUS MELAYANG -->
    <x-admin.edit-status-modal />

    <x-admin.detail-modal-card />

   <div x-show="isBuktiOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 md:p-10" style="display: none">
    <div x-show="isBuktiOpen" x-transition class="absolute inset-0 bg-black/90 backdrop-blur-md" @click="closeBuktiModal()"></div>
    
    <div x-show="isBuktiOpen" x-transition class="relative max-w-4xl w-full z-10 flex flex-col items-center">
        
        <button @click="closeBuktiModal()" class="absolute -top-12 right-2 text-zinc-400 hover:text-white px-4 py-2 rounded-xl bg-zinc-900 border border-zinc-800 text-xs font-bold transition shadow-xl">✕ Tutup Gambar</button>
    
        <div class="bg-zinc-900 p-2 border border-zinc-800 rounded-2xl shadow-2xl max-h-[85vh] w-full overflow-hidden flex items-center justify-center">
            <img :src="buktiUrl" alt="Struk Pembayaran Full" class="max-h-[80vh] w-auto max-w-full object-contain rounded-xl">
        </div>
        
        </div>
    </div>

</div> 
@endsection