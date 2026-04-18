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

        /* Sidebar nav item */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.18s ease;
            position: relative;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.07);
            color: #f1f5f9;
            transform: translateX(3px);
        }
        .nav-item.active {
            background: linear-gradient(135deg, rgba(59,130,246,0.18), rgba(99,102,241,0.12));
            color: #60a5fa;
            font-weight: 600;
            transform: translateX(3px);
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background: linear-gradient(to bottom, #3b82f6, #6366f1);
            border-radius: 0 4px 4px 0;
        }
        .nav-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 15px;
            transition: all 0.18s ease;
        }
        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
</head>
<body class="antialiased flex overflow-hidden h-screen bg-slate-100">

    {{-- ════════════════════════════════════════════════════════
         SIDEBAR
    ════════════════════════════════════════════════════════ --}}
    <aside style="width:240px;background:linear-gradient(180deg,#0f172a 0%,#1e293b 100%);flex-shrink:0;display:flex;flex-direction:column;box-shadow:4px 0 24px rgba(0,0,0,0.3);z-index:20;position:relative">

        {{-- Decorative top accent --}}
        <div style="height:3px;background:linear-gradient(90deg,#3b82f6,#6366f1,#8b5cf6);flex-shrink:0"></div>

        {{-- Brand --}}
        <div style="padding:20px 16px 16px;border-bottom:1px solid rgba(255,255,255,0.06);flex-shrink:0">
            <div style="display:flex;align-items:center;gap:12px">
                <div style="width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,#3b82f6,#6366f1);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(59,130,246,0.4);flex-shrink:0">
                    <span style="color:white;font-weight:900;font-size:14px;letter-spacing:-0.5px">IB</span>
                </div>
                <div>
                    <p style="color:white;font-weight:700;font-size:14px;margin:0;line-height:1.2">Inventori Buku</p>
                    <p style="color:#64748b;font-size:11px;margin:0;margin-top:2px">Toko Pak Cik & Mas Aimar</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav style="flex:1;padding:16px 10px;overflow-y:auto">
            <p style="color:#475569;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0 10px;margin:0 0 10px">Menu Utama</p>

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
               class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <div class="nav-icon" style="{{ request()->routeIs('dashboard') ? 'background:rgba(59,130,246,0.2);' : 'background:rgba(255,255,255,0.05);' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="{{ request()->routeIs('dashboard') ? '#60a5fa' : '#64748b' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                        <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                        <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                        <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                    </svg>
                </div>
                Dashboard
                @if(request()->routeIs('dashboard'))
                    <span style="margin-left:auto;width:6px;height:6px;background:#3b82f6;border-radius:50%;box-shadow:0 0 8px #3b82f6;flex-shrink:0"></span>
                @endif
            </a>

            {{-- Data Produk --}}
            <a href="{{ route('products.index') }}"
               class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}" style="margin-top:4px">
                <div class="nav-icon" style="{{ request()->routeIs('products.*') ? 'background:rgba(59,130,246,0.2);' : 'background:rgba(255,255,255,0.05);' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="{{ request()->routeIs('products.*') ? '#60a5fa' : '#64748b' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                Data Produk
                @if(request()->routeIs('products.*'))
                    <span style="margin-left:auto;width:6px;height:6px;background:#3b82f6;border-radius:50%;box-shadow:0 0 8px #3b82f6;flex-shrink:0"></span>
                @endif
            </a>
        </nav>

        {{-- User Profile & Logout --}}
        <div style="border-top:1px solid rgba(255,255,255,0.06);padding:14px 10px;flex-shrink:0">
            <div style="display:flex;align-items:center;gap:10px;padding:6px 10px 12px">
                <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#334155,#475569);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:800;color:white;flex-shrink:0;border:1.5px solid rgba(255,255,255,0.1)">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div style="min-width:0;flex:1">
                    <p style="color:#f1f5f9;font-size:13px;font-weight:600;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ Auth::user()->name }}</p>
                    <p style="color:#475569;font-size:11px;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="width:100%;display:flex;align-items:center;justify-content:center;gap:8px;padding:9px 16px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#f87171;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;transition:all 0.18s ease" onmouseover="this.style.background='rgba(239,68,68,0.2)'" onmouseout="this.style.background='rgba(239,68,68,0.1)'">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Keluar Akun
                </button>
            </form>
        </div>
    </aside>

    {{-- ════════════════════════════════════════════════════════
         MAIN CONTENT
    ════════════════════════════════════════════════════════ --}}
    <div style="flex:1;display:flex;flex-direction:column;overflow:hidden">

        {{-- Top Header --}}
        <header style="height:60px;background:white;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;padding:0 32px;flex-shrink:0;box-shadow:0 1px 3px rgba(0,0,0,0.05)">
            <div style="display:flex;align-items:center;gap:12px">
                <div style="width:4px;height:22px;background:linear-gradient(to bottom,#3b82f6,#6366f1);border-radius:2px"></div>
                <h2 style="font-size:17px;font-weight:700;color:#1e293b;margin:0">
                    @isset($header){{ $header }}@endisset
                </h2>
            </div>
            <div style="display:flex;align-items:center;gap:8px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:7px 14px">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span style="font-size:13px;font-weight:600;color:#475569">2311102129</span>
                <span style="width:1px;height:14px;background:#e2e8f0"></span>
                <span style="font-size:13px;font-weight:500;color:#64748b">Hamid Sabirin</span>
            </div>
        </header>

        {{-- Scrollable Main --}}
        <main style="flex:1;overflow-y:auto;background:#f1f5f9">
            <div style="height:2px;background:linear-gradient(90deg,#3b82f6,#6366f1,#8b5cf6);opacity:0.5"></div>
            <div style="padding:28px 32px">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>
</html>
