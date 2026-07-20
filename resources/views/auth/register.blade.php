@extends('layouts.auth')

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="space-y-6">
    <div class="text-center sm:text-left">
        <h2 class="font-syne text-2xl font-black text-white tracking-wide uppercase">
            DAFTAR <span class="text-transparent bg-clip-text bg-linear-to-r from-lime-400 to-emerald-400">AKUN</span>
        </h2>
        <p class="mt-1 text-sm text-zinc-400">Buat akun untuk kemudahan track riwayat pemesanan.</p>
    </div>
    <!-- Alert Error -->
@if($errors->any())
    <div class="p-4 bg-rose-500/10 border border-rose-500/30 rounded-2xl text-rose-400 text-xs">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Alert Sukses (Untuk Register sukses) -->
@if(session('success'))
    <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-emerald-400 text-xs">
        {{ session('success') }}
    </div>
@endif
    <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
        @csrf
        
        <x-form.input 
            name="name" 
            type="text"
            label="Nama Lengkap" 
            placeholder="Nama lengkap Anda" 
            required 
        />

        <x-form.input 
            name="email" 
            type="email"
            label="Alamat Email" 
            placeholder="nama@email.com" 
            required 
        />


         <x-form.input 
            name="phone_number" 
            type="text"
            label="Nomor Telepon" 
            placeholder="081234567890" 
            required 
        />

        <x-form.input 
            name="password" 
            type="password"
            label="Password" 
            placeholder="Minimal 8 karakter" 
            required 
        />

        <x-form.input 
            name="password_confirmation" 
            type="password"
            label="Konfirmasi Password" 
            placeholder="Ulangi password" 
            required 
        />

        <button type="submit" class="w-full mt-2 rounded-xl bg-linear-to-r from-lime-400 to-emerald-500 px-4 py-3 text-sm font-bold text-zinc-950 shadow-md hover:opacity-90 active:scale-[0.98] transition dynamic-viewport cursor-pointer uppercase tracking-wider font-syne">
            Registrasi Sekarang
        </button>
    </form>

    <div class="text-center text-sm text-zinc-400 pt-2 border-t border-zinc-800/60">
        Sudah memiliki akun? 
        <a href="{{ route('login') }}" class="font-bold text-lime-400 hover:text-emerald-400 transition">Login</a>
    </div>
</div>
@endsection