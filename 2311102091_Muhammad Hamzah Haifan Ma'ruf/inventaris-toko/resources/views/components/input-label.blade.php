@props(['value'])

<label {{ $attributes->merge(['class' => 'jarvis-label']) }}>
    {{ $value ?? $slot }}
</label>