@extends('layouts.admin')

@section('title', 'Pengaturan Profil Admin')

@section('admin_content')
<div class="space-y-8">
    
    <!-- Flash Alert Message -->
    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-400 text-xs flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 bg-rose-500/10 border border-rose-500/20 rounded-2xl text-rose-400 text-xs">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Top Profile Header Info -->
    <div class="bg-zinc-950/40 border border-zinc-800 rounded-3xl p-6 sm:p-8 flex flex-col sm:flex-row items-center gap-6">
        <!-- Avatar Indikator Ruang -->
        <div class="w-20 h-20 rounded-2xl bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center text-zinc-950 font-syne text-2xl font-black tracking-wider shadow-lg shadow-lime-500/10 shrink-0">
            {{ $initials }}
        </div>
        <div class="text-center sm:text-left">
            <span class="px-2.5 py-1 rounded-md bg-zinc-900 text-[10px] font-bold text-lime-400 uppercase tracking-widest border border-zinc-800">
                {{ $user->role }} MODE
            </span>
            <h1 class="font-syne text-2xl font-black text-white mt-2 uppercase tracking-wide">
                {{ $user->name }}
            </h1>
            <p class="text-zinc-500 text-xs mt-1">Sistem Otentikasi Utama Administrator SM Sport Center. Amankan kredensial Anda secara teratur.</p>
        </div>
    </div>

    <!-- Grid Konten Utama Form -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        
        <!-- KOLOM KIRI: Pengaturan Nama Profil -->
        <div class="bg-zinc-950/40 border border-zinc-800 rounded-3xl p-6 sm:p-8 space-y-6">
            <div class="border-b border-zinc-900 pb-4">
                <h2 class="font-syne text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-lime-400 rounded-full"></span>
                    Ubah Identitas Admin
                </h2>
                <p class="text-[10px] text-zinc-500 mt-1">Perbarui nama lengkap resmi Anda yang akan tertera pada log sistem.</p>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Input Nama -->
                <x-form.input 
                    name="name" 
                    type="text"
                    label="Nama Lengkap Administrator" 
                    value="{{ old('name', $user->name) }}"
                    placeholder="Nama lengkap Anda" 
                    required 
                />

                <!-- Info Email  -->
                <div class="opacity-50 cursor-not-allowed">
                    <x-form.input 
                        name="email_display" 
                        type="email"
                        label="Alamat Email Kredensial (Tidak Dapat Diubah)" 
                        value="{{ $user->email }}"
                        disabled
                    />
                </div>

                <div class="pt-2">
                    <x-form.button type="submit">
                        Simpan Nama Baru
                    </x-form.button>
                </div>
            </form>
        </div>

        <!-- KOLOM KANAN: Form Ganti Password Keamanan -->
        <div class="bg-zinc-950/40 border border-zinc-800 rounded-3xl p-6 sm:p-8 space-y-6">
            <div class="border-b border-zinc-900 pb-4">
                <h2 class="font-syne text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-rose-500 rounded-full"></span>
                    Pembaruan Kata Sandi
                </h2>
                <p class="text-[10px] text-zinc-500 mt-1">Wajib perbarui password Anda secara berkala untuk menjaga keamanan panel kontrol.</p>
            </div>

            <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-4">
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
                    placeholder="Minimal 8 karakter unik" 
                    required 
                />

                <x-form.input 
                    name="password_confirmation" 
                    type="password"
                    label="Konfirmasi Keamanan Password Baru" 
                    placeholder="Ulangi masukan enkripsi password baru" 
                    required 
                />

                <div class="pt-2">
                    <button type="submit" class="w-full rounded-xl bg-zinc-900 border border-zinc-800 hover:border-rose-500/40 hover:bg-rose-500/5 text-rose-400 px-4 py-3.5 text-xs font-bold active:scale-[0.98] transition cursor-pointer uppercase tracking-wider font-syne">
                        Perbarui Secure Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection