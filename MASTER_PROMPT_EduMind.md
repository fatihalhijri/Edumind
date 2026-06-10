# 🎓 MASTER PROMPT — EduMind: Platform Belajar Interaktif Berbasis AI
> Copy prompt ini dan paste ke AI (Claude / ChatGPT / Cursor / Copilot)

---

## 📋 IDENTITAS PROYEK

```
Nama Proyek  : EduMind — AI-Powered Interactive Learning Platform
Tech Stack   : Laravel 11 + Breeze + Blade + Tailwind CSS v3 + Alpine.js
Database     : MySQL
AI API       : Google Gemini API (gratis) atau OpenAI GPT-4o-mini
Storage      : Laravel Storage (local/S3)
Deploy Target: Railway.app atau Vercel (via Nixpacks)
```

---

## 🎯 PERINTAH UTAMA UNTUK AI

```
Kamu adalah senior full-stack developer Laravel yang ahli UI/UX.
Bantu saya membangun "EduMind" — sebuah platform belajar berbasis AI
yang memungkinkan pengguna upload materi (PDF/teks), lalu AI secara
otomatis generate soal latihan, dan platform melacak progress belajar pengguna.

Stack wajib:
- Laravel 11 dengan Laravel Breeze (auth scaffolding)
- Blade templating engine
- Tailwind CSS v3 (utility-first styling)
- Alpine.js (untuk interaktivitas ringan di frontend)
- Livewire (opsional, untuk komponen reaktif tanpa reload)

Ikuti instruksi fase per fase yang saya berikan. Setiap fase menghasilkan
kode yang langsung bisa dijalankan. Berikan penjelasan singkat di setiap
langkah penting.
```

---

## 🎨 DESIGN SYSTEM (WAJIB DIIKUTI AI)

### Konsep Visual
```
Aesthetic    : "Dark Academic meets Modern SaaS"
Tone         : Serius tapi approachable — seperti Notion bertemu Linear
Palette Mode : Support light + dark mode
Feel         : Premium, bersih, minimalis tapi kaya detail
```

### Color Palette (CSS Variables — taruh di app.css)
```css
:root {
  /* Brand Colors */
  --primary-50:  #eef2ff;
  --primary-100: #e0e7ff;
  --primary-500: #6366f1;   /* Indigo — warna utama */
  --primary-600: #4f46e5;
  --primary-700: #4338ca;

  /* Accent */
  --accent-500:  #8b5cf6;   /* Violet — secondary accent */
  --accent-glow: rgba(99, 102, 241, 0.15);

  /* Neutrals */
  --surface-0:   #ffffff;
  --surface-1:   #f8fafc;
  --surface-2:   #f1f5f9;
  --surface-3:   #e2e8f0;
  --text-primary:   #0f172a;
  --text-secondary: #475569;
  --text-muted:     #94a3b8;
  --border:         rgba(15,23,42,0.08);
  --border-strong:  rgba(15,23,42,0.15);

  /* Semantic */
  --success: #10b981;
  --warning: #f59e0b;
  --danger:  #ef4444;
  --info:    #3b82f6;

  /* Shadows */
  --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
  --shadow-md: 0 4px 16px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
  --shadow-lg: 0 12px 40px rgba(0,0,0,0.12), 0 4px 12px rgba(0,0,0,0.06);
  --shadow-glow: 0 0 24px rgba(99,102,241,0.25);
}

/* DARK MODE */
[data-theme="dark"] {
  --surface-0:   #0f172a;
  --surface-1:   #1e293b;
  --surface-2:   #273548;
  --surface-3:   #334155;
  --text-primary:   #f1f5f9;
  --text-secondary: #94a3b8;
  --text-muted:     #64748b;
  --border:         rgba(241,245,249,0.06);
  --border-strong:  rgba(241,245,249,0.12);
}
```

