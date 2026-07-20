<!DOCTYPE html>
<html lang="id" class="h-full bg-zinc-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - SM Sport Center</title>
    
    <!-- Google Fonts & Tailwind -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-syne {
            font-family: 'Syne', sans-serif;
        }
    </style>
</head>
<body class="h-full text-zinc-300 antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR (Desktop) -->
        <aside class="hidden lg:flex lg:flex-col lg:w-72 bg-zinc-900 border-r border-zinc-800/80 shrink-0 h-full justify-between p-6">
            <div class="space-y-8">
                <!-- Logo & Brand -->
                <a href="{{ url('/') }}" class="flex items-center gap-2 group px-2">
                    <div class="w-10 h-10 rounded-xl bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center font-black text-zinc-950 text-xl transform group-hover:rotate-6 transition-transform duration-300">
                        SM
                    </div>
                    <div class="flex flex-col">
                        <span class="font-syne text-xl tracking-tight text-white group-hover:text-lime-400 transition-colors duration-300">SM SPORT</span>
                        <span class="text-[10px] text-zinc-500 uppercase tracking-widest -mt-1">ADMIN PORTAL</span>
                    </div>
                </a>

                <!-- Navigation Links -->
                <nav class="space-y-1.5">
                    <p class="text-[10px] font-bold text-zinc-600 uppercase tracking-widest px-3 mb-2">Main Menu</p>
                    
                    <!-- Home / Beranda -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-lime-400 text-zinc-950 shadow-lg shadow-lime-400/10' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Beranda
                    </a>

                    <!-- Daftar Lapangan -->
                    <a href="{{ route('admin.lapangan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.lapangan*') ? 'bg-lime-400 text-zinc-950 shadow-lg shadow-lime-400/10' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Daftar Lapangan
                    </a>

                    <!-- Lapangan yang Disewa -->
                    <a href="{{ route('admin.sewa') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.sewa*') ? 'bg-lime-400 text-zinc-950 shadow-lg shadow-lime-400/10' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Lapangan Di-Sewa
                    </a>

                    <!-- Profil Saya (Baru Ditambahkan) -->
                    <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.profile*') ? 'bg-lime-400 text-zinc-950 shadow-lg shadow-lime-400/10' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil Saya
                    </a>
                </nav>
            </div>

            <!-- Profile Admin di Paling Bawah Sidebar (Diubah menjadi Link Aktif) -->
            <div class="border-t border-zinc-800/80 pt-4 flex items-center justify-between gap-3">
                <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 overflow-hidden group/profile-btn" title="Lihat Profil">
                    <!-- Avatar Mini Bulat -->
                    <div class="w-10 h-10 rounded-xl bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center text-zinc-950 font-syne text-sm font-black shrink-0 transition group-hover/profile-btn:scale-105">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <!-- Info Nama & Email -->
                    <div class="flex flex-col text-left overflow-hidden">
                        <span class="text-sm font-bold text-white truncate max-w-[130px] transition group-hover/profile-btn:text-lime-400">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-zinc-500 truncate max-w-[130px]">{{ Auth::user()->email }}</span>
                    </div>
                </a>

                <!-- Tombol Logout Minimalis -->
                <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                    @csrf
                    <button type="submit" class="p-2 rounded-lg bg-zinc-950 border border-zinc-800 hover:border-rose-500/30 text-zinc-500 hover:text-rose-400 transition cursor-pointer" title="Keluar">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- SIDEBAR MOBILE (Diaktifkan lewat tombol toggle burger) -->
        <div x-show="sidebarOpen" class="fixed inset-0 z-40 lg:hidden flex" style="display: none;">
            <!-- Backdrop -->
            <div @click="sidebarOpen = false" class="fixed inset-0 bg-zinc-950/80 backdrop-blur-sm"></div>
            
            <aside class="relative flex flex-col w-72 bg-zinc-900 border-r border-zinc-800 h-full justify-between p-6 z-50">
                <div class="space-y-8">
                    <div class="flex items-center justify-between">
                        <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                            <div class="w-9 h-9 rounded-xl bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center font-black text-zinc-950 text-lg">
                                SM
                            </div>
                            <span class="font-syne text-lg font-black tracking-tight text-white">SM SPORT</span>
                        </a>
                        <button @click="sidebarOpen = false" class="text-zinc-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <nav class="space-y-1.5">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-lime-400 text-zinc-950' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                            Beranda
                        </a>
                        <a href="{{ route('admin.lapangan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.lapangan*') ? 'bg-lime-400 text-zinc-950' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                            Daftar Lapangan
                        </a>
                        <a href="{{ route('admin.sewa') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.sewa*') ? 'bg-lime-400 text-zinc-950' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                            Lapangan Di-Sewa
                        </a>
                        <!-- Link Profil Mobile -->
                        <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.profile*') ? 'bg-lime-400 text-zinc-950' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                            Profil Saya
                        </a>
                    </nav>
                </div>

                <!-- Profile Admin Mobile (Diubah menjadi Link Aktif) -->
                <div class="border-t border-zinc-800 pt-4 flex items-center justify-between gap-3">
                    <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 group/profile-btn-mob overflow-hidden">
                        <div class="w-10 h-10 rounded-xl bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center text-zinc-950 font-syne text-sm font-black shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="flex flex-col text-left overflow-hidden">
                            <span class="text-sm font-bold text-white truncate max-w-30 group-hover/profile-btn-mob:text-lime-400 transition">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] text-zinc-500 truncate max-w-30">{{ Auth::user()->email }}</span>
                        </div>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 rounded-lg bg-zinc-950 border border-zinc-800 text-zinc-400 hover:text-rose-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4M17 12H3" />
                            </svg>
                        </button>
                    </form>
                </div>
            </aside>
        </div>

        <!-- MAIN WINDOW CONTAINER -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- TOPBAR (Mobile Header) -->
            <header class="flex items-center justify-between lg:hidden px-6 h-16 bg-zinc-900 border-b border-zinc-800/80 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center font-black text-zinc-950 text-sm">
                        SM
                    </div>
                    <span class="font-syne text-base font-black text-white">SM SPORT</span>
                </div>
                <button @click="sidebarOpen = true" class="text-zinc-400 hover:text-white p-1">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </header>

            <!-- MAIN CONTENT WRAPPER -->
            <main class="flex-1 overflow-y-auto bg-zinc-950 p-6 sm:p-8 lg:p-10 custom-scrollbar">
                
                <!-- Inner Layout wrapper -->
                <div class="max-w-7xl mx-auto space-y-8">
                    
                    <!-- Top Welcome Banner -->
                    <div class="bg-zinc-900 border border-zinc-800/80 rounded-3xl p-6 sm:p-8 flex items-center justify-between relative overflow-hidden">
                        <!-- Dekorasi Pattern Background halus -->
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-lime-400/10 rounded-full blur-3xl"></div>
                        
                        <div class="space-y-1 relative z-10">
                            <h1 class="font-syne text-2xl sm:text-3xl font-black text-white uppercase tracking-wide">
                                Selamat Datang, <span class="text-transparent bg-clip-text bg-linear-to-r from-lime-400 to-emerald-400">Admin</span>!
                            </h1>
                            <p class="text-zinc-400 text-xs sm:text-sm">Kelola aset lapangan, periksa penyewaan masuk, dan kendalikan operasional portal secara real-time.</p>
                        </div>
                    </div>

                    <!-- Inner Card Dynamic Content -->
                    <div class="bg-zinc-900 border border-zinc-800/80 rounded-3xl p-6 sm:p-8 shadow-xl shadow-black/30">
                        @yield('admin_content')
                    </div>

                </div>
            </main>
        </div>

    </div>

</body>
</html>