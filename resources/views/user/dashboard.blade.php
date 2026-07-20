@extends('layouts.app')

@section('title', 'Dashboard Member - SM Sport Center')

@section('content')
<div class="min-h-screen bg-zinc-950 pt-28 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Flash Alert Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-emerald-400 text-sm flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/30 rounded-2xl text-rose-400 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Dashboard Header & Top Profile Info -->
        <div class="bg-zinc-900 border border-zinc-800/80 rounded-3xl p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 mb-10">
            <div class="flex flex-col sm:flex-row items-center gap-6">
                <!-- Avatar: 2 Huruf Pertama -->
                <div class="w-20 h-20 rounded-2xl bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center text-zinc-950 font-syne text-2xl font-black tracking-wider shadow-lg shadow-lime-500/10 shrink-0">
                    {{ $initials }}
                </div>
                <div class="text-center sm:text-left">
                    <span class="px-2.5 py-1 rounded-md bg-zinc-800 text-xs font-bold text-lime-400 uppercase tracking-widest border border-zinc-700/60">
                        {{ strtoupper($user->role) }} MEMBER
                    </span>
                    <h1 class="font-syne text-2xl sm:text-3xl font-black text-white mt-2 uppercase tracking-wide">
                        Selamat Datang, <span class="text-transparent bg-clip-text bg-linear-to-r from-lime-400 to-emerald-400">{{ $user->name }}</span>!
                    </h1>
                    <p class="text-zinc-400 text-sm mt-1">Kelola informasi akun Anda dan pantau riwayat sewa lapangan secara berkala.</p>
                </div>
            </div>

            <!-- Tombol Logout di Header (Desktop & Tablet) -->
            <form action="{{ route('logout') }}" method="POST" class="shrink-0 w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-zinc-950 border border-zinc-800 hover:border-rose-500/30 hover:bg-rose-500/5 text-zinc-400 hover:text-rose-400 text-sm font-bold tracking-wide transition-all duration-300 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout Akun
                </button>
            </form>
        </div>

        <!-- Grid Content -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- KIRI: Pengaturan Akun & Ganti Password -->
            <div class="lg:col-span-5 space-y-10">
                
                <!-- Box 1: Form Pengaturan Profil -->
                <div class="bg-zinc-900 border border-zinc-800/80 rounded-3xl p-6 sm:p-8 space-y-6">
                    <div class="border-b border-zinc-800 pb-4">
                        <h2 class="font-syne text-lg font-bold text-white uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1 h-4 bg-lime-400 rounded-full"></span>
                            Pengaturan Profil
                        </h2>
                        <p class="text-xs text-zinc-500 mt-1">Ubah identitas dasar akun yang Anda gunakan untuk pemesanan.</p>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <x-form.input 
                            name="name" 
                            type="text"
                            label="Nama Lengkap" 
                            value="{{ old('name', $user->name) }}"
                            placeholder="Nama lengkap Anda" 
                            required 
                        />

                        <x-form.input 
                            name="email" 
                            type="email"
                            label="Alamat Email" 
                            value="{{ old('email', $user->email) }}"
                            placeholder="nama@email.com" 
                            required 
                        />

                        <x-form.input 
                            name="phone" 
                            type="text"
                            label="Nomor WhatsApp/Telepon" 
                            value="{{ old('phone', $user->phone) }}"
                            placeholder="081234567890" 
                            required 
                        />

                        <button type="submit" class="w-full mt-4 rounded-xl bg-linear-to-r from-lime-400 to-emerald-500 px-4 py-3 text-sm font-bold text-zinc-950 shadow-md hover:opacity-90 active:scale-[0.98] transition cursor-pointer uppercase tracking-wider font-syne">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Box 2: Form Ganti Password -->
                <div class="bg-zinc-900 border border-zinc-800/80 rounded-3xl p-6 sm:p-8 space-y-6">
                    <div class="border-b border-zinc-800 pb-4">
                        <h2 class="font-syne text-lg font-bold text-white uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1 h-4 bg-rose-500 rounded-full"></span>
                            Ganti Password
                        </h2>
                        <p class="text-xs text-zinc-500 mt-1">Amankan akun Anda dengan melakukan pembaruan kata sandi berkala.</p>
                    </div>

                    <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <x-form.input 
                            name="current_password" 
                            type="password"
                            label="Password Saat Ini" 
                            placeholder="••••••••" 
                            required 
                        />

                        <x-form.input 
                            name="password" 
                            type="password"
                            label="Password Baru" 
                            placeholder="Minimal 8 karakter" 
                            required 
                        />

                        <x-form.input 
                            name="password_confirmation" 
                            type="password"
                            label="Konfirmasi Password Baru" 
                            placeholder="Ulangi password baru" 
                            required 
                        />

                        <button type="submit" class="w-full mt-4 rounded-xl bg-zinc-950 border border-zinc-800 hover:border-rose-500/50 hover:bg-rose-500/5 text-rose-400 px-4 py-3 text-sm font-bold shadow-md active:scale-[0.98] transition cursor-pointer uppercase tracking-wider font-syne">
                            Perbarui Password
                        </button>
                    </form>
                </div>

            </div>

            <!-- KANAN: Riwayat Pemesanan Lapangan -->
            <div class="lg:col-span-7 bg-zinc-900 border border-zinc-800/80 rounded-3xl p-6 sm:p-8 space-y-6">
                <div class="border-b border-zinc-800 pb-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                    <div>
                        <h2 class="font-syne text-lg font-bold text-white uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1 h-4 bg-emerald-400 rounded-full"></span>
                            Riwayat Sewa Lapangan
                        </h2>
                        <p class="text-xs text-zinc-500 mt-1">Data jadwal penyewaan yang pernah atau sedang aktif Anda ajukan.</p>
                    </div>
                    <span class="text-xs font-bold text-zinc-400 bg-zinc-800 px-3 py-1.5 rounded-lg border border-zinc-700/60">
                        Total: {{ $reservations->count() }} Transaksi
                    </span>
                </div>

                <!-- List Transaksi -->
                <div class="space-y-4 max-h-175 overflow-y-auto pr-2 custom-scrollbar">
                    @forelse($reservations as $res)
                        <div class="p-5 rounded-2xl bg-zinc-950/60 border border-zinc-800 hover:border-zinc-700/80 transition flex flex-col sm:flex-row justify-between gap-4 items-start sm:items-center">
                            
                            <!-- Detail Lapangan & Jadwal -->
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <h4 class="font-syne font-bold text-white text-base">
                                        {{ $res->lapangan->nama_lapangan ?? 'Lapangan Terhapus' }}
                                    </h4>
                                    <span class="text-[10px] px-2 py-0.5 bg-zinc-800 border border-zinc-700 text-zinc-400 rounded-md font-medium uppercase">
                                        {{ $res->lapangan->tipe ?? '-' }}
                                    </span>
                                </div>
                                
                                <p class="text-xs text-zinc-400 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-lime-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($res->tanggal)->translatedFormat('d F Y') }}
                                </p>
                                
                                <p class="text-xs text-zinc-500 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ substr($res->jam_mulai, 0, 5) }} - {{ substr($res->jam_selesai, 0, 5) }} WIB
                                </p>
                            </div>

                            <!-- Status & Harga -->
                            <div class="flex sm:flex-col justify-between sm:justify-center items-center sm:items-end gap-2 w-full sm:w-auto pt-3 sm:pt-0 border-t sm:border-t-0 border-zinc-800/60">
                                <span class="font-syne font-black text-sm text-white">
                                    Rp {{ number_format($res->total_harga, 0, ',', '.') }}
                                </span>
                                
                                <!-- Status Badge Mapping -->
                                @if($res->status === 'pending')
                                    <span class="px-2.5 py-1 text-[10px] font-bold text-amber-400 bg-amber-400/10 border border-amber-500/30 rounded-full uppercase tracking-wide">
                                        ⏱️ Pending
                                    </span>
                                @elseif($res->status === 'disetujui')
                                    <span class="px-2.5 py-1 text-[10px] font-bold text-emerald-400 bg-emerald-400/10 border border-emerald-500/30 rounded-full uppercase tracking-wide">
                                        ✅ Disetujui
                                    </span>
                                @elseif($res->status === 'selesai')
                                    <span class="px-2.5 py-1 text-[10px] font-bold text-blue-400 bg-blue-400/10 border border-blue-500/30 rounded-full uppercase tracking-wide">
                                        🏆 Selesai
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 text-[10px] font-bold text-rose-400 bg-rose-400/10 border border-rose-500/30 rounded-full uppercase tracking-wide">
                                        ❌ Dibatalkan
                                    </span>
                                @endif
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-12 text-zinc-500 text-sm bg-zinc-950/30 border border-dashed border-zinc-800 rounded-2xl">
                            <p>Anda belum pernah melakukan reservasi lapangan.</p>
                            <a href="{{ url('/lapangan') }}" class="text-lime-400 font-bold hover:underline text-xs mt-2 inline-block">Mulai sewa sekarang &rarr;</a>
                        </div>
                    @endforelse
                </div>

            </div>

        </div>

    </div>
</div>
@endsection