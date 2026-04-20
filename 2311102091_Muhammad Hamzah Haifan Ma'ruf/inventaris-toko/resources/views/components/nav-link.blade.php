@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-xl border border-cyan-400/30 bg-cyan-400/10 px-5 py-2.5 text-sm font-semibold uppercase tracking-[0.18em] text-cyan-300 transition duration-300'
            : 'inline-flex items-center rounded-xl border border-transparent px-5 py-2.5 text-sm font-semibold uppercase tracking-[0.18em] text-slate-300 transition duration-300 hover:border-cyan-400/30 hover:bg-cyan-400/10 hover:text-cyan-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>