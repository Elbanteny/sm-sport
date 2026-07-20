@props([
    'title',
    'category',
    'type' => 'Indoor',
    'image',
    'price',
    'rating' => null,
    'reviews' => null,
    'badge' => null,
    'description',
    'facilities' => [],
    'isRented' => false,
    'bookingUrl' => '#',
    'simple' => false
])

@if($simple)
    <!-- Compact Card (for Home Page) -->
    <div class="group bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden {{ $isRented ? 'hover:border-rose-500/50' : 'hover:border-lime-400/50' }} transition-all duration-300 shadow-lg hover:-translate-y-2 flex flex-col justify-between">
        <div>
            <div class="aspect-4/3 w-full overflow-hidden relative">
                <img src="{{ $image }}" 
                     alt="{{ $title }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out">
                
                <!-- Status Badges -->
                <div class="absolute top-4 left-4 flex flex-wrap gap-2 max-w-[85%]">
                    <span class="bg-zinc-950/80 backdrop-blur-md border border-zinc-800 text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">
                        {{ $category }}
                    </span>
                    @if($type)
                    <span class="bg-emerald-500/90 text-zinc-950 text-[9px] font-extrabold px-2.5 py-1 rounded-md uppercase tracking-wider">
                        {{ $type }}
                    </span>
                    @endif
                    <!-- Real-time Status Badge -->
                    @if($isRented)
                        <span class="bg-rose-500/90 text-white text-[9px] font-extrabold px-2.5 py-1 rounded-md uppercase tracking-wider animate-pulse">
                            🔴 Sedang Disewa
                        </span>
                    @else
                        <span class="bg-lime-400 text-zinc-950 text-[9px] font-extrabold px-2.5 py-1 rounded-md uppercase tracking-wider">
                            🟢 Tersedia
                        </span>
                    @endif
                </div>
            </div>
            <div class="p-6">
                <h3 class="font-syne text-xl font-bold text-white {{ $isRented ? 'group-hover:text-rose-400' : 'group-hover:text-lime-400' }} transition-colors duration-300">{{ $title }}</h3>
                <p class="text-zinc-400 text-sm mt-2 line-clamp-2">{{ $description }}</p>
            </div>
        </div>
        <div class="p-6 pt-0">
            <div class="flex items-center justify-between pt-4 border-t border-zinc-800/80">
                <div>
                    <p class="text-[10px] text-zinc-500 uppercase font-semibold">Mulai dari</p>
                    <p class="text-lg font-extrabold text-white">Rp {{ $price }}<span class="text-xs text-zinc-500 font-medium">/jam</span></p>
                </div>
                
                @if($isRented)
                    <button disabled class="px-4 py-2 bg-zinc-800/50 text-zinc-500 text-xs font-bold rounded-lg cursor-not-allowed">
                        Full Booked
                    </button>
                @else
                    <a href="{{ $bookingUrl }}" class="px-4 py-2 bg-zinc-800 text-white hover:bg-lime-400 hover:text-zinc-950 text-xs font-bold rounded-lg transition-colors duration-300">
                        Booking
                    </a>
                @endif
            </div>
        </div>
    </div>
