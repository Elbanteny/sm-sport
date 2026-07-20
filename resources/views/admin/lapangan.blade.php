@extends('layouts.admin')

@section('title', 'Kelola Lapangan')

@section('admin_content')

<div x-data="{ 
    isEditOpen: false, 
    isCreateOpen: false, 
    lapanganData: {
        id: '',
        nama_lapangan: '',
        jenis_lapangan: '',
        kategori: '',
        tipe: '',
        tarif_per_jam: '',
        image_url: '',
        badge: '',
        deskripsi: '',
        facilities: [] 
    },
    newLapanganData: {
        nama_lapangan: '',
        jenis_lapangan: 'futsal', /* default */
        kategori: 'Futsal',
        tipe: 'Indoor',
        tarif_per_jam: '',
        image_url: '',
        badge: '',
        deskripsi: '',
        facilities: []
    },
    openCreate() {
        this.newLapanganData = {
            nama_lapangan: '',
            jenis_lapangan: 'futsal',
            kategori: 'Futsal',
            tipe: 'Indoor',
            tarif_per_jam: '',
            image_url: '',
            badge: '',
            deskripsi: '',
            facilities: []
        };
        this.isCreateOpen = true;
    },
    closeCreate() {
        this.isCreateOpen = false;
    },
    openEdit(data) {
        let cleanedFacilities = [];
        if (Array.isArray(data.facilities)) {
            cleanedFacilities = data.facilities.map(item => item.trim().toLowerCase());
        }
        this.lapanganData = { 
            ...data,
            facilities: cleanedFacilities
        };
        this.updateKategori('edit');
        this.isEditOpen = true;
    },
    closeEdit() {
        this.isEditOpen = false;
    },
    updateKategori(mode) {
        if (mode === 'create') {
            if (this.newLapanganData.jenis_lapangan) {
                this.newLapanganData.kategori = this.newLapanganData.jenis_lapangan.charAt(0).toUpperCase() + this.newLapanganData.jenis_lapangan.slice(1);
            } else {
                this.newLapanganData.kategori = '';
            }
        } else {
            if (this.lapanganData.jenis_lapangan) {
                this.lapanganData.kategori = this.lapanganData.jenis_lapangan.charAt(0).toUpperCase() + this.lapanganData.jenis_lapangan.slice(1);
            } else {
                this.lapanganData.kategori = '';
            }
        }
    }
}">

    <!-- Header Page & Tombol Tambah -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-zinc-800 pb-6 mb-8">
        <div>
            <h2 class="font-syne text-xl font-bold text-white uppercase tracking-wider flex items-center gap-2">
                <span class="w-1.5 h-5 bg-lime-400 rounded-full"></span>
                Daftar Lapangan SM Sport
            </h2>
            <p class="text-xs text-zinc-500 mt-1">Kelola informasi, tarif, kategori, dan ketersediaan semua fasilitas lapangan Anda.</p>
        </div>
        
        <!-- Tombol memicu fungsi openCreate() -->
        <button 
            type="button"
            @click="openCreate()" 
            class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-lime-400 text-zinc-950 text-xs font-extrabold uppercase tracking-wider rounded-xl transition-all duration-300 hover:bg-lime-300 active:scale-95 shadow-lg shadow-lime-950/20"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Lapangan
        </button>
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
                        <th class="px-6 py-4 w-20">Gambar</th>
                        <th class="px-6 py-4">Nama Lapangan</th>
                        <th class="px-6 py-4">Kategori & Tipe</th>
                        <th class="px-6 py-4">Tarif per Jam</th>
                        <th class="px-6 py-4">Rating / Ulasan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900 text-xs">
                    @forelse($lapangans as $lapangan)
                        <tr class="hover:bg-zinc-900/20 transition-all duration-200">
                            <!-- Kolom Gambar -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-16 h-12 rounded-lg overflow-hidden bg-zinc-800 border border-zinc-700/50">
                                    <img src="{{ $lapangan->image_url }}" alt="{{ $lapangan->nama_lapangan }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            
                            <!-- Kolom Nama Lapangan -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-white text-sm">{{ $lapangan->nama_lapangan }}</div>
                                <div class="text-[10px] text-zinc-500 mt-0.5">ID: #LAP-{{ str_pad($lapangan->id, 3, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            
                            <!-- Kolom Kategori & Tipe -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-1 bg-zinc-900 border border-zinc-800 rounded-md text-[10px] font-semibold uppercase text-zinc-400">
                                        {{ $lapangan->jenis_lapangan }}
                                    </span>
                                    <span class="px-2.5 py-1 bg-emerald-500/10 text-emerald-400 rounded-md text-[10px] font-bold uppercase">
                                        {{ $lapangan->tipe }}
                                    </span>
                                </div>
                            </td>
                            
                            <!-- Kolom Tarif -->
                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-white">
                                Rp {{ number_format($lapangan->tarif_per_jam, 0, ',', '.') }}<span class="text-zinc-500 text-[10px] font-normal"> / jam</span>
                            </td>
                            
                            <!-- Kolom Rating -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-1 text-white font-medium">
                                    <span class="text-amber-400">⭐</span> 
                                    <span>{{ number_format($lapangan->rating, 1) }}</span>
                                    <span class="text-zinc-500 text-[10px] font-normal">({{ $lapangan->reviews }} ulasan)</span>
                                </div>
                            </td>
                            
                            <!-- Kolom Aksi -->
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="inline-flex items-center gap-2">
                                    <!-- Tombol Edit terintegrasi dengan Alpine.js -->
                                    <button 
                                        type="button"
                                        @click="openEdit({{ json_encode($lapangan) }})" 
                                        class="p-2 bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-lime-400 hover:border-lime-400/40 rounded-lg transition" 
                                        title="Edit Lapangan"
                                    >
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('admin.lapangan.destroy', $lapangan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-rose-500 hover:border-rose-500/40 rounded-lg transition" title="Hapus Lapangan">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-zinc-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="text-3xl">🏟️</span>
                                    <p class="font-bold text-zinc-400">Belum ada lapangan terdaftar</p>
                                    <p class="text-[10px]">Silakan tambahkan lapangan baru dengan menekan tombol di atas.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <x-admin.edit-lapangan-modal />
    <x-admin.create-lapangan-modal />
</div>
@endsection