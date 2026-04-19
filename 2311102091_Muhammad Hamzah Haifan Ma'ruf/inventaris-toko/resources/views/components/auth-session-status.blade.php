@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'jarvis-alert-success']) }}>
        {{ $status }}
    </div>
@endif