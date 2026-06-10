<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="EduMind — Platform belajar AI. Upload materi, generate soal otomatis dengan Gemini AI, pantau progress belajarmu.">
    <title>EduMind — Belajar Lebih Cerdas dengan Kekuatan AI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Outfit', sans-serif; background: #fff; color: #0f172a; margin: 0; overflow-x: hidden; }

        /* Mesh gradient background */
        .mesh-bg {
            background:
                radial-gradient(ellipse 60% 50% at 10% 20%, rgba(99,102,241,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 90% 80%, rgba(124,58,237,0.06) 0%, transparent 60%),
                #ffffff;
        }

        /* Scroll reveal */
        .reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* Stagger delays */
        .delay-1 { transition-delay: 0.1s; }
        .delay-2 { transition-delay: 0.2s; }
        .delay-3 { transition-delay: 0.3s; }
        .delay-4 { transition-delay: 0.4s; }
        .delay-5 { transition-delay: 0.5s; }
        .delay-6 { transition-delay: 0.6s; }

        /* Float animation */
        @keyframes floatY { 0%,100%{transform:translateY(0) rotate(-3deg)} 50%{transform:translateY(-12px) rotate(-3deg)} }
        .floating { animation: floatY 6s ease-in-out infinite; }

        /* Pulse badge */
        @keyframes pulseBadge { 0%,100%{box-shadow:0 0 0 0 rgba(124,58,237,0.3)} 50%{box-shadow:0 0 0 8px rgba(124,58,237,0)} }
        .pulse-badge { animation: pulseBadge 2.5s infinite; }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        /* Card hover */
        .feature-card { transition: all 0.2s cubic-bezier(0.4,0,0.2,1); }
        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(99,102,241,0.12); border-color: #a5b4fc !important; }

        /* Nav link */
        .nav-link { color: #475569; font-size: 14px; font-weight: 500; text-decoration: none; transition: color 0.15s; }
        .nav-link:hover { color: #4f46e5; }
    </style>
</head>
<body>

{{-- ═══════════════════ NAVBAR ═══════════════════ --}}
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
     style="background: rgba(255,255,255,0.9); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(15,23,42,0.06);">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ route('welcome') }}" class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-bold text-lg"
                 style="background: #4f46e5;">E</div>
            <span style="font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700; color: #0f172a;">EduMind</span>
        </a>

        <!-- Nav links (desktop) -->
        <div class="hidden md:flex items-center gap-7">
            <a href="#cara-kerja" class="nav-link">Cara Kerja</a>
            <a href="#fitur" class="nav-link">Fitur</a>
            <a href="#testimoni" class="nav-link">Testimoni</a>
        </div>

        <!-- CTA buttons -->
        <div class="flex items-center gap-2">
            @auth
                <a href="{{ route('dashboard') }}"
                   style="background: #4f46e5; color: white; padding: 8px 18px; border-radius: 10px; font-size: 14px; font-weight: 500; text-decoration: none;">
                    Dashboard →
                </a>
            @else
                <a href="{{ route('login') }}" class="nav-link hidden sm:block px-4 py-2">Masuk</a>
                <a href="{{ route('register') }}"
                   style="background: #4f46e5; color: white; padding: 8px 18px; border-radius: 10px; font-size: 14px; font-weight: 500; text-decoration: none;">
                    Daftar Gratis →
                </a>
            @endauth
        </div>
    </div>
</nav>

{{-- ═══════════════════ HERO ═══════════════════ --}}
<section class="mesh-bg min-h-screen flex items-center pt-16" id="hero">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-20 grid lg:grid-cols-2 gap-12 items-center w-full">

        <!-- Left: Text -->
        <div>
            <!-- AI Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6 pulse-badge"
                 style="background: #f5f3ff; border: 1px solid #ddd6fe;">
                <span style="color: #7c3aed; font-size: 14px;">✦</span>
                <span style="color: #6d28d9; font-size: 13px; font-weight: 600;">Powered by Google Gemini AI</span>
            </div>

            <h1 style="font-family: 'Syne', sans-serif; font-size: clamp(36px, 5vw, 60px); font-weight: 800; line-height: 1.05; letter-spacing: -0.03em; color: #0f172a; margin-bottom: 20px;">
                Belajar Lebih Cerdas<br>
                <span class="gradient-text">dengan Kekuatan AI</span>
            </h1>

            <p style="font-size: 17px; color: #475569; line-height: 1.7; margin-bottom: 32px; max-width: 480px;">
                Upload materi kuliah, biarkan AI membuat soal latihan secara otomatis,
                dan pantau perkembangan belajarmu secara real-time.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap gap-3 mb-8">
                <a href="{{ route('register') }}"
                   style="background: #4f46e5; color: white; padding: 13px 24px; border-radius: 12px; font-size: 15px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 16px rgba(99,102,241,0.3);">
                    Mulai Gratis — Tanpa Kartu Kredit →
                </a>
                <a href="#cara-kerja"
                   style="color: #475569; padding: 13px 20px; border-radius: 12px; font-size: 15px; font-weight: 500; text-decoration: none; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; gap: 6px; background: white;">
                    ▶ Lihat Demo
                </a>
            </div>

            <!-- Social Proof -->
            <div class="flex items-center gap-4 flex-wrap">
                <div class="flex -space-x-2">
                    @foreach(['#6366f1','#7c3aed','#10b981','#f59e0b'] as $c)
                    <div style="width:32px; height:32px; border-radius:50%; background:{{ $c }}; border: 2px solid white;"></div>
                    @endforeach
                </div>
                <p style="font-size: 13px; color: #475569;">
                    🎓 <strong style="color: #0f172a;">1.200+</strong> mahasiswa · ⭐ <strong style="color: #0f172a;">4.9/5</strong> rating
                </p>
            </div>
        </div>

        <!-- Right: Floating UI Mockup -->
        <div class="hidden lg:flex justify-center">
            <div class="floating" style="max-width: 420px; width: 100%;">
                <!-- Mock dashboard card -->
                <div style="background: white; border-radius: 20px; padding: 24px; box-shadow: 0 24px 64px rgba(0,0,0,0.14), 0 8px 24px rgba(99,102,241,0.08); border: 1px solid rgba(15,23,42,0.06); transform: rotate(-3deg);">
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                        <div style="width:36px;height:36px;border-radius:10px;background:#4f46e5;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;">E</div>
                        <div>
                            <p style="font-weight:600;font-size:13px;color:#0f172a;margin:0;">EduMind Dashboard</p>
                            <p style="font-size:11px;color:#64748b;margin:0;">Selamat pagi, Budi ☀️</p>
                        </div>
                    </div>
                    <!-- Mini stat cards -->
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:16px;">
                        <div style="background:#f8fafc;border-radius:12px;padding:12px;">
                            <p style="font-size:22px;font-weight:700;color:#4f46e5;margin:0;">12</p>
                            <p style="font-size:11px;color:#64748b;margin:0;">Materi</p>
                        </div>
                        <div style="background:#f8fafc;border-radius:12px;padding:12px;">
                            <p style="font-size:22px;font-weight:700;color:#7c3aed;margin:0;">87%</p>
                            <p style="font-size:11px;color:#64748b;margin:0;">Rata-rata Skor</p>
                        </div>
                    </div>
                    <!-- AI Badge -->
                    <div style="background:#f5f3ff;border-radius:12px;padding:12px;border:1px solid #ddd6fe;">
                        <p style="font-size:11px;font-weight:600;color:#7c3aed;margin:0 0 4px;">✦ AI Generator Soal</p>
                        <p style="font-size:12px;color:#475569;margin:0;">10 soal dibuat dalam 6 detik dari PDF Algoritma</p>
                    </div>
                    <!-- Progress bar -->
                    <div style="margin-top:14px;">
                        <div style="display:flex;justify-content:space-between;margin-bottom:5px;">
                            <span style="font-size:11px;color:#475569;">Progress Belajar Minggu Ini</span>
                            <span style="font-size:11px;font-weight:600;color:#4f46e5;">78%</span>
                        </div>
                        <div style="height:6px;background:#e0e7ff;border-radius:99px;overflow:hidden;">
                            <div style="width:78%;height:100%;background:linear-gradient(90deg,#6366f1,#7c3aed);border-radius:99px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════ HOW IT WORKS ═══════════════════ --}}
<section id="cara-kerja" class="py-20 px-4" style="background: #f8fafc;">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-14 reveal">
            <p style="font-size:13px;font-weight:600;color:#7c3aed;letter-spacing:0.06em;text-transform:uppercase;margin-bottom:8px;">Cara Kerja</p>
            <h2 style="font-family:'Syne',sans-serif;font-size:clamp(28px,4vw,40px);font-weight:800;color:#0f172a;margin:0 0 12px;">
                Tiga Langkah Mudah
            </h2>
            <p style="font-size:16px;color:#475569;max-width:460px;margin:0 auto;">Dari upload sampai latihan soal, semua dalam hitungan menit</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 relative">
            <!-- Connecting dashes -->
            <div class="hidden md:block absolute top-12 left-1/4 right-1/4 h-px" style="border-top: 2px dashed #c7d2fe;"></div>

            @php
            $steps = [
                ['n'=>'01', 'icon'=>'📄', 'title'=>'Upload Materi', 'desc'=>'Upload PDF kuliah atau paste teks. Sistem otomatis mengekstrak isinya.', 'color'=>'#4f46e5'],
                ['n'=>'02', 'icon'=>'✦',  'title'=>'AI Buat Soal',  'desc'=>'Gemini AI menganalisis materi dan membuat soal relevan dalam < 8 detik.', 'color'=>'#7c3aed'],
                ['n'=>'03', 'icon'=>'📊', 'title'=>'Lacak Progress', 'desc'=>'Dashboard analitik lengkap. Lihat kekuatan & kelemahan belajarmu.', 'color'=>'#10b981'],
            ];
            @endphp

            @foreach($steps as $i => $step)
            <div class="text-center reveal delay-{{ $i+1 }}">
                <div style="width:72px;height:72px;border-radius:20px;background:{{ $step['color'] }}15;border:2px solid {{ $step['color'] }}30;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:28px;">
                    {{ $step['icon'] }}
                </div>
                <span style="font-size:11px;font-weight:700;color:{{ $step['color'] }};letter-spacing:0.08em;">{{ $step['n'] }}</span>
                <h3 style="font-family:'Syne',sans-serif;font-size:18px;font-weight:700;color:#0f172a;margin:6px 0 8px;">{{ $step['title'] }}</h3>
                <p style="font-size:14px;color:#64748b;line-height:1.6;margin:0;">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════ FEATURES ═══════════════════ --}}
