@props([
    'name',
    'label',
    'checked' => false,
    'value' => '1'
])
<div class="mb-5 flex items-start">
    <div class="flex items-center h-5">
        <input 
            id="{{ $name }}" 
            name="{{ $name }}" 
            type="checkbox" 
            value="{{ $value }}"
            {{ old($name, $checked) ? 'checked' : '' }}
            {{ $attributes->merge(['class' => 'h-5 w-5 rounded-lg bg-zinc-950 border-zinc-800 text-lime-400 focus:ring-0 focus:ring-offset-0 focus:outline-none transition-colors accent-lime-400']) }}
        >
    </div>
    <div class="ml-3 text-sm">
        <label for="{{ $name }}" class="font-medium text-zinc-300 select-none cursor-pointer">{{ $label }}</label>
    </div>
    @error($name)
        <p class="text-xs text-red-500 mt-1.5 font-medium block w-full">{{ $message }}</p>
    @enderror
</div>
