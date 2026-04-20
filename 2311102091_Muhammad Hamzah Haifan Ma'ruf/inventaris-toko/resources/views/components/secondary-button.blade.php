<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'jarvis-button-secondary'
]) }}>
    {{ $slot }}
</button>