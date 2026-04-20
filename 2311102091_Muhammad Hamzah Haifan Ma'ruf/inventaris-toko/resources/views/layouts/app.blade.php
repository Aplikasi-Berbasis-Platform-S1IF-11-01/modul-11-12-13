<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Inventaris Toko') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-white bg-[#05070d]">
        <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top,_rgba(34,211,238,0.12),_transparent_30%),radial-gradient(circle_at_bottom_right,_rgba(59,130,246,0.10),_transparent_25%),linear-gradient(135deg,_#05070d_0%,_#0b1220_45%,_#05070d_100%)]">
            
            <!-- Background Effects -->
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute inset-0 opacity-[0.08] bg-[linear-gradient(rgba(255,255,255,0.08)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.08)_1px,transparent_1px)] bg-[size:40px_40px]"></div>
                <div class="absolute top-0 left-1/2 h-[500px] w-[500px] -translate-x-1/2 rounded-full bg-cyan-400/10 blur-3xl"></div>
                <div class="absolute bottom-0 right-0 h-[400px] w-[400px] rounded-full bg-sky-500/10 blur-3xl"></div>
                <div class="absolute bottom-10 left-10 h-[250px] w-[250px] rounded-full bg-white/5 blur-3xl"></div>
            </div>

            <!-- Main Wrapper -->
            <div class="relative z-10 min-h-screen">
                @include('layouts.navigation')

                <!-- Page Content -->
                <main class="relative">
                    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>