### Typography
```css
/* Import di <head> layout.blade.php */
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

/* Di CSS */
font-family: 'DM Sans', sans-serif;           /* body, UI semua */
font-family: 'Instrument Serif', serif;        /* heading besar, display */
font-family: 'JetBrains Mono', monospace;      /* kode, badge skor */

/* Scale Typography */
--text-xs:   0.75rem;   /* 12px — caption, badge */
--text-sm:   0.875rem;  /* 14px — secondary text */
--text-base: 1rem;      /* 16px — body */
--text-lg:   1.125rem;  /* 18px — subheading */
--text-xl:   1.25rem;   /* 20px — card title */
--text-2xl:  1.5rem;    /* 24px — section heading */
--text-3xl:  1.875rem;  /* 30px — page title */
--text-4xl:  2.25rem;   /* 36px — hero headline */
--text-5xl:  3rem;      /* 48px — landing big text */
```

### Komponen UI Kunci
```
CARD STYLE:
- background: var(--surface-0)
- border: 1px solid var(--border)
- border-radius: 16px
- padding: 24px
- box-shadow: var(--shadow-sm)
- hover: box-shadow: var(--shadow-md), translateY(-2px)
- transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1)

BUTTON PRIMARY:
- background: var(--primary-500)
- color: white
- border-radius: 10px
- padding: 10px 20px
- font-weight: 500
- hover: background: var(--primary-600), box-shadow: var(--shadow-glow)
- active: scale(0.98)
- transition: all 0.15s ease

INPUT FIELD:
- background: var(--surface-1)
- border: 1px solid var(--border-strong)
- border-radius: 10px
- padding: 10px 14px
- focus: border-color: var(--primary-500), box-shadow: 0 0 0 3px var(--accent-glow)

BADGE:
- border-radius: 99px (pill)
- font-size: 12px, font-weight: 500
- padding: 3px 10px
- variasi: success (hijau), warning (kuning), danger (merah), info (biru)

SIDEBAR NAV:
- width: 260px
- background: var(--surface-1)
- border-right: 1px solid var(--border)
- nav item hover: background: var(--surface-2), border-radius: 10px
- nav item active: background: var(--primary-50), color: var(--primary-600), border-left: 3px solid var(--primary-500)
```

### Animasi & Micro-interactions
```css
/* Wajib ada di setiap komponen interaktif */
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}

@keyframes shimmer {
  0%   { background-position: -200% 0; }
  100% { background-position: 200% 0; }
}

@keyframes pulse-glow {
  0%, 100% { box-shadow: 0 0 0 0 rgba(99,102,241,0); }
  50%       { box-shadow: 0 0 0 8px rgba(99,102,241,0.15); }
}

/* Loading skeleton */
.skeleton {
  background: linear-gradient(90deg,
    var(--surface-2) 25%,
    var(--surface-3) 50%,
    var(--surface-2) 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 8px;
}

/* Page transition */
.page-enter { animation: fadeInUp 0.35s ease both; }
```

---

## 📁 STRUKTUR DATABASE (Migration)

```sql
-- Jalankan: php artisan make:migration

-- TABEL: materials (materi yang diupload user)
id, user_id (FK), title, description, file_path,
file_type (pdf/text), raw_text (extracted text),
created_at, updated_at

-- TABEL: quiz_sessions (sesi latihan)
id, user_id (FK), material_id (FK), title,
total_questions, status (draft/active/completed),
created_at, updated_at

-- TABEL: questions (soal yang di-generate AI)
id, quiz_session_id (FK), question_text,
question_type (multiple_choice/essay),
options (JSON — array 4 pilihan),
correct_answer, explanation (penjelasan AI),
created_at

-- TABEL: attempts (jawaban user)
id, user_id (FK), quiz_session_id (FK),
question_id (FK), user_answer, is_correct,
time_spent_seconds, created_at

-- TABEL: progress_stats (ringkasan progress)
id, user_id (FK), date, total_questions_answered,
correct_answers, materials_studied, streak_days,
created_at, updated_at
```

---

