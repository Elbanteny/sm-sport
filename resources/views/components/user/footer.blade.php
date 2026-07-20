<!-- Footer Section -->
<footer id="kontak" class="bg-zinc-950 border-t border-zinc-900 pt-20 pb-10 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
        <!-- Info Brand -->
        <div class="flex flex-col gap-4">
            <a href="#" class="flex items-center gap-2 group">
                <div class="w-10 h-10 rounded-xl bg-linear-to-br from-lime-400 to-emerald-500 flex items-center justify-center font-black text-zinc-950 text-xl">
                    SM
                </div>
                <span class="font-syne text-xl tracking-tight text-white">SM SPORT</span>
            </a>
            <p class="text-zinc-400 text-sm leading-relaxed mt-2">
                Penyedia fasilitas lapangan futsal, badminton, basket, dan tenis terkemuka. Bersih, nyaman, dan berstandar premium.
            </p>
        </div>

        <!-- Navigation Links -->
        <div>
            <h4 class="font-syne text-white text-sm font-bold tracking-wider uppercase mb-6">Navigasi</h4>
            <ul class="space-y-3">
                <li><a href="{{ url('/') }}" class="text-sm text-zinc-400 hover:text-lime-400 transition-colors">Home</a></li>
                <li><a href="{{ url('/lapangan') }}" class="text-sm text-zinc-400 hover:text-lime-400 transition-colors">Lapangan</a></li>
                <li><a href="{{ url('/#cara-kerja') }}" class="text-sm text-zinc-400 hover:text-lime-400 transition-colors">Cara Sewa</a></li>
            </ul>
        </div>

        <!-- Jam Operasional -->
        <div>
            <h4 class="font-syne text-white text-sm font-bold tracking-wider uppercase mb-6">Jam Operasional</h4>
            <ul class="space-y-3 text-sm text-zinc-400">
                <li>Senin - Jumat: <span class="text-white font-semibold">07.00 - 23.00 WIB</span></li>
                <li>Sabtu - Minggu: <span class="text-white font-semibold">06.00 - 24.00 WIB</span></li>
                <li class="pt-2 text-lime-400 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-lime-400"></span>
                    Buka di Hari Libur Nasional
                </li>
            </ul>
        </div>

        <!-- Kontak -->
        <div>
            <h4 class="font-syne text-white text-sm font-bold tracking-wider uppercase mb-6">Kontak Kami</h4>
            <ul class="space-y-3 text-sm text-zinc-400">
                <li class="flex items-center gap-2">
                    <span>📍</span> Jl. Olahraga No. 45, Jakarta Selatan
                </li>
                <li class="flex items-center gap-2">
                    <span>📞</span> +62 812-3456-7890
                </li>
                <li class="flex items-center gap-2">
                    <span>✉️</span> info@smsportcenter.com
                </li>
            </ul>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 border-t border-zinc-900 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-zinc-500">
        <p>&copy; {{ date('Y') }} SM Sport Center. All Rights Reserved.</p>
        <div class="flex gap-6">
            <a href="#" class="hover:text-zinc-300">Privacy Policy</a>
            <a href="#" class="hover:text-zinc-300">Terms of Service</a>
        </div>
    </div>
</footer>
