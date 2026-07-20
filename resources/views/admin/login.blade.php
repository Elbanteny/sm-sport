@extends('layouts.auth')

@section('title', 'Admin Area Login')

@section('content')
<div class="space-y-6">
    <div class="text-center sm:text-left border-b border-zinc-800/80 pb-4">
        <h2 class="font-syne text-2xl font-black text-white tracking-wide uppercase flex items-center justify-center sm:justify-start gap-2">
            <span class="w-1.5 h-6 bg-rose-500 rounded-full"></span>
            ADMIN <span class="text-rose-500">PANEL</span>
        </h2>
        <p class="mt-1 text-sm text-zinc-400">Otorisasi khusus untuk staf dan administrator pusat.</p>
    </div>
    
    <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
        @csrf
        
        <x-form.input 
            name="username" 
            type="text"
            label="Username Admin" 
            placeholder="Masukkan ID staff" 
            required 
        />

        <x-form.input 
            name="password" 
            type="password"
            label="Security Password" 
            placeholder="••••••••" 
            required 
        />

        <button type="submit" class="w-full mt-2 rounded-xl bg-linear-to-r from-rose-600 to-red-700 px-4 py-3 text-sm font-bold text-white shadow-md hover:opacity-90 active:scale-[0.98] transition dynamic-viewport cursor-pointer uppercase tracking-wider font-syne">
            Secure Login &rarr;
        </button>
    </form>

    <div class="text-center text-xs pt-2">
        <a href="{{ route('login') }}" class="text-zinc-500 hover:text-zinc-300 transition">
            &larr; Kembali ke Portal User
        </a>
    </div>
</div>
@endsection