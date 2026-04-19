<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'jarvis-button-danger'
]) }}>
    {{ $slot }}
</button>