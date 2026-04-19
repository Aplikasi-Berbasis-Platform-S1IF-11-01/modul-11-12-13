<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'jarvis-button'
]) }}>
    {{ $slot }}
</button>