@else
    <!-- Detailed Card (for Lapangan Page) -->
    <div class="group bg-zinc-900 border border-zinc-800 rounded-3xl overflow-hidden {{ $isRented ? 'border-rose-500/20 opacity-50 select-none' : 'hover:border-lime-400/50 hover:-translate-y-1' }} transition-all duration-300 shadow-2xl flex flex-col justify-between">
    <div>
        <div class="aspect-16/10 w-full overflow-hidden relative">
            <img src="{{ $image }}" 
                 alt="{{ $title }}" 
                 class="w-full h-full object-cover {{ !$isRented ? 'group-hover:scale-105' : '' }} transition-transform duration-700 ease-out brightness-90">
            
            <!-- Status Badges -->
            <div class="absolute top-4 left-4 flex flex-wrap gap-2 max-w-[90%]">
                <span class="bg-zinc-950/80 backdrop-blur-md border border-zinc-850 text-white text-xs font-bold px-3.5 py-1.5 rounded-xl uppercase tracking-wider">
                    {{ $category }}
                </span>
                @if($type)
                <span class="bg-emerald-500/90 text-zinc-950 text-[10px] font-extrabold px-3.5 py-1.5 rounded-xl uppercase tracking-wider">
                    {{ $type }}
                </span>
                @endif
                
                <!-- Real-time Status Badge Dinamis -->
                @if($isRented)
                    <span class="bg-rose-500 text-white text-[10px] font-extrabold px-3.5 py-1.5 rounded-xl uppercase tracking-wider shadow-lg shadow-rose-950/50">
                        🔴 Penuh / Booking
                    </span>
                @else
                    <span class="bg-lime-400 text-zinc-950 text-[10px] font-extrabold px-3.5 py-1.5 rounded-xl uppercase tracking-wider shadow-lg shadow-lime-950/50">
                        🟢 Tersedia
                    </span>
                @endif

                @if($badge)
                    <span class="bg-cyan-500 text-zinc-950 text-[10px] font-black px-3.5 py-1.5 rounded-xl uppercase tracking-wider shadow-lg shadow-cyan-950/50">
                        ✨ {{ $badge }}
                    </span>
                @endif
            </div>
        </div>
        
        <div class="p-6 sm:p-8">
            <div class="flex items-center gap-1.5 text-zinc-500 text-xs mb-3 font-semibold">
                @if($rating && $reviews)
                <span>⭐ {{ $rating }} ({{ $reviews }} Ulasan)</span>
                @endif
            </div>
            <h3 class="font-syne text-2xl font-bold {{ $isRented ? 'text-zinc-500' : 'text-white group-hover:text-lime-400' }} transition-colors duration-300">
                {{ $title }}
            </h3>
            <p class="text-zinc-500 text-sm mt-3 leading-relaxed">
                {{ $description }}
            </p>

            @php
                $facilitiesArray = [];
                if (is_array($facilities)) {
                    $facilitiesArray = $facilities;
                } elseif (is_string($facilities) && !empty(trim($facilities))) {
                    $decoded = json_decode($facilities, true);
                    $facilitiesArray = is_array($decoded) ? $decoded : explode(',', $facilities);
                }
            @endphp

            @if(count($facilitiesArray) > 0)
                <div class="mt-5">
                    <p class="text-[10px] text-zinc-500 uppercase tracking-wider font-bold mb-2">Fasilitas Arena:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($facilitiesArray as $facility)
                            <span class="inline-flex items-center text-xs text-zinc-300 bg-zinc-950 border border-zinc-850 px-3 py-1.5 rounded-xl">
                             {{ trim($facility) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <div class="p-6 sm:p-8 border-t border-zinc-800/80 bg-zinc-900/50 flex items-center justify-between">
        <div>
            <p class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold">Harga Sewa</p>
            <p class="text-xl font-black {{ $isRented ? 'text-zinc-500' : 'text-white' }}">Rp {{ $price }} <span class="text-xs font-normal text-zinc-500">/Jam</span></p>
        </div>
        
        @if($isRented)
            <!-- Tombol Disabled Saat Status DB (Pending/Disetujui) -->
            <button disabled class="px-6 py-3.5 bg-zinc-950 text-zinc-600 font-bold text-sm rounded-xl cursor-not-allowed border border-zinc-800 flex items-center gap-2">
                <svg class="w-4 h-4 text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Tidak Tersedia
            </button>
        @else
            <!-- Tombol Aktif Kembali -->
            <a href="{{ $bookingUrl }}" class="px-6 py-3.5 bg-lime-400 text-zinc-950 font-bold text-sm rounded-xl transition-all duration-300 hover:bg-lime-300 active:scale-95 glow-lime glow-lime-hover">
                Booking Sekarang
            </a>
        @endif
    </div>
</div>
@endif