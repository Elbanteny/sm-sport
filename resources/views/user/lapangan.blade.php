@extends('layouts.app')

@section('title', 'Daftar Lapangan Olahraga - SM Sport Center')

@section('content')
<!-- Header Page -->
<div class="border-b border-zinc-900 bg-zinc-900/30 py-10 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_-10%,rgba(163,230,53,0.08),rgba(255,255,255,0))] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="font-syne text-4xl sm:text-5xl font-black text-white leading-tight">
            DAFTAR LAPANGAN KAMI
        </h1>
        <p class="text-zinc-400 text-base max-w-xl mt-2 leading-relaxed">
            Pilih dan sewa lapangan olahraga terbaik dengan fasilitas premium untuk latihan rutin, sparing, atau turnamen Anda.
        </p>
    </div>
</div>

<!-- Search & Filter Area (Dynamic Form) -->
<section class="py-10 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ url('/lapangan') }}" method="GET" class="p-6 sm:p-8 rounded-3xl bg-zinc-900 border border-zinc-800/80 shadow-2xl relative overflow-hidden">
            <!-- Decorative light overlay -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-lime-400/5 rounded-full blur-2xl pointer-events-none"></div>
            
            <h3 class="font-syne text-lg font-bold text-white mb-5 flex items-center gap-2">
                <span class="text-lime-400">🔍</span> Cari & Saring Lapangan
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <!-- Search bar -->
                <div class="md:col-span-5 relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukkan nama lapangan..." class="w-full pl-5 pr-12 py-3.5 bg-zinc-950 border border-zinc-800 rounded-2xl text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-lime-400 transition-colors">
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-600 text-sm pointer-events-none">
                        ⌨️
                    </span>
                </div>
                <!-- Category Filter -->
                <div class="md:col-span-3">
                    <select name="category" class="w-full px-5 py-3.5 bg-zinc-950 border border-zinc-800 rounded-2xl text-zinc-300 focus:outline-none focus:border-lime-400 transition-colors">
                        <option value="">Semua Kategori</option>
                        <option value="futsal" {{ request('category') == 'futsal' ? 'selected' : '' }}>Futsal</option>
                        <option value="badminton" {{ request('category') == 'badminton' ? 'selected' : '' }}>Badminton</option>
                        <option value="basket" {{ request('category') == 'basket' ? 'selected' : '' }}>Basket</option>
                    </select>
                </div>
                <!-- Type Filter (Indoor/Outdoor) -->
                <div class="md:col-span-2">
                    <select name="type" class="w-full px-5 py-3.5 bg-zinc-950 border border-zinc-800 rounded-2xl text-zinc-300 focus:outline-none focus:border-lime-400 transition-colors">
                        <option value="">Semua Tipe</option>
                        <option value="indoor" {{ request('type') == 'indoor' ? 'selected' : '' }}>Indoor</option>
                        <option value="outdoor" {{ request('type') == 'outdoor' ? 'selected' : '' }}>Outdoor</option>
                    </select>
                </div>
                <!-- Submit button -->
                <div class="md:col-span-2">
                    <button type="submit" class="w-full py-3.5 bg-lime-400 text-zinc-950 font-bold rounded-2xl transition-all duration-300 hover:bg-lime-300 active:scale-95 glow-lime glow-lime-hover cursor-pointer">
                        Cari Arena
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Fields Grid -->
<section class="pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Info count -->
        <div class="flex justify-between items-center mb-8 pb-4 border-b border-zinc-900">
            <p class="text-sm text-zinc-400">Menampilkan <span class="text-white font-bold">{{ $lapangans->count() }}</span> Lapangan Olahraga</p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-lime-400"></span>
                <span class="text-xs text-zinc-400 font-semibold uppercase tracking-wider">Semua Lapangan Aktif</span>
            </div>
        </div>

        <!-- Grid Loop Data Dinamis -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($lapangans as $lapangan)
                <x-field-card 
                    :title="$lapangan->nama_lapangan"
                    :category="$lapangan->kategori"
                    :type="$lapangan->tipe"
                    :image="$lapangan->image_url"
                    :price="number_format($lapangan->tarif_per_jam, 0, ',', '.')"
                    :rating="$lapangan->rating"
                    :reviews="$lapangan->reviews"
                    :badge="$lapangan->badge"
                    :description="$lapangan->deskripsi"
                    :facilities="$lapangan->facilities" 
                    :isRented="$lapangan->sedang_disewa"
                    :bookingUrl="$lapangan->sedang_disewa ? '#' : url('/pemesanan?lapangan=' . $lapangan->id)"
        />
                
            @empty
                <!-- Tampilan jika pencarian tidak ditemukan -->
                <div class="col-span-1 md:col-span-2 text-center py-16 bg-zinc-900/20 border border-zinc-800 rounded-3xl backdrop-blur-md">
                    <span class="text-4xl">📭</span>
                    <h3 class="font-syne text-lg font-bold text-white mt-4">Lapangan Tidak Ditemukan</h3>
                    <p class="text-sm text-zinc-500 mt-1">Coba gunakan kata kunci pencarian atau kombinasi filter lain.</p>
                    <a href="{{ url('/lapangan') }}" class="inline-block mt-4 text-xs font-bold text-lime-400 hover:underline">&larr; Reset Pencarian</a>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection