<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Inventori Buku') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body style="font-family:'Inter',sans-serif;background:linear-gradient(135deg,#dbeafe 0%,#eff6ff 40%,#e0e7ff 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px">

        {{-- Background blobs --}}
        <div style="position:fixed;inset:0;overflow:hidden;pointer-events:none;z-index:0">
            <div style="position:absolute;top:-10%;left:-10%;width:50%;height:50%;background:radial-gradient(circle,rgba(147,197,253,0.4),transparent 70%);border-radius:50%"></div>
            <div style="position:absolute;bottom:0;right:-5%;width:45%;height:45%;background:radial-gradient(circle,rgba(165,180,252,0.35),transparent 70%);border-radius:50%"></div>
        </div>

        {{-- Card --}}
        <div style="position:relative;z-index:1;width:100%;max-width:420px">
            <div style="background:rgba(255,255,255,0.85);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.7);border-radius:24px;box-shadow:0 20px 60px rgba(59,130,246,0.15),0 4px 16px rgba(0,0,0,0.08);padding:40px 36px">

                {{-- Logo & Brand (di dalam card) --}}
                <div style="text-align:center;margin-bottom:32px">
                    <div style="display:inline-flex;align-items:center;justify-content:center;width:60px;height:60px;background:linear-gradient(135deg,#3b82f6,#6366f1);border-radius:18px;box-shadow:0 8px 20px rgba(59,130,246,0.4);margin-bottom:16px">
                        <span style="font-size:20px;font-weight:900;color:white;letter-spacing:-0.5px">IB</span>
                    </div>
                    <h1 style="font-size:22px;font-weight:800;color:#1e293b;margin:0;letter-spacing:-0.3px">Inventori Buku</h1>
                    <p style="font-size:13px;color:#64748b;margin:6px 0 0;font-weight:500">Sistem Manajemen Toko Pak Cik & Mas Aimar</p>
                </div>

                {{-- Divider --}}
                <div style="height:1px;background:linear-gradient(90deg,transparent,#e2e8f0,transparent);margin-bottom:28px"></div>

                {{-- Slot content (form login) --}}
                {{ $slot }}

                {{-- Copyright --}}
                <p style="text-align:center;font-size:11px;color:#94a3b8;margin:24px 0 0">&copy; {{ date('Y') }} Inventori Buku. All rights reserved.</p>
            </div>
        </div>

    </body>
</html>
