@props([
    'sidebar' => false,
])

@php
    // Ganti nama aplikasi di sini
    $appName = "InvStore"; 
@endphp

@if($sidebar)
    <flux:sidebar.brand :name="$appName" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-zinc-950 text-white dark:bg-white dark:text-black">
            <x-app-logo-icon class="size-5" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand :name="$appName" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-zinc-950 text-white dark:bg-white dark:text-black">
            <x-app-logo-icon class="size-5" />
        </x-slot>
    </flux:brand>
@endif