<nav x-data="{ open: false }"
    class="sticky top-0 z-50 border-b border-cyan-400/10 bg-[#05070d]/85 backdrop-blur-xl shadow-[0_10px_35px_rgba(0,0,0,0.45)]">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="flex h-20 items-center justify-between">

            <!-- LEFT -->
            <div class="flex items-center gap-10">

                <!-- LOGO -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('products.index') }}"
                        class="group flex items-center gap-3">

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl border border-cyan-400/30 bg-white/5 shadow-[0_0_18px_rgba(34,211,238,0.18)] transition duration-300 group-hover:scale-105 group-hover:shadow-[0_0_28px_rgba(34,211,238,0.35)]">

                            <div
                                class="h-5 w-5 rounded-full bg-cyan-400 shadow-[0_0_15px_rgba(34,211,238,1)]">
                            </div>
                        </div>

                        <div class="leading-tight">
                            <p class="text-[10px] uppercase tracking-[0.45em] text-cyan-300/70">
                                Pak Cik System
                            </p>

                            <p class="text-lg font-bold tracking-[0.20em] text-white">
                                INVENTARIS
                            </p>
                        </div>
                    </a>
                </div>

                <!-- MENU DESKTOP -->
                <div class="hidden items-center gap-3 sm:flex">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="rounded-xl border border-transparent bg-white/0 px-5 py-2.5 text-sm font-semibold uppercase tracking-[0.18em] text-slate-300 transition duration-300 hover:border-cyan-400/30 hover:bg-cyan-400/10 hover:text-cyan-300">

                        {{ __('Dashboard') }}

                    </x-nav-link>

                </div>
            </div>

            <!-- RIGHT DESKTOP -->
            <div class="hidden items-center gap-5 sm:flex">

                <!-- STATUS -->
                <div
                    class="flex items-center gap-2 rounded-full border border-cyan-400/20 bg-white/5 px-4 py-2 text-xs uppercase tracking-[0.28em] text-slate-300">

                    <span
                        class="h-2.5 w-2.5 rounded-full bg-cyan-400 shadow-[0_0_12px_rgba(34,211,238,0.95)]"></span>

                    Online
                </div>

                <!-- USER -->
                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-medium text-white transition duration-300 hover:border-cyan-400/30 hover:bg-cyan-400/10 hover:shadow-[0_0_20px_rgba(34,211,238,0.15)] focus:outline-none">

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full border border-cyan-400/30 bg-cyan-400/10 font-bold text-cyan-300">
                                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                            </div>

                            <div class="text-left leading-tight">
                                <div class="text-sm font-semibold text-white">
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="text-[10px] uppercase tracking-[0.22em] text-slate-400">
                                    Authorized
                                </div>
                            </div>

                            <svg class="h-4 w-4 fill-current text-slate-400"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <div class="px-4 py-3 border-b border-white/10 bg-[#0b1220]">
                            <p class="text-sm font-semibold text-white">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-slate-400">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>

            <!-- MOBILE BUTTON -->
            <div class="flex items-center sm:hidden">

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 p-2.5 text-slate-300 transition hover:border-cyan-400/30 hover:bg-cyan-400/10 hover:text-cyan-300 focus:outline-none">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none"
                        viewBox="0 0 24 24">

                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>
                </button>

            </div>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden border-t border-cyan-400/10 bg-[#05070d]/95 sm:hidden">

        <div class="space-y-2 px-4 py-4">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

        </div>

        <div class="border-t border-white/10 px-4 py-4">

            <div class="mb-3">
                <div class="text-base font-semibold text-white">
                    {{ Auth::user()->name }}
                </div>

                <div class="text-sm text-slate-400">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="space-y-2">

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">

                        {{ __('Log Out') }}

                    </x-responsive-nav-link>
                </form>

            </div>

        </div>
    </div>
</nav>