## 🔧 FASE 1 — SETUP PROJECT

### Prompt ke AI:
```
Buat setup lengkap Laravel 11 + Breeze + Tailwind untuk proyek EduMind.

Langkah yang dibutuhkan:
1. Buat file composer.json dan package.json yang sudah dikonfigurasi
2. Setup Tailwind CSS v3 dengan config custom (extend theme dengan warna brand dari CSS variables di atas)
3. Buat file tailwind.config.js yang extend palette warna EduMind
4. Buat layout utama: resources/views/layouts/app.blade.php
   - Sidebar navigasi (260px, fixed)
   - Main content area (fluid)
   - Topbar dengan nama user + dark mode toggle + notif
   - Responsive: sidebar collapse di mobile jadi bottom nav atau hamburger
5. Buat layouts/guest.blade.php untuk halaman auth
6. Sesuaikan tampilan auth Breeze (login, register) dengan design system EduMind
   - Tambahkan ilustrasi/pattern di sisi kiri (gunakan SVG abstract)
   - Form di kanan, card putih dengan shadow

Design wajib ikuti CSS variables dan typography yang sudah ditentukan di design system.
Setiap elemen harus support dark mode via [data-theme="dark"].
Gunakan Alpine.js untuk dark mode toggle (simpan ke localStorage).

Tampilkan: kode lengkap setiap file yang perlu dibuat.
```

---

## 🔧 FASE 2A — UPLOAD MATERI

### Prompt ke AI:
```
Buat fitur upload materi untuk EduMind. Pengguna bisa upload PDF atau paste teks.

Yang dibutuhkan:
1. Migration: tabel materials (sesuai skema di atas)
2. Model Material dengan relationships ke User
3. Controller: MaterialController (index, create, store, show, destroy)
4. Service: MaterialService yang handle ekstraksi teks dari PDF
   - Gunakan package smalot/pdfparser untuk ekstrak teks PDF
   - Simpan raw_text ke database setelah ekstraksi
5. View: materials/create.blade.php
   - Dua tab: "Upload PDF" dan "Paste Teks"
   - Tab switching pakai Alpine.js (x-show, x-data)
   - Drag & drop zone untuk PDF (styling bagus, ada preview nama file)
   - Textarea besar untuk mode teks
   - Progress bar upload (pakai Alpine + Livewire atau Axios)
6. View: materials/index.blade.php
   - Grid card 3 kolom (responsive: 1 kolom mobile, 2 tablet, 3 desktop)
   - Setiap card: icon tipe file, judul, deskripsi, tanggal, badge status
   - Tombol: "Generate Soal" dan "Hapus"
   - Empty state cantik jika belum ada materi
7. Routes di web.php
8. Validasi: max 5MB untuk PDF, required untuk semua field

Tampilkan semua file lengkap dengan komentar.
Styling harus ikut design system EduMind (card, button, input style yang sudah ditentukan).
```

---

## 🔧 FASE 2B — GENERATE SOAL DENGAN AI

### Prompt ke AI:
```
Buat fitur generate soal otomatis menggunakan Gemini API untuk EduMind.

Yang dibutuhkan:
1. Setup Gemini API:
   - Tambahkan GEMINI_API_KEY ke .env
   - Buat Service: app/Services/GeminiService.php
   - Method: generateQuestions($rawText, $totalQuestions = 10, $type = 'mixed')

2. Prompt template ke Gemini (di dalam GeminiService):
   Buat prompt yang memerintahkan Gemini menghasilkan JSON format:
   {
     "questions": [
       {
         "question": "...",
         "type": "multiple_choice",
         "options": ["A. ...", "B. ...", "C. ...", "D. ..."],
         "correct_answer": "A",
         "explanation": "Penjelasan singkat kenapa jawaban ini benar"
       }
     ]
   }
   
   Prompt harus dalam Bahasa Indonesia, minta soal yang beragam tingkat
   kesulitan (mudah, sedang, sulit), dan relevan dengan materi.

3. Migration + Model: quiz_sessions dan questions
4. Controller: QuizController (generate, show, start, submit)
5. Job: GenerateQuestionsJob (Laravel Queue) — generate di background
   karena API call bisa lambat
6. View: quiz/generate.blade.php
   - Form: judul sesi, jumlah soal (5/10/15/20), tipe (pilgan/esai/campuran)
   - Preview materi (250 karakter pertama dari raw_text)
   - Tombol "Generate dengan AI ✨"
   - Loading state: animasi "AI sedang membuat soal..." dengan steps
     (Membaca materi → Menganalisis topik → Membuat soal → Selesai)
   - Tampilkan hasil soal setelah selesai

7. Error handling jika API gagal (retry logic, pesan error yang user-friendly)

Tampilkan semua file lengkap. AI loading state harus terasa premium dan informatif.
```

