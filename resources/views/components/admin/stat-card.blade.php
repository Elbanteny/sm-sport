@props([
    'title',
    'value',
    'desc' => null,
    'type' => 'default',
])

@php
    // Mapping warna berdasarkan tipe card
    $themeClasses = [
        'default' => [
            'border' => 'hover:border-lime-400/40',
            'iconBg' => 'bg-lime-400/10 text-lime-400',
            'dot' => 'bg-lime-400',
        ],
        'success' => [
            'border' => 'hover:border-emerald-500/40',
            'iconBg' => 'bg-emerald-500/10 text-emerald-400',
            'dot' => 'bg-emerald-400',
        ],
        'warning' => [
            'border' => 'hover:border-amber-500/40',
            'iconBg' => 'bg-amber-500/10 text-amber-400',
            'dot' => 'bg-amber-400',
        ],
        'danger' => [
            'border' => 'hover:border-rose-500/40',
            'iconBg' => 'bg-rose-500/10 text-rose-400',
            'dot' => 'bg-rose-400',
        ]
    ][$type] ?? $themeClasses['default'];
@endphp

<div class="bg-zinc-950/40 border border-zinc-800 rounded-2xl p-6 flex flex-col justify-between transition-all duration-300 {{ $themeClasses['border'] }} group">
    <div class="flex items-start justify-between">
        <div class="space-y-1">
            <span class="text-xs font-bold text-zinc-500 uppercase tracking-widest">{{ $title }}</span>
            <h3 class="font-syne text-3xl font-black text-white group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-linear-to-r group-hover:from-white group-hover:to-zinc-400 transition-all duration-300">
                {{ $value }}
            </h3>
        </div>
        <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $themeClasses['iconBg'] }}">
            {{ $slot }}
        </div>
    </div>
    
    @if($desc)
        <div class="mt-4 pt-3 border-t border-zinc-900/60 flex items-center gap-2 text-xs text-zinc-400">
            <span class="w-1.5 h-1.5 rounded-full {{ $themeClasses['dot'] }}"></span>
            <span>{{ $desc }}</span>
        </div>
    @endif
</div>