@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false
])
<div class="mb-5">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-zinc-300 mb-2">
            {{ $label }} @if($required)<span class="text-lime-400">*</span>@endif
        </label>
    @endif
    <input 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-5 py-3.5 bg-zinc-950 border border-zinc-800 rounded-2xl text-zinc-100 placeholder-zinc-650 focus:outline-none focus:border-lime-400 transition-colors disabled:opacity-50 disabled:cursor-not-allowed']) }}
    >
    @error($name)
        <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
    @enderror
</div>