---

## 🔧 FASE 2C — QUIZ ENGINE

### Prompt ke AI:
```
Buat quiz engine (antarmuka mengerjakan soal) untuk EduMind.

Yang dibutuhkan:
1. View: quiz/take.blade.php — halaman mengerjakan soal
   Design "immersive quiz mode":
   - Fullscreen-style: header minimal (nomor soal, timer, progress bar)
   - Progress bar warna indigo di bagian atas, animasi smooth
   - Timer countdown per soal (default 60 detik) dengan warna berubah:
     > 30 detik: hijau, 10-30 detik: kuning, < 10 detik: merah + pulse
   - Soal ditampilkan 1 per 1 (tidak scroll ke bawah)
   - Pilihan jawaban: 4 tombol besar, hover effect, selected = highlighted indigo
   - Animasi slide dari kanan saat pindah soal (Alpine.js transition)
   - Tombol "Selanjutnya" yang muncul setelah user memilih jawaban
   
2. Logic menggunakan Alpine.js:
   - State: currentQuestion, selectedAnswer, timeLeft, answers[]
   - Auto next setelah timer habis (simpan sebagai tidak menjawab)
   - Konfirmasi sebelum submit semua jawaban

3. View: quiz/result.blade.php — halaman hasil quiz
   Design "celebration + analisis":
   - Hero section: skor besar dengan animasi count-up (0 → 85%)
   - Ring chart (SVG sederhana atau CSS) menunjukkan benar vs salah
   - Badge berdasarkan skor:
     90-100%: "🏆 Luar Biasa!", 70-89%: "⭐ Bagus!", 
     50-69%: "📈 Terus Berkembang!", < 50%: "💪 Jangan Menyerah!"
   - List semua soal + jawaban user + jawaban benar + penjelasan
   - Salah ditandai merah, benar ditandai hijau
   - Tombol: "Coba Lagi" dan "Kembali ke Dashboard"

4. Controller method: submit(Request $request) — simpan semua attempts ke DB,
   hitung skor, update progress_stats

Tampilkan kode lengkap. Quiz experience harus terasa engaging dan tidak membosankan.
```

---

## 🔧 FASE 3 — DASHBOARD & PROGRESS TRACKER

