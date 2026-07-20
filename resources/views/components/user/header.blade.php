<!-- Header / Navbar -->
<header class="sticky top-0 z-50 glass border-b border-zinc-800/80 transition-all duration-300" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-2 group">
            <div class="w-10 h-10 rounded-xl bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center font-black text-zinc-950 text-xl transform group-hover:rotate-6 transition-transform duration-300">
                SM
            </div>
            <div class="flex flex-col">
                <span class="font-syne text-xl tracking-tight text-white group-hover:text-lime-400 transition-colors duration-300">SM SPORT</span>
                <span class="text-[10px] text-zinc-400 uppercase tracking-widest -mt-1">Center & Arena</span>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center gap-8">
            <a href="{{ url('/') }}" class="text-sm font-semibold {{ request()->is('/') ? 'text-lime-400 hover:text-lime-300' : 'text-zinc-300 hover:text-white' }} transition-colors">Home</a>
            <a href="{{ url('/lapangan') }}" class="text-sm font-semibold {{ request()->is('lapangan*') ? 'text-lime-400 hover:text-lime-300' : 'text-zinc-300 hover:text-white' }} transition-colors">Lapangan</a>
            <a href="{{ url('/pemesanan') }}" class="text-sm font-semibold {{ request()->is('pemesanan*') ? 'text-lime-400 hover:text-lime-300' : 'text-zinc-300 hover:text-white' }} transition-colors">Pemesanan</a>
            <a href="{{ url('/kontak') }}" class="text-sm font-semibold {{ request()->is('kontak*') ? 'text-lime-400 hover:text-lime-300' : 'text-zinc-300 hover:text-white' }} transition-colors">Kontak</a>
        </nav>

        <!-- Auth Buttons -->
     <div class="hidden md:flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    @php
                        $nameWords = explode(' ', Auth::user()->name);
                        $navInitials = '';
                        if (count($nameWords) >= 2) {
                            $navInitials = strtoupper(substr($nameWords[0], 0, 1) . substr($nameWords[1], 0, 1));
                        } else {
                            $navInitials = strtoupper(substr(Auth::user()->name, 0, 2));
                        }
                    @endphp

                    <!-- Kotak Profil Baru Menuju /dashboard -->
                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 p-1.5 pr-4 bg-zinc-900 border border-zinc-800 hover:border-lime-400/50 rounded-xl transition-all duration-300 group">
                        <!-- Kotak Inisial Mini -->
                        <div class="w-8 h-8 rounded-lg bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center text-zinc-950 font-syne text-xs font-black tracking-wide">
                            {{ $navInitials }}
                        </div>
                        <!-- Nama User -->
                        <div class="flex flex-col text-left">
                            <span class="text-xs font-bold text-white group-hover:text-lime-400 transition-colors truncate max-w-30">
                                {{ Auth::user()->name }}
                            </span>
                            <span class="text-[9px] text-zinc-500 tracking-wider -mt-0.5">{{ Auth::user()->email }}</span>
                        </div>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-zinc-300 hover:text-white transition-colors px-4 py-2">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-2.5 bg-lime-400 text-zinc-950 rounded-xl text-sm font-bold tracking-wide hover:bg-lime-300 active:scale-95 transition-all duration-300 shadow-lg shadow-lime-400/20">
                            Daftar Sekarang
                        </a>
                    @endif
                @endauth
            @endif
        </div>

        <!-- Mobile Menu Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-zinc-400 hover:text-white focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-collapse class="md:hidden bg-zinc-950/95 border-b border-zinc-800 px-4 pt-2 pb-6 space-y-3" style="display: none;">
        <a href="{{ url('/') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->is('/') ? 'text-lime-400 bg-zinc-900' : 'text-zinc-300 hover:text-white hover:bg-zinc-900' }}">Home</a>
        <a href="{{ url('/lapangan') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->is('lapangan*') ? 'text-lime-400 bg-zinc-900' : 'text-zinc-300 hover:text-white hover:bg-zinc-900' }}">Lapangan</a>
        <a href="{{ url('/pemesanan') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->is('pemesanan*') ? 'text-lime-400 bg-zinc-900' : 'text-zinc-300 hover:text-white hover:bg-zinc-900' }}">Pemesanan</a>
        <a href="{{ url('/kontak') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->is('kontak*') ? 'text-lime-400 bg-zinc-900' : 'text-zinc-300 hover:text-white hover:bg-zinc-900' }}">Kontak</a>
        <hr class="border-zinc-800">
        @if (Route::has('login'))
            @auth
                <!-- Kotak Profil Mobile Menuju /dashboard -->
                <a href="{{ url('/dashboard') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3 p-2 bg-zinc-900 border border-zinc-800 rounded-xl text-white font-bold">
                    <div class="w-8 h-8 rounded-lg bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center text-zinc-950 font-syne text-xs font-black">
                        {{ $navInitials }}
                    </div>
                    <div class="flex flex-col text-left">
                        <span class="text-sm font-bold text-white truncate max-w-50">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-zinc-500 font-normal tracking-wider">{{ Auth::user()->email }}</span>
                    </div>
                </a>
            @else
                <a href="{{ route('login') }}" class="block text-center px-4 py-2.5 border border-zinc-800 text-zinc-300 rounded-lg font-bold hover:text-white">
                    Masuk
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="block text-center px-4 py-2.5 bg-lime-400 text-zinc-950 rounded-lg font-bold hover:bg-lime-300">
                        Daftar Sekarang
                    </a>
                @endif
            @endauth
        @endif
    </div>
</header>
