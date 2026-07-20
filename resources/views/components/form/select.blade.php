@props([
    'name',
    'label' => null,
    'options' => [], // Format: ['value' => 'Label']
    'selected' => '',
    'required' => false,
    'disabled' => false
])
<div class="mb-5">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-zinc-300 mb-2">
            {{ $label }} @if($required)<span class="text-lime-400">*</span>@endif
        </label>
    @endif
    <div class="relative">
        <select 
            id="{{ $name }}" 
            name="{{ $name }}" 
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-5 py-3.5 bg-zinc-950 border border-zinc-800 rounded-2xl text-zinc-100 appearance-none focus:outline-none focus:border-lime-400 transition-colors disabled:opacity-50 disabled:cursor-not-allowed']) }}
        >
            @foreach($options as $val => $lbl)
                <option value="{{ $val }}" {{ old($name, $selected) == $val ? 'selected' : '' }} class="bg-zinc-900 text-zinc-100">
                    {{ $lbl }}
                </option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-zinc-400">
            <svg class="fill-current h-4 w-4" xmlns="http://w3.org" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
    </div>
    @error($name)
        <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
    @enderror
</div>