### Prompt ke AI:
```
Buat dashboard utama dan halaman progress tracker untuk EduMind.

Yang dibutuhkan:
1. View: dashboard/index.blade.php
   
   SECTION 1 — Greeting & Quick Stats (4 card metric):
   - "Selamat pagi/siang/sore, [nama]!" (dynamic berdasarkan jam)
   - Card: Total Materi | Total Soal Dikerjakan | Rata-rata Skor | Streak Hari
   - Setiap card punya ikon (Heroicons/Lucide via CDN), warna accent, angka besar
   - Animasi count-up saat card muncul (Alpine.js + IntersectionObserver)

   SECTION 2 — Aktivitas Terakhir:
   - List 3 materi terakhir + tombol "Lanjut Belajar"
   - List 3 sesi quiz terakhir + skor + tanggal

   SECTION 3 — Chart Perkembangan Skor (7 hari terakhir):
   - Gunakan Chart.js (via CDN) untuk line chart
   - Warna: gradient indigo ke violet
   - Tampilkan label hari + titik data skor rata-rata
   - Jika data kurang dari 7 hari, tampilkan yang ada

   SECTION 4 — Motivasi & Tips:
   - Satu quote motivasi belajar (bisa hardcode beberapa, random tiap load)
   - Tombol "Upload Materi Baru +" yang besar dan menonjol

2. View: progress/index.blade.php — halaman progress detail
   - Kalender streaks (mirip GitHub contributions — grid 30 hari)
     Sel hari: kosong = abu, ada aktivitas = biru muda, banyak aktivitas = biru tua
   - Tabel riwayat semua sesi quiz (sortable: tanggal, skor, materi)
   - Grafik pie: distribusi topik yang paling sering dipelajari
   - "Analisis Kelemahan": topik/soal dengan persentase salah tertinggi
   - Export progress sebagai PDF (gunakan Laravel Snappy atau DomPDF)

3. Controller: DashboardController, ProgressController
4. Eager loading yang efisien (hindari N+1 query)

Tampilkan kode lengkap. Dashboard harus terasa seperti produk SaaS profesional.
Chart.js import via CDN: https://cdn.jsdelivr.net/npm/chart.js
```

---

## 🔧 FASE 4A — LANDING PAGE

### Prompt ke AI:
```
Buat landing page premium untuk EduMind yang mampu memenangkan kompetisi pitching.

Struktur halaman (resources/views/welcome.blade.php):

SECTION 1 — HERO:
- Navbar: logo + nav links + tombol "Masuk" + "Mulai Gratis" (CTA utama)
- Headline besar (font Instrument Serif): 
  "Belajar Lebih Cerdas dengan\nKekuatan Kecerdasan Buatan"
- Sub-headline: "Upload materi kuliah Anda, biarkan AI membuat soal latihan,
  dan pantau perkembangan belajar Anda secara real-time."
- Dua tombol: "Mulai Gratis — Tanpa Kartu Kredit" dan "Lihat Demo ▶"
- Di bawah tombol: "🎓 Sudah dipercaya 1,200+ mahasiswa" (social proof)
- Background: subtle animated gradient mesh (indigo-violet-purple, sangat halus)
- Floating UI mockup di kanan hero (screenshot dashboard, slight rotation, shadow besar)

SECTION 2 — HOW IT WORKS (3 langkah):
- Numbered steps yang besar dan jelas
- Step 1: "Upload Materi" — ikon upload, deskripsi singkat
- Step 2: "AI Generate Soal" — ikon AI/sparkle, deskripsi
- Step 3: "Lacak Progres" — ikon chart, deskripsi
- Koneksi antar step dengan garis putus-putus/arrow

SECTION 3 — FEATURES (grid 2x3 atau 3x2):
Setiap feature card: ikon besar + judul + deskripsi 2 kalimat
- ✨ AI Generate Soal Otomatis
- 📊 Progress Tracker Real-time  
- 📁 Upload PDF & Teks
- ⏱️ Quiz Mode dengan Timer
- 🎯 Analisis Kelemahan Belajar
- 🏆 Sistem Poin & Streak

SECTION 4 — TESTIMONI (3 card):
Quote testimonial mahasiswa (bisa fiktif tapi realistis)

SECTION 5 — CTA FINAL:
- Headline: "Siap Belajar Lebih Efektif?"
- Background: gradient indigo
- Tombol besar putih "Daftar Sekarang — Gratis"

SECTION 6 — FOOTER:
- Logo + tagline + link nav + copyright

Styling wajib: animasi scroll reveal (gunakan Intersection Observer + CSS),
hover effects pada cards, responsive sempurna, loading cepat.
Jangan gunakan library animasi besar — pure CSS + Alpine.js saja.
```

---

## 🔧 FASE 4B — POLISH UI/UX

