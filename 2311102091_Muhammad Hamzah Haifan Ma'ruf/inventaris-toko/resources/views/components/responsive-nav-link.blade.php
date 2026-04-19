@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block rounded-xl border border-cyan-400/30 bg-cyan-400/10 px-4 py-3 text-sm font-semibold uppercase tracking-[0.15em] text-cyan-300 transition duration-300'
            : 'block rounded-xl border border-transparent px-4 py-3 text-sm font-semibold uppercase tracking-[0.15em] text-slate-300 transition duration-300 hover:border-cyan-400/30 hover:bg-cyan-400/10 hover:text-cyan-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>