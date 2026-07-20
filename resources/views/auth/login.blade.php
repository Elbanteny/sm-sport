@extends('layouts.auth')

@section('title', 'Login Pengguna')

@section('content')
<div class="space-y-6">
    <div class="text-center sm:text-left">
        <h2 class="font-syne text-2xl font-black text-white tracking-wide uppercase">
            SIGN <span class="text-transparent bg-clip-text bg-linear-to-r from-lime-400 to-emerald-400">IN</span>
        </h2>
        <p class="mt-1 text-sm text-zinc-400">Silakan masuk untuk melanjutkan reservasi lapangan.</p>
    </div>
    
    <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
        @csrf
        
        <x-form.input 
            name="email" 
            type="email"
            label="Alamat Email" 
            placeholder="nama@email.com" 
            required 
        />

        <x-form.input 
            name="password" 
            type="password"
            label="Password" 
            placeholder="••••••••" 
            required 
        />

        <button type="submit" class="w-full mt-2 rounded-xl bg-linear-to-r from-lime-400 to-emerald-500 px-4 py-3 text-sm font-bold text-zinc-950 shadow-md hover:opacity-90 active:scale-[0.98] transition dynamic-viewport cursor-pointer uppercase tracking-wider font-syne">
            Masuk
        </button>
    </form>

    <div class="text-center text-sm text-zinc-400 pt-2 border-t border-zinc-800/60">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="font-bold text-lime-400 hover:text-emerald-400 transition">Daftar di sini</a>
    </div>
</div>
@endsection