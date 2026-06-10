<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="darkModeApp()"
      :class="{ 'dark': darkMode }"
      class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="EduMind — Platform belajar interaktif berbasis AI. Upload materi, generate soal otomatis, dan lacak progress belajarmu.">

    <title>{{ isset($title) ? $title . ' — EduMind' : 'EduMind — Belajar Lebih Cerdas' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dark mode: apply before page paint (cegah flash) -->
    <script>
        (function() {
            const saved = localStorage.getItem('edumind-dark-mode');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (saved === 'true' || (saved === null && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body class="h-full font-sans antialiased" style="background-color: var(--surface-1); color: var(--text-primary);">

    <div class="flex h-full">
        <!-- ═══════════════════ SIDEBAR ═══════════════════ -->
        <aside id="sidebar"
               class="fixed inset-y-0 left-0 z-40 flex flex-col transition-transform duration-300 md:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
               style="width: var(--sidebar-width); background: var(--surface-0); border-right: 1px solid var(--border);">

            <!-- Logo -->
            <div class="flex items-center justify-between px-5 py-4" style="border-bottom: 1px solid var(--border);">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-bold text-lg font-serif"
                         style="background: var(--primary-600);">E</div>
                    <span class="font-serif text-lg font-semibold" style="color: var(--text-primary);">EduMind</span>
                </a>
                <!-- Settings icon -->
                <a href="#" class="p-1.5 rounded-lg transition-colors" style="color: var(--text-muted);"
                   onmouseover="this.style.background='var(--surface-2)'" onmouseout="this.style.background='transparent'">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </a>
            </div>

            <!-- User mini greeting -->
            <div class="px-5 py-3" style="border-bottom: 1px solid var(--border);">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-semibold flex-shrink-0"
                         style="background: linear-gradient(135deg, var(--primary-500), var(--accent-500));">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-medium truncate" style="color: var(--text-primary);">{{ auth()->user()->name ?? 'Pengguna' }}</p>
                        <p class="text-xs truncate" style="color: var(--text-muted);">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 overflow-y-auto scrollbar-thin">
                <!-- MENU UTAMA -->
                <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider" style="color: var(--text-muted); font-size: 10px;">Menu Utama</p>

                <a href="{{ route('dashboard') }}"
                   class="nav-item {{ request()->routeIs('dashboard') ? 'nav-active' : '' }}">
                    <svg class="w-4.5 h-4.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('materials.index') }}"
                   class="nav-item {{ request()->routeIs('materials.*') ? 'nav-active' : '' }}">
                    <svg class="w-4.5 h-4.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Materi Saya
                </a>

                <a href="{{ route('quiz.index') }}"
                   class="nav-item {{ request()->routeIs('quiz.*') ? 'nav-active' : '' }}">
                    <svg class="w-4.5 h-4.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    Quiz & Latihan
                </a>

                <a href="{{ route('progress.index') }}"
                   class="nav-item {{ request()->routeIs('progress.*') ? 'nav-active' : '' }}">
                    <svg class="w-4.5 h-4.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Progress Saya
                </a>

                <!-- LAINNYA -->
                <p class="px-3 mt-5 mb-2 text-xs font-semibold uppercase tracking-wider" style="color: var(--text-muted); font-size: 10px;">Lainnya</p>

                <a href="#" class="nav-item">
                    <svg class="w-4.5 h-4.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Bantuan
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="nav-item w-full text-left" style="color: #dc2626;">
                        <svg class="w-4.5 h-4.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </nav>

            <!-- Streak footer -->
            <div class="px-5 py-3" style="border-top: 1px solid var(--border);">
                <div class="flex items-center gap-2">
                    <span class="text-lg">🔥</span>
                    <div>
                        <p class="text-xs font-semibold" style="color: var(--text-primary);">Streak Belajar</p>
                        <p class="text-xs" style="color: var(--text-muted);">Terus semangat!</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Sidebar overlay (mobile) -->
        <div x-show="sidebarOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-30 bg-black/50 md:hidden"
             style="display:none;"></div>

        <!-- ═══════════════════ MAIN AREA ═══════════════════ -->
        <div class="flex-1 flex flex-col min-w-0 md:pl-[260px]">

            <!-- ── TOPBAR ────────────────────────────────── -->
            <header class="sticky top-0 z-30 flex items-center justify-between px-6 h-14"
                    style="background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); border-bottom: 1px solid var(--border); transition: background 300ms ease;">
                <div class="dark:hidden" style="display:none"></div>

                <!-- Hamburger (mobile) + Breadcrumb -->
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="md:hidden p-2 rounded-lg" style="color: var(--text-muted);"
                            aria-label="Toggle sidebar">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    @isset($breadcrumb)
                        <nav class="text-sm" style="color: var(--text-muted);">{{ $breadcrumb }}</nav>
                    @endisset
                </div>

                <!-- Right: dark mode + notification + avatar -->
                <div class="flex items-center gap-2">
                    <!-- Dark mode toggle -->
                    <button @click="toggleDark()"
                            class="p-2 rounded-lg transition-colors"
                            style="color: var(--text-muted);"
                            :title="darkMode ? 'Mode Terang' : 'Mode Gelap'"
                            aria-label="Toggle dark mode">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>

                    <!-- Notification bell -->
                    <button class="relative p-2 rounded-lg transition-colors" style="color: var(--text-muted);" aria-label="Notifikasi">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>

                    <!-- Avatar -->
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-semibold"
                         style="background: linear-gradient(135deg, var(--primary-500), var(--accent-500));">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- ── PAGE CONTENT ───────────────────────────── -->
            <main class="flex-1 p-6 page-enter">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                         class="mb-4 flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium"
                         style="background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0;">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="mb-4 flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium"
                         style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>

        <!-- ═══════════════════ BOTTOM NAV (mobile) ═══════════════════ -->
        <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 flex items-center justify-around h-16 px-2"
             style="background: var(--surface-0); border-top: 1px solid var(--border); backdrop-filter: blur(12px);">
            <a href="{{ route('dashboard') }}" class="bottom-nav-item {{ request()->routeIs('dashboard') ? 'bottom-nav-active' : '' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Home</span>
            </a>
            <a href="{{ route('materials.index') }}" class="bottom-nav-item {{ request()->routeIs('materials.*') ? 'bottom-nav-active' : '' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Materi</span>
            </a>
            <a href="{{ route('quiz.index') }}" class="bottom-nav-item {{ request()->routeIs('quiz.*') ? 'bottom-nav-active' : '' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                <span>Quiz</span>
            </a>
            <a href="{{ route('progress.index') }}" class="bottom-nav-item {{ request()->routeIs('progress.*') ? 'bottom-nav-active' : '' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                <span>Progress</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bottom-nav-item">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar</span>
                </button>
            </form>
        </nav>
    </div>

    <!-- Toast Notifications -->
    @include('components.toast')

    <style>
        /* Nav item styles */
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 0 12px; height: 40px;
            border-radius: 10px; font-size: 0.875rem; font-weight: 500;
            color: var(--text-secondary); text-decoration: none;
            transition: all 150ms ease; margin-bottom: 2px;
            font-family: 'Outfit', sans-serif;
        }
        .nav-item:hover { background: var(--surface-2); color: var(--text-primary); }
        .nav-active {
            background: var(--primary-50) !important;
            color: var(--primary-600) !important;
            border-left: 3px solid var(--primary-500);
        }
        .dark .nav-active { background: rgba(99,102,241,0.15) !important; }

        /* Bottom nav */
        .bottom-nav-item {
            display: flex; flex-direction: column; align-items: center; gap: 2px;
            padding: 4px 12px; border-radius: 8px; font-size: 10px; font-weight: 500;
            color: var(--text-muted); text-decoration: none; min-width: 56px;
            background: transparent; border: none; cursor: pointer;
            transition: color 150ms ease;
        }
        .bottom-nav-active { color: var(--primary-600); }

        /* Dark mode topbar */
        .dark header { background: rgba(15,23,42,0.9) !important; }
    </style>

    <script>
        function darkModeApp() {
            return {
                darkMode: localStorage.getItem('edumind-dark-mode') === 'true' ||
                          (localStorage.getItem('edumind-dark-mode') === null &&
                           window.matchMedia('(prefers-color-scheme: dark)').matches),
                sidebarOpen: false,
                toggleDark() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('edumind-dark-mode', this.darkMode);
                }
            }
        }
    </script>
</body>
</html>