### Prompt ke AI:
```
Lakukan UI/UX polish final pada EduMind. Tambahkan detail yang membuat
aplikasi terasa premium dan profesional untuk kompetisi:

1. LOADING STATES:
   - Tambahkan skeleton loading pada semua halaman yang fetch data
   - Loading spinner custom dengan warna brand di tengah layar saat navigasi
   - Tombol loading state: disable + spinner kecil + text "Memproses..."

2. EMPTY STATES:
   - Buat empty state yang menarik untuk: daftar materi kosong, belum ada quiz, belum ada progress
   - Setiap empty state: ilustrasi SVG sederhana + headline + CTA button

3. TOAST NOTIFICATIONS:
   - Buat komponen toast (pop-up notifikasi) di pojok kanan bawah
   - Tipe: success (hijau), error (merah), warning (kuning), info (biru)
   - Auto-dismiss setelah 4 detik, bisa di-close manual
   - Animasi slide dari kanan
   - Gunakan Alpine.js + session flash message Laravel

4. DARK MODE:
   - Pastikan SEMUA halaman support dark mode dengan toggle di topbar
   - Simpan preferensi ke localStorage
   - Transisi smooth antara light/dark (transition: background 0.3s)
   - Gunakan @media (prefers-color-scheme: dark) sebagai default detection

5. MICRO-INTERACTIONS:
   - Button: scale(0.97) saat active/click
   - Card: translateY(-3px) + shadow lebih besar saat hover
   - Input: border-color + glow saat focus
   - Nav item: background slide dari kiri saat hover

6. RESPONSIVE FINAL CHECK:
   - Mobile (< 640px): sidebar jadi bottom navigation 5 item
   - Tablet (640-1024px): sidebar collapsible
   - Desktop (> 1024px): sidebar fixed 260px

7. ACCESSIBILITY:
   - Semua tombol punya aria-label yang deskriptif
   - Fokus visible pada semua elemen interaktif
   - Alt text pada semua gambar/ikon

Tampilkan perubahan spesifik pada setiap file yang perlu diupdate.
```

---

## 🚀 TIPS PITCHING (Bonus)

### Struktur Slide Pitching (untuk Semnas CODE 2024):
```
Slide 1  — Problem: "Mahasiswa kesulitan menemukan soal latihan yang relevan"
Slide 2  — Solution: EduMind (tagline + 1 kalimat value proposition)
Slide 3  — How It Works: 3 langkah sederhana (visual)
Slide 4  — DEMO LIVE: screen recording atau live demo website
Slide 5  — Tech Stack: diagram arsitektur (Laravel + Gemini API)
Slide 6  — Impact: siapa yang terbantu + potensi pengguna
Slide 7  — Tim: foto + nama + role
Slide 8  — Call to Action: QR code link website demo
```

### Yang Buat Juri Terkesan:
- Demo berjalan LIVE tanpa error
- UI yang sangat bersih dan profesional
- Angka nyata: "Generate 10 soal dalam < 8 detik"
- Pain point yang relatable untuk audiens mahasiswa
- Storytelling: "Kami pernah merasakan ini sendiri saat..."

---

## 📦 PACKAGE YANG DIBUTUHKAN

```bash
# PHP/Composer
composer require laravel/breeze
composer require smalot/pdfparser          # Ekstrak teks PDF
composer require spatie/laravel-activitylog # Audit log (opsional)
composer require barryvdh/laravel-dompdf   # Export PDF progress

# NPM
npm install alpinejs @alpinejs/intersect
npm install chart.js
npm install @heroicons/vue                  # opsional jika pakai Vue

# Artisan
php artisan breeze:install blade
php artisan migrate
php artisan queue:table
php artisan migrate
```

---

*Prompt ini dibuat untuk Final Project Mahasiswa Informatika — Kompetisi CODE 2024*
*Stack: Laravel 11 + Breeze + Blade + Tailwind CSS v3 + Gemini API*
