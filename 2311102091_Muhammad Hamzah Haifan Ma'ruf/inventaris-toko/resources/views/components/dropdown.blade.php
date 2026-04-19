@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-2 bg-[#0b1220]/95 backdrop-blur-xl'])

@php
$alignmentClasses = match ($align) {
    'left' => 'origin-top-left left-0',
    'top' => 'origin-top',
    default => 'origin-top-right right-0',
};

$width = match ($width) {
    '48' => 'w-48',
    '56' => 'w-56',
    '60' => 'w-60',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="absolute z-50 mt-3 {{ $width }} rounded-2xl border border-white/10 shadow-[0_20px_60px_rgba(0,0,0,0.55)] {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded-2xl {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>