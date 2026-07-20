@extends('layouts.app')

@section('title', 'Kontak Kami - SM Sport Center')

@section('content')
<!-- Hero Section Kontak -->
<section class="relative min-h-[40vh] flex items-center justify-center pt-24 pb-12 overflow-hidden">
    <!-- Background Gradients & Mesh -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(163,230,53,0.12),rgba(255,255,255,0))] pointer-events-none"></div>
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-zinc-900 border border-zinc-800 text-xs font-bold text-lime-400 mb-4 uppercase tracking-wider">
            Hubungi Kami
        </span>
        <h1 class="font-syne text-3xl sm:text-4xl md:text-5xl font-extrabold text-white leading-tight mb-4">
            ADA PERTANYAAN?<br>
            <span class="text-transparent bg-clip-text bg-linear-to-r from-lime-400 via-emerald-400 to-cyan-400">KAMI SIAP MEMBANTU</span>
        </h1>
        <p class="text-zinc-400 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed">
            Punya kendala saat reservasi, ingin menanyakan detail fasilitas, atau tertarik untuk kerja sama korporat? Hubungi tim kami secara langsung melalui jalur di bawah ini.
        </p>
    </div>
</section>

<!-- Main Contact Section -->
<section class="pb-24 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Kolom Kiri: Informasi Kontak & Jam Operasional -->
            <div class="lg:col-span-5 flex flex-col gap-8">
                
                <!-- Kartu Informasi Kontak -->
                <div class="p-8 rounded-3xl border border-zinc-800 bg-zinc-900/50 backdrop-blur-md shadow-xl flex flex-col gap-6">
                    <h3 class="font-syne text-2xl font-bold text-white">Informasi Kontak</h3>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-xl shrink-0 text-lime-400">
                            📍
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-zinc-500 font-semibold mb-1">Alamat Fasilitas</p>
                            <p class="text-zinc-300 text-sm sm:text-base leading-relaxed">
                                Jl. Olahraga No. 45, Jakarta Selatan
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-xl shrink-0 text-emerald-400">
                            📞
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-zinc-500 font-semibold mb-1">Nomor Telepon / WhatsApp</p>
                            <a href="https://wa.me/6281234567890" target="_blank" class="text-zinc-300 text-sm sm:text-base hover:text-lime-400 transition-colors">
                                +62 812-3456-7890
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-xl shrink-0 text-cyan-400">
                            ✉️
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-zinc-500 font-semibold mb-1">Email Resmi</p>
                            <a href="mailto:info@smsportcenter.com" class="text-zinc-300 text-sm sm:text-base hover:text-lime-400 transition-colors">
                                info@smsportcenter.com
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kartu Jam Operasional -->
                <div class="p-8 rounded-3xl border border-zinc-800 bg-zinc-900/50 backdrop-blur-md shadow-xl flex flex-col gap-4 relative overflow-hidden group">
                    <div class="absolute -bottom-20 -right-20 w-48 h-48 bg-lime-400/5 rounded-full blur-3xl pointer-events-none"></div>
                    
                    <h3 class="font-syne text-2xl font-bold text-white mb-2">Jam Operasional</h3>
                    
                    <div class="flex justify-between items-center py-2 border-b border-zinc-800/60 text-sm">
                        <span class="text-zinc-400">Senin - Jumat</span>
                        <span class="text-white font-bold font-syne">07.00 - 23.00 WIB</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-zinc-800/60 text-sm">
                        <span class="text-zinc-400">Sabtu - Minggu</span>
                        <span class="text-white font-bold font-syne">06.00 - 24.00 WIB</span>
                    </div>
                    
                    <div class="pt-2 text-lime-400 flex items-center gap-2 text-sm font-semibold">
                        <span class="w-2.5 h-2.5 rounded-full bg-lime-400 animate-pulse"></span>
                        Tetap Buka di Hari Libur Nasional
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Tombol Aksi Cepat Kontak Langsung (Menggantikan Form Lama) -->
            <div class="lg:col-span-7">
                <div class="p-8 sm:p-10 rounded-3xl border border-zinc-800 bg-zinc-900/30 backdrop-blur-md shadow-2xl relative">
                    <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyan-500/5 rounded-full blur-3xl pointer-events-none"></div>
                    
                    <h3 class="font-syne text-2xl font-bold text-white mb-2">Kontak Kami</h3>
                    <p class="text-zinc-400 text-sm mb-8">
                        Klik salah satu opsi di bawah ini untuk langsung terhubung dengan Customer Service kami, tersedia selama jam kerja.
                    </p>

                    <div class="flex flex-col gap-4">
                        <!-- Aksi 1: Hubungi via WhatsApp -->
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20SM%20Sport%20Center,%20saya%20ingin%20bertanya%20mengenai%20reservasi%20lapangan." 
                           target="_blank" 
                           class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 rounded-2xl border border-zinc-800 bg-zinc-950/40 hover:bg-zinc-900/60 hover:border-emerald-500/40 transition-all duration-300 group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-xl text-emerald-400 group-hover:scale-110 transition-transform">
                                    💬
                                </div>
                                <div>
                                    <h4 class="font-syne font-bold text-white text-base">Chat WhatsApp Resmi</h4>
                                    <p class="text-zinc-400 text-xs mt-0.5">Konsultasi jadwal & kendala pembayaran instan.</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-400 bg-emerald-500/10 px-3 py-1.5 rounded-xl border border-emerald-500/20 group-hover:bg-emerald-500 group-hover:text-black transition-colors">
                                Chat Sekarang →
                            </span>
                        </a>

                        <!-- Aksi 2: Hubungi via Email resmi -->
                        <a href="mailto:info@smsportcenter.com?subject=Tanya%20Fasilitas%20/%20Kerjasama%20SM%20Sport%20Center" 
                           class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 rounded-2xl border border-zinc-800 bg-zinc-950/40 hover:bg-zinc-900/60 hover:border-cyan-500/40 transition-all duration-300 group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-xl text-cyan-400 group-hover:scale-110 transition-transform">
                                    ✉️
                                </div>
                                <div>
                                    <h4 class="font-syne font-bold text-white text-base">Email Korporat & Event</h4>
                                    <p class="text-zinc-400 text-xs mt-0.5">Untuk kebutuhan sewa event besar atau kerjasama institusi.</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-cyan-400 bg-cyan-500/10 px-3 py-1.5 rounded-xl border border-cyan-500/20 group-hover:bg-cyan-500 group-hover:text-black transition-colors">
                                Kirim Email →
                            </span>
                        </a>

                        <!-- Aksi 3: Panggilan Telepon Langsung -->
                        <a href="tel:+6281234567890" 
                           class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 rounded-2xl border border-zinc-800 bg-zinc-950/40 hover:bg-zinc-900/60 hover:border-lime-500/40 transition-all duration-300 group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-lime-500/10 border border-lime-500/20 flex items-center justify-center text-xl text-lime-400 group-hover:scale-110 transition-transform">
                                    📞
                                </div>
                                <div>
                                    <h4 class="font-syne font-bold text-white text-base">Hotline Panggilan Suara</h4>
                                    <p class="text-zinc-400 text-xs mt-0.5">Hubungi CS via telepon seluler biasa untuk respon darurat.</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-lime-400 bg-lime-500/10 px-3 py-1.5 rounded-xl border border-lime-500/20 group-hover:bg-lime-400 group-hover:text-black transition-colors">
                                Telepon CS →
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Peta Lokasi (Google Maps Wireframe Style) -->
<section class="pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-3xl overflow-hidden border border-zinc-800 shadow-2xl bg-zinc-900 aspect-16/9 max-h-[450px] group">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.24156641525!2d106.74786795820313!3d-6.229746499999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i776!4f13.1!3m3!1m2!1s0x2e69f3e84a2b2e7d%3A0x2f6b86d9e0000000!2sJakarta%20Selatan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid" 
                class="w-full h-full border-0 brightness-[0.7] contrast-[1.2] invert-[0.9] hue-rotate-180 group-hover:brightness-[0.85] transition-all duration-700" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            
            <!-- Floating Map Badge -->
            <div class="absolute top-6 left-6 px-4 py-2.5 rounded-xl bg-zinc-950/80 backdrop-blur-md border border-zinc-800 text-xs font-semibold text-white flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-lime-400"></span>
                Pusat SM Sport Center Jakarta
            </div>
        </div>
    </div>
</section>
@endsection