<section id="fitur" class="py-20 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-14 reveal">
            <p style="font-size:13px;font-weight:600;color:#7c3aed;letter-spacing:0.06em;text-transform:uppercase;margin-bottom:8px;">Fitur</p>
            <h2 style="font-family:'Syne',sans-serif;font-size:clamp(28px,4vw,40px);font-weight:800;color:#0f172a;margin:0;">
                Semua yang Kamu Butuhkan
            </h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @php
            $features = [
                ['icon'=>'✨','title'=>'AI Generate Soal Otomatis','desc'=>'Gemini AI membuat soal pilgan & esai yang relevan dari materimu dalam detik.','delay'=>1],
                ['icon'=>'📊','title'=>'Progress Tracker Real-time','desc'=>'Dashboard analitik dengan chart skor, streak calendar, dan analisis kelemahan.','delay'=>2],
                ['icon'=>'📁','title'=>'Upload PDF & Teks','desc'=>'Support upload PDF hingga 5MB atau paste teks langsung. Ekstrak otomatis.','delay'=>3],
                ['icon'=>'⏱️','title'=>'Quiz Mode + Timer','desc'=>'Mode quiz immersive dengan countdown timer. Warna berubah saat waktu menipis.','delay'=>4],
                ['icon'=>'🎯','title'=>'Analisis Kelemahan','desc'=>'AI mengidentifikasi topik yang paling banyak salah dan rekomendasikan latihan.','delay'=>5],
                ['icon'=>'🏆','title'=>'Streak & Gamifikasi','desc'=>'Sistem streak harian dan badge pencapaian untuk menjaga motivasi belajar.','delay'=>6],
            ];
            @endphp

            @foreach($features as $f)
            <div class="feature-card reveal delay-{{ $f['delay'] }} p-6 rounded-2xl"
                 style="border: 1px solid #e2e8f0; background: white;">
                <div style="width:52px;height:52px;border-radius:14px;background:#eef2ff;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:14px;">
                    {{ $f['icon'] }}
                </div>
                <h3 style="font-family:'Syne',sans-serif;font-size:16px;font-weight:700;color:#0f172a;margin:0 0 8px;">{{ $f['title'] }}</h3>
                <p style="font-size:13px;color:#64748b;line-height:1.65;margin:0;">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════ TESTIMONIAL ═══════════════════ --}}
