@extends('layouts.app')

@section('title', 'SM Sport Center - Reservasi Lapangan Olahraga Premium')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center justify-center pt-10 pb-20 overflow-hidden">
    <!-- Background Gradients & Mesh -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(163,230,53,0.15),rgba(255,255,255,0))] pointer-events-none"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-lime-400/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <!-- Text Content -->
        <div class="lg:col-span-7 flex flex-col items-start text-left">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-zinc-900 border border-zinc-800 text-xs font-bold text-lime-400 mb-6 uppercase tracking-wider">
                <span class="w-2 h-2 rounded-full bg-lime-400 animate-ping"></span>
                Sistem Reservasi Online Tercepat
            </span>
            <h1 class="font-syne text-5xl sm:text-6xl xl:text-7xl font-extrabold text-white leading-[1.1] mb-6">
                PILIH LAPANGAN,<br>
                <span class="text-transparent bg-clip-text bg-linear-to-r from-lime-400 via-emerald-400 to-cyan-400">MAIN SEKARANG!</span>
            </h1>
            <p class="text-zinc-400 text-lg sm:text-xl max-w-xl mb-8 leading-relaxed">
                Rasakan kemudahan memesan lapangan olahraga futsal, badminton, basket, dan tenis secara real-time. Fasilitas premium, proses instan, dan jaminan jadwal pasti.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <a href="/lapangan" class="inline-flex items-center justify-center px-8 py-4 bg-lime-400 text-zinc-950 font-bold text-base rounded-xl transition-all duration-300 hover:bg-lime-300 active:scale-95 glow-lime glow-lime-hover">
                    Pesan Lapangan
                    <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                <a href="#cara-kerja" class="inline-flex items-center justify-center px-8 py-4 bg-zinc-900 border border-zinc-800 hover:border-zinc-700 text-zinc-200 hover:text-white font-bold text-base rounded-xl transition-all duration-300">
                    Bagaimana Cara Kerja?
                </a>
            </div>

            <!-- Trust Stats -->
            <div class="grid grid-cols-3 gap-8 mt-12 pt-8 border-t border-zinc-800/80 w-full max-w-lg">
                <div>
                    <p class="font-syne text-3xl font-black text-white">10+</p>
                    <p class="text-xs text-zinc-500 uppercase tracking-wider font-semibold mt-1">Lapangan Premium</p>
                </div>
                <div>
                    <p class="font-syne text-3xl font-black text-white">5K+</p>
                    <p class="text-xs text-zinc-500 uppercase tracking-wider font-semibold mt-1">Pengguna Aktif</p>
                </div>
                <div>
                    <p class="font-syne text-3xl font-black text-white">99.8%</p>
                    <p class="text-xs text-zinc-500 uppercase tracking-wider font-semibold mt-1">Jadwal Tepat Waktu</p>
                </div>
            </div>
        </div>

        <!-- Graphic/Image Content (DYNAMIC HERO FIELD) -->
        <div class="lg:col-span-5 relative flex justify-center items-center">
            <div class="absolute inset-0 bg-linear-to-br from-lime-400/20 to-emerald-500/20 rounded-3xl blur-2xl transform rotate-3"></div>
            
            @if($popularField)
                <div class="relative w-full max-w-md aspect-4/5 rounded-3xl overflow-hidden border border-zinc-800 shadow-2xl bg-zinc-900 group">
                    <img src="{{ $popularField->image_url }}" 
                         alt="{{ $popularField->nama_lapangan }}" 
                         class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700 ease-out brightness-90 group-hover:brightness-100">
                    
                    <!-- Overlay Card (Glassmorphic) -->
                    <div class="absolute bottom-6 left-6 right-6 p-5 rounded-2xl glass border border-white/10 flex items-center justify-between shadow-xl">
                        <div>
                            <p class="text-xs text-lime-400 font-bold uppercase tracking-wider">⭐ {{ $popularField->rating }} Terpopuler</p>
                            <h4 class="font-syne text-lg font-bold text-white mt-0.5">{{ $popularField->nama_lapangan }}</h4>
                            <div class="flex items-center gap-1.5 mt-1 text-zinc-400 text-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                {{ $popularField->kategori }} - {{ $popularField->tipe }}
                            </div>
                        </div>
                        <a href="{{ $popularField->sedang_disewa ? '#' : url('/pemesanan?lapangan=' . $popularField->id) }}" 
                           class="px-3.5 py-2 bg-lime-400 text-zinc-950 font-extrabold rounded-lg text-sm hover:bg-lime-300 transition-colors">
                            Booking Sekarang
                        </a>
                    </div>
                </div>
            @else
                <!-- Fallback Static Hero if Database is Empty -->
                <div class="relative w-full max-w-md aspect-4/5 rounded-3xl overflow-hidden border border-zinc-800 shadow-2xl bg-zinc-900 group">
                    <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&q=80&w=800" 
                         alt="Sports Arena" 
                         class="w-full h-full object-cover">
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Kirim data $topFields ke komponen sportsCategory -->
<x-user.sportsCategory :fields="$topFields" />

<x-user.whyChooseUs />

<x-user.bookingsteps />

<!-- Call to Action Section -->
<section class="py-20 relative overflow-hidden bg-linear-to-r from-lime-400 to-emerald-500 text-zinc-950">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_120%,rgba(255,255,255,0.2),transparent)]"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="font-syne text-4xl sm:text-5xl font-black tracking-tight leading-none mb-6">
            SIAP UNTUK BERMAIN?<br>PESAN SEKARANG SEBELUM KEHABISAN JADWAL!
        </h2>
        <p class="text-zinc-900 text-lg sm:text-xl font-medium max-w-xl mx-auto mb-10">
            Jadwal lapangan futsal & badminton kami sangat padat di jam pulang kantor. Segera amankan slot bermain Anda!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ url('/lapangan') }}" class="px-8 py-4 bg-zinc-950 text-white font-bold rounded-xl shadow-2xl transition-transform hover:scale-105 active:scale-95">
                Lihat Lapangan Tersedia
            </a>
        </div>
    </div>
</section>
@endsection