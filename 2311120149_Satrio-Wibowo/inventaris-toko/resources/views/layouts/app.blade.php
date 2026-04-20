<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>{{ config('app.name', 'Inventaris Toko') }}</title>
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
        
        {{-- Sidebar untuk Desktop & Mobile --}}
        <flux:sidebar sticky stashable collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            
            {{-- Logo & Nama Toko --}}
            <flux:sidebar.header>
                <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 px-2 py-1">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shrink-0">
                        <x-heroicon-o-cube class="w-4 h-4 text-white" />
                    </div>
                    <div class="leading-tight">
                        <div class="text-sm font-semibold text-zinc-800 dark:text-zinc-200">Inventaris Toko</div>
                        <div class="text-xs text-zinc-400">Pak Cik & Mas Aimar</div>
                    </div>
                </a>
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            {{-- Navigasi Menu --}}
            <flux:navlist variant="outline">
                <flux:navlist.group heading="Menu Utama" class="grid">
                    <flux:navlist.item 
                        icon="squares-2x2" 
                        :href="route('dashboard')" 
                        :current="request()->routeIs('dashboard')" 
                        wire:navigate>
                        Dashboard
                    </flux:navlist.item>

                    <flux:navlist.item 
                        icon="archive-box" 
                        :href="route('products.index')" 
                        :current="request()->routeIs('products.*')" 
                        wire:navigate>
                        Produk
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            {{-- User Menu di bagian bawah Sidebar (Desktop) --}}
            <x-desktop-user-menu class="hidden lg:block" />
        </flux:sidebar>

        {{-- Header khusus Mobile (Hanya muncul di layar kecil) --}}
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar
                                :name="auth()->user()->name"
                                :initials="auth()->user()->initials()"
                            />
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>

                    <flux:menu.separator />

                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                        >
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{-- Konten Utama: WAJIB dibungkus flux:main --}}
        <flux:main>
            {{ $slot }}
        </flux:main>

        {{-- Toast Notification --}}
        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>