@props([
    'label' => '',
    'value' => '',
    'icon'  => 'cube',
    'color' => 'indigo',
])

@php
$colors = [
    'indigo' => 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400',
    'green'  => 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400',
    'blue'   => 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
    'red'    => 'bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400',
];
$colorClass = $colors[$color] ?? $colors['indigo'];
@endphp

<div class="bg-white dark:bg-zinc-800 rounded-2xl border border-zinc-200 dark:border-zinc-700 p-5 flex items-center gap-4">
    <div class="w-12 h-12 rounded-xl flex items-center justify-center {{ $colorClass }}">
        <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-6 h-6" />
    </div>
    <div>
        <div class="text-xs font-medium text-zinc-500 uppercase tracking-wide">{{ $label }}</div>
        <div class="text-xl font-bold text-zinc-800 dark:text-zinc-100 mt-0.5 leading-tight">{{ $value }}</div>
    </div>
</div>