@props([
    'type' => 'submit',
    'loading' => false
])
<button 
    type="{{ $type }}" 
    {{ $attributes->merge(['class' => 'w-full px-5 py-3.5 bg-lime-400 hover:bg-lime-500 text-zinc-950 font-bold rounded-2xl shadow-lg shadow-lime-400/10 hover:shadow-lime-400/20 active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed']) }}
>
    {{ $slot }}
</button>
