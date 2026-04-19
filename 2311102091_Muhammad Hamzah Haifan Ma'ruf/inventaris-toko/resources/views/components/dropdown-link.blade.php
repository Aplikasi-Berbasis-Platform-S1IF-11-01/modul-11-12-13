<a {{ $attributes->merge([
    'class' => 'block w-full px-4 py-3 text-sm text-slate-200 transition duration-300 hover:bg-cyan-400/10 hover:text-cyan-300'
]) }}>
    {{ $slot }}
</a>