<section id="testimoni" class="py-20 px-4" style="background: #f8fafc;">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-14 reveal">
            <h2 style="font-family:'Syne',sans-serif;font-size:clamp(28px,4vw,40px);font-weight:800;color:#0f172a;margin:0 0 12px;">
                Kata Mereka
            </h2>
            <p style="font-size:16px;color:#475569;">Mahasiswa yang sudah merasakan manfaat EduMind</p>
        </div>

        <div class="grid md:grid-cols-3 gap-5">
            @php
            $testimonials = [
                ['name'=>'Budi Santoso','campus'=>'Universitas Indonesia','quote'=>'EduMind benar-benar mengubah cara saya belajar. AI-nya bikin soal yang relevan banget sama materi kuliah!','delay'=>1],
                ['name'=>'Dina Rahayu','campus'=>'ITS Surabaya','quote'=>'Skor ujian saya naik dari 65 ke 88 setelah 2 minggu rutin latihan di EduMind. Fitur analisis kelemahannya sangat membantu.','delay'=>2],
                ['name'=>'Ahmad Fauzi','campus'=>'UGM Yogyakarta','quote'=>'Interface-nya bersih dan responsif. Dark mode-nya keren! Generate soal dalam < 10 detik itu beneran cepet.','delay'=>3],
            ];
            @endphp

            @foreach($testimonials as $t)
            <div class="reveal delay-{{ $t['delay'] }} p-6 rounded-2xl" style="background:white;border:1px solid #e2e8f0;">
                <div style="display:flex;gap:3px;margin-bottom:12px;">
                    @for($i=0;$i<5;$i++)<span style="color:#f59e0b;font-size:14px;">★</span>@endfor
                </div>
                <p style="font-size:14px;color:#475569;line-height:1.7;margin:0 0 16px;font-style:italic;">"{{ $t['quote'] }}"</p>
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#7c3aed);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;">
                        {{ strtoupper(substr($t['name'],0,1)) }}
                    </div>
                    <div>
                        <p style="font-weight:600;font-size:13px;color:#0f172a;margin:0;">{{ $t['name'] }}</p>
                        <p style="font-size:11px;color:#64748b;margin:0;">{{ $t['campus'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════ CTA FINAL ═══════════════════ --}}
<section class="py-20 px-4" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
    <div class="max-w-3xl mx-auto text-center reveal">
        <h2 style="font-family:'Syne',sans-serif;font-size:clamp(28px,4vw,44px);font-weight:800;color:white;margin:0 0 16px;line-height:1.1;">
            Siap Belajar Lebih Efektif?
        </h2>
        <p style="font-size:17px;color:rgba(255,255,255,0.75);margin:0 0 32px;">
            Gratis selamanya untuk fitur dasar. Tidak perlu kartu kredit.
        </p>
        <a href="{{ route('register') }}"
           style="display:inline-flex;align-items:center;gap:8px;background:white;color:#4f46e5;padding:14px 32px;border-radius:12px;font-size:16px;font-weight:700;text-decoration:none;box-shadow:0 8px 24px rgba(0,0,0,0.2);">
            Daftar Sekarang — Gratis →
        </a>
    </div>
</section>

{{-- ═══════════════════ FOOTER ═══════════════════ --}}
<footer class="py-8 px-4 text-center" style="background:#0f172a;">
    <div class="flex items-center justify-center gap-2 mb-3">
        <div style="width:28px;height:28px;border-radius:8px;background:#4f46e5;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;">E</div>
        <span style="font-family:'Syne',sans-serif;font-weight:700;color:white;font-size:15px;">EduMind</span>
    </div>
    <p style="font-size:12px;color:#64748b;margin:0;">
        Belajar Lebih Cerdas, Bukan Lebih Keras · © {{ date('Y') }} EduMind · Powered by Gemini AI
    </p>
</footer>

<script>
// Scroll reveal using Intersection Observer
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>
