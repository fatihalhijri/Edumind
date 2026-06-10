<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('edumind-dark-mode')==='true' }"
      :class="{ 'dark': darkMode }"
      class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'EduMind — Belajar Lebih Cerdas' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (function() {
            if (localStorage.getItem('edumind-dark-mode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body class="h-full font-sans antialiased">

    <div class="min-h-screen flex">
        <!-- ═══ KIRI — Branding (50%) ═══ -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden flex-col items-center justify-center p-12"
             style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">

            <!-- Background neural pattern (SVG abstract) -->
            <svg class="absolute inset-0 w-full h-full opacity-10" viewBox="0 0 600 600" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="150" cy="150" r="2" fill="white"/>
                <circle cx="300" cy="100" r="2" fill="white"/>
                <circle cx="450" cy="200" r="2" fill="white"/>
                <circle cx="100" cy="300" r="2" fill="white"/>
                <circle cx="250" cy="350" r="2" fill="white"/>
                <circle cx="500" cy="320" r="2" fill="white"/>
                <circle cx="200" cy="480" r="2" fill="white"/>
                <circle cx="400" cy="450" r="2" fill="white"/>
                <circle cx="550" cy="500" r="2" fill="white"/>
                <line x1="150" y1="150" x2="300" y2="100" stroke="white" stroke-width="0.8"/>
                <line x1="300" y1="100" x2="450" y2="200" stroke="white" stroke-width="0.8"/>
                <line x1="150" y1="150" x2="100" y2="300" stroke="white" stroke-width="0.8"/>
                <line x1="100" y1="300" x2="250" y2="350" stroke="white" stroke-width="0.8"/>
                <line x1="450" y1="200" x2="500" y2="320" stroke="white" stroke-width="0.8"/>
                <line x1="250" y1="350" x2="400" y2="450" stroke="white" stroke-width="0.8"/>
                <line x1="500" y1="320" x2="400" y2="450" stroke="white" stroke-width="0.8"/>
                <line x1="200" y1="480" x2="400" y2="450" stroke="white" stroke-width="0.8"/>
                <line x1="400" y1="450" x2="550" y2="500" stroke="white" stroke-width="0.8"/>
                <line x1="300" y1="100" x2="250" y2="350" stroke="white" stroke-width="0.5" opacity="0.5"/>
                <line x1="450" y1="200" x2="250" y2="350" stroke="white" stroke-width="0.5" opacity="0.5"/>
                <circle cx="150" cy="150" r="20" stroke="white" stroke-width="0.5" opacity="0.3"/>
                <circle cx="450" cy="200" r="30" stroke="white" stroke-width="0.5" opacity="0.2"/>
                <circle cx="250" cy="350" r="25" stroke="white" stroke-width="0.5" opacity="0.3"/>
            </svg>

            <!-- Floating blobs -->
            <div class="absolute top-20 right-20 w-64 h-64 rounded-full opacity-20"
                 style="background: radial-gradient(circle, #a78bfa, transparent); filter: blur(40px);"></div>
            <div class="absolute bottom-20 left-10 w-48 h-48 rounded-full opacity-15"
                 style="background: radial-gradient(circle, #818cf8, transparent); filter: blur(30px);"></div>

            <!-- Content -->
            <div class="relative z-10 max-w-sm text-center text-white">
                <!-- Logo -->
                <div class="flex items-center justify-center gap-3 mb-10">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-2xl font-serif bg-white/20 backdrop-blur">E</div>
                    <span class="font-serif text-2xl font-bold">EduMind</span>
                </div>

                <!-- Headline -->
                <h1 class="font-serif text-4xl font-bold leading-tight mb-4">
                    Belajar Lebih Cerdas<br>
                    <span class="text-indigo-200">dengan Kekuatan AI</span>
                </h1>

                <p class="text-white/70 text-base leading-relaxed mb-10">
                    Upload materi kuliah, biarkan AI membuat soal latihan,
                    dan pantau perkembangan belajarmu secara real-time.
                </p>

                <!-- Quote -->
                <blockquote class="border-l-2 border-white/30 pl-4 text-left">
                    <p class="italic text-white/80 text-sm leading-relaxed">
                        "Setiap pertanyaan yang kamu jawab adalah langkah menuju pemahaman yang lebih dalam."
                    </p>
                </blockquote>

                <!-- Stats -->
                <div class="flex items-center justify-center gap-8 mt-10 pt-8 border-t border-white/20">
                    <div class="text-center">
                        <p class="font-serif text-2xl font-bold">1.2K+</p>
                        <p class="text-white/60 text-xs mt-1">Mahasiswa</p>
                    </div>
                    <div class="text-center">
                        <p class="font-serif text-2xl font-bold">50K+</p>
                        <p class="text-white/60 text-xs mt-1">Soal Dibuat</p>
                    </div>
                    <div class="text-center">
                        <p class="font-serif text-2xl font-bold">4.9★</p>
                        <p class="text-white/60 text-xs mt-1">Rating</p>
                    </div>
                </div>
            </div>

            <!-- Floating AI badge -->
            <div class="absolute top-8 left-8">
                <span class="badge-ai badge text-xs px-3 py-1.5" style="background: rgba(255,255,255,0.15); color: white; border-color: rgba(255,255,255,0.3); backdrop-filter: blur(8px);">
                    ✦ Powered by Gemini AI
                </span>
            </div>
        </div>

        <!-- ═══ KANAN — Form (50%) ═══ -->
        <div class="flex-1 flex flex-col items-center justify-center p-6 lg:p-12"
             style="background: var(--surface-1);">

            <!-- Mobile logo -->
            <div class="lg:hidden flex items-center gap-2 mb-8">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-bold text-lg"
                     style="background: var(--primary-600);">E</div>
                <span class="font-serif text-xl font-semibold" style="color: var(--text-primary);">EduMind</span>
            </div>

            <!-- Form card -->
            <div class="w-full max-w-sm">
                <div class="card-static rounded-2xl p-8">
                    {{ $slot }}
                </div>

                <!-- Back to landing -->
                <p class="text-center mt-4 text-sm" style="color: var(--text-muted);">
                    <a href="{{ route('welcome') }}" class="hover:underline" style="color: var(--primary-600);">← Kembali ke Beranda</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
