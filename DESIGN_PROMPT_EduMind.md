# 🎨 DESIGN PROMPT — EduMind: AI-Powered Learning Platform
> Prompt khusus untuk AI Designer (Figma AI, Framer AI, v0.dev, Galileo AI, atau Claude)
> Tujuan: Generate desain UI/UX lengkap siap kompetisi pitching

---

## 🧠 KONTEKS & BRIEF DESAIN

```
Produk     : EduMind — Platform Belajar Interaktif Berbasis AI
Target User: Mahasiswa S1 usia 18–24 tahun, akrab teknologi, aktif di kampus
Platform   : Website responsif (desktop utama, mobile supported)
Tujuan UI  : Memenangkan kompetisi pitching kampus — kesan profesional & inovatif
Tone       : Cerdas, segar, bersemangat — bukan korporat kaku, bukan anak-anak
Referensi  : Linear.app (kejelasan) + Notion (ketenangan) + Duolingo (engagement)
Diferensiasi: AI sebagai fitur bintang — desain harus mencerminkan kecerdasan & inovasi
```

---

## 🎨 IDENTITAS VISUAL (WAJIB DIIKUTI)

### Nama & Logo

```
Nama      : EduMind
Tagline   : "Belajar Lebih Cerdas, Bukan Lebih Keras"
Logo mark : Huruf "E" stylized dalam kotak rounded dengan sudut 12px
            Warna: Putih di atas latar Indigo (#4F46E5)
Konsep    : Bentuk "E" yang bisa dibaca sebagai sinyal otak/neural
```

### Aesthetic Direction

```
NAMA AESTHETIC: "Neural Clarity"

Konsep: Kejernihan pikiran yang terorganisir — seperti catatan kuliah yang
rapi bertemu kecerdasan mesin. Bersih tapi tidak steril. Pintar tapi tidak
dingin. Platform yang membuat belajar terasa seperti sesuatu yang kamu
INGIN lakukan, bukan harus.

Inspirasi visual:
- Whitespace luas seperti Medium atau Linear
- Aksen warna berani seperti Framer atau Raycast
- Elemen AI yang subtil: partikel, koneksi neural halus, glow tipis
- Grid yang konsisten, alignment sempurna
- Micro-animation yang responsif dan terasa hidup
```

---

## 🖌️ COLOR SYSTEM

### Primary Palette

```
INDIGO (Brand Utama)
├── indigo-950: #1e1b4b   ← text gelap di surface cerah
├── indigo-900: #312e81   ← heading penting
├── indigo-800: #3730a3   ← text on light bg
├── indigo-700: #4338ca   ← hover states
├── indigo-600: #4f46e5   ← PRIMARY — tombol utama, link aktif
├── indigo-500: #6366f1   ← icon, decorative
├── indigo-400: #818cf8   ← border highlight
├── indigo-300: #a5b4fc   ← subtle border
├── indigo-200: #c7d2fe   ← border default
├── indigo-100: #e0e7ff   ← hover background
└── indigo-50:  #eef2ff   ← active nav background, badge bg

VIOLET (Secondary Accent)
├── violet-600: #7c3aed   ← AI badge, premium feature indicator
├── violet-400: #a78bfa   ← decorative glow
└── violet-50:  #f5f3ff   ← AI feature card background
```

### Neutral Palette

```
SLATE (Teks & Surface)
├── slate-950: #020617   ← dark mode background
├── slate-900: #0f172a   ← dark mode surface / light mode text primary
├── slate-700: #334155   ← dark mode text primary
├── slate-600: #475569   ← text secondary (light mode)
├── slate-500: #64748b   ← text muted
├── slate-400: #94a3b8   ← placeholder, disabled
├── slate-300: #cbd5e1   ← border (light mode)
├── slate-200: #e2e8f0   ← divider, subtle border
├── slate-100: #f1f5f9   ← card background, sidebar
├── slate-50:  #f8fafc   ← page background (light mode)
└── white:     #ffffff   ← card surface, modal
```

### Semantic Colors

```
SUCCESS (Hijau — skor tinggi, upload berhasil)
├── bg:     #f0fdf4   border: #bbf7d0   text: #15803d   strong: #14532d

WARNING (Kuning — skor sedang, waktu hampir habis)
├── bg:     #fefce8   border: #fef08a   text: #a16207   strong: #854d0e

DANGER (Merah — skor rendah, error, waktu habis)
├── bg:     #fef2f2   border: #fecaca   text: #dc2626   strong: #991b1b

INFO (Biru — informasi, hint dari AI)
└── bg:     #eff6ff   border: #bfdbfe   text: #2563eb   strong: #1e40af
```

### Dark Mode Mapping

```
DARK MODE (aktifkan dengan class "dark" di <html>)
├── Background page:    #0f172a   (slate-900)
├── Surface card:       #1e293b   (slate-800)
├── Surface elevated:   #273548   (custom)
├── Border default:     rgba(241,245,249, 0.06)
├── Border hover:       rgba(241,245,249, 0.12)
├── Text primary:       #f1f5f9   (slate-100)
├── Text secondary:     #94a3b8   (slate-400)
└── Text muted:         #64748b   (slate-500)
```

---

## ✍️ TYPOGRAPHY SYSTEM

### Font Stack

```
DISPLAY / HEADING BESAR  → Syne (Google Fonts)
  Karakter: Geometrik, modern, berani — cocok untuk nama produk & hero text
  Import: https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800

BODY / UI TEXT           → Outfit (Google Fonts)
  Karakter: Friendly, readable, proporsi bagus di semua ukuran
  Import: https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600

KODE / MONOSPACE         → JetBrains Mono (Google Fonts)
  Digunakan untuk: skor numerik besar, badge persentase, indikator timer
  Import: https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500
```

### Type Scale

```
SKALA UKURAN (mobile-first, desktop di atas):

xs    :  11px / 12px   → caption, badge label, tooltip
sm    :  13px / 14px   → secondary text, meta info, timestamp
base  :  15px / 16px   → body text, paragraph, form input
lg    :  17px / 18px   → subheading, card title
xl    :  20px / 22px   → section title
2xl   :  24px / 28px   → page title
3xl   :  30px / 36px   → hero subheading (Outfit)
4xl   :  36px / 48px   → hero headline (Syne, bold)
5xl   :  48px / 64px   → landing display text (Syne, extrabold)

WEIGHT:
300 → light (hint text, placeholder)
400 → regular (body text)
500 → medium (label, UI text penting)
600 → semibold (heading di card, nav aktif)
700 → bold (page title)
800 → extrabold (Syne display — hero, logo)

LINE HEIGHT:
Display text   : 1.1 (Syne heading)
Body text      : 1.6–1.7 (Outfit paragraph)
UI labels      : 1.3 (tight, untuk komponen kecil)

LETTER SPACING:
Display        : -0.02em (tighter, lebih elegant)
Body           : 0 (normal)
Caption/label  : 0.04em (sedikit wider, lebih readable)
```

---

## 📐 SPACING & LAYOUT SYSTEM

### Grid System

```
Desktop (≥ 1280px):
├── Container max-width: 1280px
├── Sidebar: 260px fixed kiri
├── Content area: fluid (sisa)
├── Padding content: 32px
└── Column grid: 12 kolom

Tablet (768px – 1279px):
├── Sidebar: collapsible (overlay di mobile, narrow di tablet)
├── Padding content: 24px
└── Column grid: 8 kolom

Mobile (< 768px):
├── Bottom navigation: 5 item
├── Padding content: 16px
└── Column grid: 4 kolom
```

### Spacing Scale (8px base unit)

```
4px   → micro gap (ikon-text, badge internal)
8px   → tight gap (list items)
12px  → component internal (card padding kecil)
16px  → component gap (antar element dalam card)
20px  → section internal
24px  → card padding default
32px  → section gap
48px  → page section gap (desktop)
64px  → hero section padding
96px  → landing section gap besar
```

### Border Radius

```
4px   → tag kecil, chip
8px   → badge, pill, input kecil
10px  → button, input default
12px  → card kecil, komponen medium
16px  → card besar, modal, sidebar
20px  → hero image, container feature
24px  → landing section card
99px  → pill/badge rounded penuh
50%   → avatar, icon circle
```

---

## 🧩 KOMPONEN UI (DESIGN SPEC)

### 1. Navigation Sidebar

```
DIMENSI: width 260px, height 100vh, fixed
BACKGROUND: #f8fafc (light) / #1e293b (dark)
BORDER: border-right: 1px solid #e2e8f0

STRUKTUR:
┌─────────────────────────────┐
│  [E] EduMind          ⚙    │  ← Logo + settings icon (kanan atas)
├─────────────────────────────┤
│  Selamat pagi, Budi 👋      │  ← Greeting mini (12px, slate-500)
│  [Avatar 32px]              │  ← Foto user / inisial
├─────────────────────────────┤
│  MENU UTAMA                 │  ← Label seksi (10px, uppercase, slate-400)
│  ▣ Dashboard                │  ← Active: bg indigo-50, left border 3px indigo
│  ◫ Materi Saya              │  ← Hover: bg slate-100, border-radius 10px
│  ◻ Quiz & Latihan           │
│  ◻ Progress Saya            │
├─────────────────────────────┤
│  LAINNYA                    │
│  ◻ Pengaturan               │
│  ◻ Bantuan                  │
├─────────────────────────────┤
│  Streak: 🔥 7 hari          │  ← Streak motivasi (di bawah)
└─────────────────────────────┘

NAV ITEM STYLE:
- Height: 40px
- Padding: 0 12px
- Border-radius: 10px (saat hover/active)
- Gap ikon-text: 10px
- Ikon: 18px, warna slate-400 (inactive) / indigo-600 (active)
- Font: Outfit 14px, 500 weight
- Transisi: background 150ms ease
```

### 2. Top Bar

```
DIMENSI: height 56px, sticky top
BACKGROUND: white/dark blur (backdrop-filter: blur(12px), bg-opacity-80)
BORDER: border-bottom: 1px solid #e2e8f0

KONTEN (kiri → kanan):
[Breadcrumb: Dashboard > Materi] ... [Search 🔍] [🔔] [Avatar]

SEARCH BAR:
- Lebar: 260px (expandable saat focus: 360px)
- Placeholder: "Cari materi, quiz..."
- Border-radius: 99px (pill)
- Keyboard shortcut: ⌘K / Ctrl+K

NOTIF BELL:
- Badge merah kecil jika ada notif baru
- Dropdown panel saat diklik
```

### 3. Button System

```
PRIMARY BUTTON (aksi utama):
- Background: #4f46e5 (indigo-600)
- Color: #ffffff
- Padding: 10px 20px (desktop) / 9px 16px (mobile)
- Border-radius: 10px
- Font: Outfit 14px, 500
- Hover: background #4338ca, box-shadow: 0 0 0 4px rgba(99,102,241,0.2)
- Active: transform scale(0.97)
- Disabled: opacity 0.5, cursor not-allowed
- Loading: spinner kecil (24px) + text "Memproses..."
- Ikon AI: tambahkan ✦ atau ⚡ sebelum text untuk fitur AI

SECONDARY BUTTON:
- Background: #eef2ff (indigo-50)
- Color: #4338ca (indigo-700)
- Border: 1px solid #c7d2fe
- Hover: background #e0e7ff

GHOST BUTTON:
- Background: transparent
- Color: #475569 (slate-600)
- Border: 1px solid #e2e8f0
- Hover: background #f1f5f9

DANGER BUTTON:
- Background: #fef2f2
- Color: #dc2626
- Border: 1px solid #fecaca
- Hover: background #fee2e2
```

### 4. Card System

```
BASE CARD:
- Background: #ffffff (light) / #1e293b (dark)
- Border: 1px solid #e2e8f0 (light) / rgba(241,245,249,0.08) (dark)
- Border-radius: 16px
- Padding: 24px
- Box-shadow: 0 1px 3px rgba(0,0,0,0.06)
- Hover: translateY(-3px), box-shadow: 0 8px 24px rgba(0,0,0,0.1)
- Transition: all 200ms cubic-bezier(0.4, 0, 0.2, 1)

STAT CARD (metric dashboard):
- Background: #f8fafc (surface secondary)
- Border: none
- Border-radius: 12px
- Padding: 16px
- Label: 12px Outfit, slate-500, margin-bottom 4px
- Value: 28px Syne, 700 weight, slate-900
- Delta badge: di bawah value, warna semantic

MATERIAL CARD:
- Padding: 20px
- Header: ikon tipe file (40px kotak rounded-8) + judul + tanggal
- Body: deskripsi singkat (2 baris, ellipsis)
- Footer: badge status + tombol "Generate Soal" + "Lihat"
- Hover: border-color indigo-300, slight glow

QUIZ HISTORY CARD:
- Row-style (bukan grid)
- Kiri: ikon quiz + nama materi + tanggal
- Tengah: progress bar mini + "X dari Y soal"
- Kanan: skor badge besar (warna semantic) + tombol "Review"
```

### 5. Badge & Status Indicators

```
BADGE DEFAULT:
- Font: Outfit 11px, 600 weight
- Padding: 3px 10px
- Border-radius: 99px (pill)

VARIASI WARNA:
- Success:  bg #f0fdf4, text #15803d, border #bbf7d0
- Warning:  bg #fefce8, text #a16207, border #fef08a
- Danger:   bg #fef2f2, text #dc2626, border #fecaca
- Info:     bg #eff6ff, text #2563eb, border #bfdbfe
- AI/Violet:bg #f5f3ff, text #6d28d9, border #ddd6fe
- Neutral:  bg #f1f5f9, text #475569, border #e2e8f0

SCORE BADGE BESAR (hasil quiz):
- Border-radius: 16px
- Padding: 16px 24px
- Value: 36px Syne 800, warna semantic
- Label: 12px Outfit 600, di bawah angka
  < 50%: "Jangan Menyerah 💪" (danger)
  50-69%: "Terus Berkembang 📈" (warning)
  70-89%: "Bagus! ⭐" (info/indigo)
  90-100%: "Luar Biasa! 🏆" (success)
```

### 6. Input & Form Elements

```
TEXT INPUT:
- Background: #f8fafc
- Border: 1px solid #e2e8f0
- Border-radius: 10px
- Padding: 10px 14px
- Font: Outfit 14px
- Placeholder color: #94a3b8
- Focus: border-color #6366f1, box-shadow: 0 0 0 3px rgba(99,102,241,0.15)
- Error: border-color #ef4444, bg #fef2f2

TEXTAREA:
- Sama dengan input, min-height: 120px
- Resize: vertical only

SELECT:
- Style custom (bukan browser default)
- Chevron ikon kanan, rotasi 180° saat open

UPLOAD ZONE (drag & drop):
- Border: 2px dashed #c7d2fe
- Border-radius: 16px
- Background: #eef2ff (hover: #e0e7ff)
- Padding: 40px 24px
- Konten tengah: ikon upload (32px, indigo) + teks instruksi + hint file
- Hover & drag-over: border-color #6366f1, background lebih gelap
- File selected state: tampilkan nama file + ukuran + tombol remove (×)

TAB SWITCHER (Upload PDF vs Paste Teks):
- Style pill/segment control
- Background container: #f1f5f9
- Active tab: background white, shadow kecil, border-radius 8px
- Transisi: sliding 200ms
```

### 7. Quiz Interface Components

```
PROGRESS HEADER (saat mengerjakan quiz):
├── Progress bar: full-width, 6px tinggi, rounded
│   - Track: #e2e8f0
│   - Fill: gradient #6366f1 → #7c3aed (kiri ke kanan)
│   - Animasi: transisi width 300ms ease saat pindah soal
├── Nomor soal: "6 / 10" — kiri
├── Timer: "00:42" — kanan, font JetBrains Mono 16px
│   - > 30 detik: #15803d (hijau)
│   - 10-30 detik: #a16207(kuning)
│   - < 10 detik: #dc2626 (merah) + pulse animation

QUESTION CARD:
- Background: white, border-radius 20px, padding 32px
- Font pertanyaan: Outfit 17px, 500, slate-900, line-height 1.6
- Transisi antar soal: slide dari kanan (translateX 40px → 0), fade in

OPTION BUTTONS:
- Height: 52px (desktop), 48px (mobile)
- Border: 1px solid #e2e8f0
- Border-radius: 12px
- Background: white
- Kiri: kotak huruf pilihan (A/B/C/D), 24px, bg #f1f5f9
- Teks: Outfit 14px, slate-700
- Hover: bg #f8fafc, border-color #a5b4fc
- Selected: bg #eef2ff, border-color #6366f1 (2px), teks #4338ca, 
           kotak huruf: bg #4f46e5, text white
- Correct (setelah submit): bg #f0fdf4, border #16a34a (green)
- Wrong: bg #fef2f2, border #ef4444 (red)
- Transisi: all 150ms ease
```

### 8. Toast Notifications

```
POSISI: kanan bawah, stack ke atas, z-index: 9999
DIMENSI: min-width 280px, max-width 380px

STYLE:
- Background: white (light) / #1e293b (dark)
- Border-radius: 12px
- Border: 1px solid #e2e8f0
- Border-left: 4px solid [warna semantic]
- Box-shadow: 0 8px 32px rgba(0,0,0,0.12)
- Padding: 12px 16px

KONTEN:
- Ikon status: 16px, warna semantic
- Teks: Outfit 13px, 500
- Tombol close (×): kanan atas, 20px

ANIMASI:
- Masuk: slide dari kanan + fade in (300ms)
- Keluar: slide ke kanan + fade out (250ms)
- Auto dismiss: 4 detik (success/info), 6 detik (error)
- Progress bar tipis di bawah (mengecil seiring waktu)

VARIASI WARNA BORDER:
- Success: #10b981 (hijau)
- Error:   #ef4444 (merah)
- Warning: #f59e0b (kuning)
- Info:    #6366f1 (indigo — untuk AI processing)
```

### 9. Empty States

```
STRUKTUR (centered, max-width 360px):
┌────────────────────────────────┐
│         [Ilustrasi SVG]        │  ← 160px × 120px, warna indigo/violet
│                                │
│  Belum Ada Materi              │  ← Heading 18px, Syne, 700
│  Upload materi pertamamu       │  ← Subtext 14px, slate-500
│  dan biarkan AI bekerja!       │
│                                │
│  [Tombol Upload Materi +]      │  ← Primary button
└────────────────────────────────┘

ILUSTRASI STYLE:
- SVG sederhana, bukan foto
- Warna: kombinasi indigo-100 + indigo-400 + slate-200
- Tema:
  * Materi kosong: buku / dokumen dengan tanda +
  * Quiz belum ada: otak / lightbulb dengan tanda tanya
  * Progress kosong: grafik kosong naik dengan bintang kecil
```

---

## 🖥️ HALAMAN-HALAMAN (PAGE SPECS)

### Halaman 1: Landing Page (welcome)

```
STRUKTUR HALAMAN:

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
NAVBAR (sticky, backdrop blur)
│ [E] EduMind │ Fitur · Cara Kerja · Tentang │ Masuk │ [Daftar Gratis →] │
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

HERO SECTION (full viewport height, centered)
│ Badge kecil: "✦ Powered by Google Gemini AI"
│
│ Headline (Syne 56px, 800, line-height 1.05):
│ "Belajar Lebih Cerdas
│  dengan Kekuatan AI"
│
│ Subheadline (Outfit 18px, slate-600):
│ "Upload materi kuliah, AI generate soal latihan,
│  pantau progres belajar secara real-time."
│
│ CTA buttons:
│ [Mulai Gratis — Tanpa Kartu Kredit →]  [▶ Lihat Demo]
│
│ Social proof:
│ 🎓 Dipercaya 1,200+ mahasiswa · ⭐ 4.9/5 rating
│
│ VISUAL: Floating mockup dashboard (isometric/3D tilt)
│         Screenshot nyata app, shadow besar, slight rotation
│
│ BACKGROUND: Mesh gradient sangat halus indigo-violet di pojok
│             + noise texture overlay tipis (opacity 3%)
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

HOW IT WORKS SECTION (3 langkah)
│ Label: "Cara Kerja"  Heading: "Tiga Langkah Mudah"
│
│ Step 1 ──────── Step 2 ──────── Step 3
│ [Upload ikon]   [AI ikon ✦]     [Chart ikon]
│ Upload Materi   AI Buat Soal    Lacak Progres
│ PDF atau teks   10 soal dalam   Dashboard
│ kuliah kamu     < 8 detik       analitik lengkap
│
│ Koneksi antar step: garis putus-putus dengan panah
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

FEATURES SECTION (grid 2×3)
│ Card feature: ikon 48px (bg indigo-50) + judul + deskripsi 2 kalimat
│ Hover: card lift + border indigo halus
│
│ ✨ AI Generate Soal    📊 Progress Real-time
│ 📁 Upload PDF & Teks  ⏱️ Quiz Mode + Timer
│ 🎯 Analisis Kelemahan  🏆 Streak & Gamifikasi
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

TESTIMONIAL SECTION (3 card horizonthal)
│ Quote + nama mahasiswa + kampus + avatar
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

CTA FINAL SECTION
│ Background: gradient indigo-600 → violet-600
│ Headline putih: "Siap Belajar Lebih Efektif?"
│ Sub: "Gratis selamanya untuk fitur dasar."
│ Tombol: [Daftar Sekarang →] (putih, teks indigo)
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

FOOTER
│ Logo · Tagline · Links · Copyright
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

ANIMASI LANDING PAGE:
- Scroll reveal: elemen masuk fade + slide up saat masuk viewport
- Hero badge: subtle pulse animation
- Floating mockup: gentle float up-down (6s loop)
- Feature cards: staggered reveal (delay 100ms tiap card)
```

### Halaman 2: Auth (Login & Register)

```
LAYOUT: Split 50/50
Kiri (50%): Ilustrasi + branding (background indigo gradient)
Kanan (50%): Form card (centered)

KIRI:
- Background: gradient #4f46e5 → #7c3aed
- Logo besar: "EduMind" Syne 32px, putih
- Quote motivasi (italic, putih 80%):
  "Setiap pertanyaan yang kamu jawab adalah langkah menuju pemahaman."
- Ilustrasi SVG abstract: koneksi neural / particle dots (putih, opacity 20%)

KANAN:
- Background: #f8fafc
- Card putih centered: max-width 400px, border-radius 20px, padding 40px
- Heading: "Selamat Datang Kembali" / "Buat Akun Baru"
- Sub: "Masuk untuk melanjutkan belajar"
- Form fields (email, password)
- Tombol submit (full width)
- Link: "Belum punya akun? Daftar" / "Sudah punya akun? Masuk"
- Divider: "atau" dengan garis horizontal
- Social login: [Google] [GitHub] (jika ada)
```

### Halaman 3: Dashboard Utama

```
LAYOUT: Sidebar (260px) + Content Area

CONTENT AREA (urutan dari atas):

1. GREETING SECTION
   - "Selamat pagi, Budi ☀️" (Syne 28px)
   - "Kamu punya 2 sesi quiz yang belum selesai"
   - Tanggal hari ini

2. STAT CARDS (4 kartu, grid 4 kolom)
   [Total Materi] [Soal Dikerjakan] [Rata-rata Skor] [Streak Hari]
   Setiap kartu: angka besar (Syne) + label + delta badge

3. QUICK ACTIONS (3 tombol besar)
   [+ Upload Materi]  [⚡ Generate Quiz]  [📊 Lihat Progress]

4. RECENT ACTIVITY (2 kolom)
   Kiri: "Materi Terakhir" (3 cards vertikal)
   Kanan: "Quiz Terakhir" (3 row items dengan skor)

5. PROGRESS CHART
   Line chart 7 hari terakhir (Chart.js)
   Rata-rata skor per hari, gradient fill, tooltip custom

6. MOTIVASI SECTION
   Quote motivasi random + ilustrasi kecil

WARNA ACCENT PER STAT:
- Total Materi: indigo
- Soal Dikerjakan: violet
- Rata-rata Skor: emerald (jika tinggi) / amber (sedang) / red (rendah)
- Streak: orange (untuk semangat)
```

### Halaman 4: Materi Saya

```
LAYOUT: Sidebar + Content

HEADER:
- Title "Materi Saya"
- Sub: "24 materi · 5 topik"
- Button kanan: [+ Upload Materi Baru]

FILTER & SEARCH BAR:
- Search input (kiri, 240px)
- Filter dropdown: Semua / PDF / Teks / Belum di-quiz
- Sort: Terbaru / A-Z / Paling Sering Dipakai

GRID MATERI (3 kolom, responsive):
┌──────────────────┐
│ 📄 [Tipe badge]  │  ← Warna badge: PDF=indigo, Text=violet
│                  │
│ Algoritma &      │  ← Judul (Outfit 15px, 600)
│ Struktur Data    │
│                  │
│ 12 hal · 3 hr    │  ← Meta (12px, slate-500)
│ 5 sesi quiz      │
│                  │
│ ▓▓▓▓▓▓▒▒▒░ 68% │  ← Progress bar mini
│                  │
│ [Gen. Soal ✦][…]│  ← Action buttons
└──────────────────┘

EMPTY STATE (jika kosong):
Ilustrasi SVG buku + tanda plus
"Belum ada materi"
"Upload materi pertamamu sekarang!"
[+ Upload Materi]
```

### Halaman 5: Quiz Interface (saat mengerjakan)

```
LAYOUT: Full screen, header minimal, no sidebar

HEADER (fixed top):
├── [← Keluar] (kiri, dengan konfirmasi dialog)
├── Progress: "Soal 6 dari 10" (tengah)
├── Timer: "00:42" (kanan, JetBrains Mono)
└── Progress bar: full width, 6px, indigo gradient

BODY (centered, max-width 680px):
┌────────────────────────────────────┐
│ Kategori: Algoritma                │ ← badge kecil
│                                    │
│ Algoritma manakah yang memiliki    │ ← Pertanyaan
│ kompleksitas waktu O(n log n)?     │   Outfit 18px, slate-900
│                                    │
│ ┌──────────────────────────────┐   │
│ │ [A] Bubble Sort              │   │ ← Option buttons
│ └──────────────────────────────┘   │
│ ┌──────────────────────────────┐   │
│ │ [B] Merge Sort    ← selected │   │
│ └──────────────────────────────┘   │
│ ┌──────────────────────────────┐   │
│ │ [C] Selection Sort           │   │
│ └──────────────────────────────┘   │
│ ┌──────────────────────────────┐   │
│ │ [D] Insertion Sort           │   │
│ └──────────────────────────────┘   │
│                                    │
│              [Selanjutnya →]       │
└────────────────────────────────────┘

BACKGROUND: #f8fafc (sangat subtle, fokus ke soal)
```

### Halaman 6: Hasil Quiz

```
LAYOUT: Centered, no sidebar, scrollable

SECTION 1 — SKOR HERO:
- Konfetti animation (atas layar, jika skor > 80%)
- Skor besar: angka count-up animation (0 → 78%)
- Ring chart SVG: benar vs salah
- Badge besar: "Bagus! ⭐"
- Subtext: "Kamu menjawab 8 dari 10 soal dengan benar"
- 2 tombol: [Coba Lagi] [Kembali ke Dashboard]

SECTION 2 — RINGKASAN CEPAT:
3 stat: Benar | Salah | Waktu Rata-rata per Soal

SECTION 3 — PEMBAHASAN SOAL:
List accordion setiap soal:
- Header: nomor soal + preview soal + status (✓ atau ✕)
- Expand: tampilkan soal lengkap + jawaban kamu + jawaban benar + penjelasan AI
- Warna: hijau (benar) / merah (salah)

SECTION 4 — REKOMENDASI AI:
- Card khusus dengan border violet
- Ikon: ✦ (violet)
- "Berdasarkan hasil ini, AI merekomendasikan:"
- List topik yang perlu diperkuat
- Tombol: [Generate Quiz Topik Lemah →]
```

### Halaman 7: Progress & Analitik

```
LAYOUT: Sidebar + Content

SECTION 1 — OVERVIEW CHART:
Line chart 30 hari terakhir (skor rata-rata harian)
Filter: 7 hari / 30 hari / 3 bulan

SECTION 2 — STREAK CALENDAR:
Grid 30×1 mini squares (mirip GitHub contributions)
Warna intensitas: makin sering belajar = makin gelap indigonya
Tooltip saat hover: tanggal + jumlah soal

SECTION 3 — PROGRESS PER TOPIK:
Horizontal bar chart atau stacked progress bars
Setiap topik: label + persentase + bar + badge level

SECTION 4 — ANALISIS KELEMAHAN:
Card dengan border merah tipis
"Topik yang perlu perhatian lebih:"
List topik dengan persentase salah terbesar
Tombol: [Generate Soal Topik Ini →]

SECTION 5 — RIWAYAT QUIZ:
Tabel / list semua sesi quiz
Kolom: Materi | Tanggal | Skor | Jumlah Soal | Aksi
Filter, sort, search
Tombol export: [📥 Export PDF]
```

---

## ✨ ANIMASI & MICRO-INTERACTIONS

```
PRINSIP ANIMASI:
- Durasi: 150ms (micro) / 250ms (normal) / 400ms (halaman)
- Easing: cubic-bezier(0.4, 0, 0.2, 1) untuk semua transisi
- Jangan animasi yang mengganggu — natural & purposeful

DAFTAR ANIMASI WAJIB:

Page Load:
- Fade in + slide up 16px (seluruh content, 400ms)
- Stat cards: staggered 80ms tiap kartu

Hover States:
- Button: background transition 150ms, shadow 150ms
- Card: translateY(-3px) + shadow 200ms
- Nav item: background 150ms, ease

Click / Active:
- Button: scale(0.97) 100ms → release
- Option quiz: background + border instant (< 100ms)

AI Loading State (generate soal):
- Overlay semi-transparent
- Animasi: lingkaran orbit partikel (CSS keyframe)
- Progress steps: "Membaca materi" → "Menganalisis" → "Membuat soal" → "Selesai"
- Setiap step muncul dengan fade + check ✓
- Warna accent: indigo/violet (terasa "cerdas")

Count-up Animation (skor di hasil quiz):
- Dari 0 → skor asli
- Durasi: 1.5 detik
- Easing: ease-out (cepat di awal, melambat di akhir)

Toast Notification:
- Slide dari kanan (translateX 100% → 0), 300ms
- Keluar: slide balik kanan, 250ms
- Progress bar mengecil (width transition)

Skeleton Loading:
- Shimmer effect: gradient bergerak kanan (1.5s loop)
- Warna: #e2e8f0 → #f1f5f9 (shimmer highlight)
- Tampil selama fetch data, replace saat data datang

Confetti (skor tinggi):
- Partikel warna-warni jatuh dari atas
- Hanya muncul sekali saat skor ≥ 80%
- Durasi: 3 detik
- Warna: indigo, violet, emerald, amber
```

---

## 📱 RESPONSIVE BREAKPOINTS

```
MOBILE (< 640px):
- Bottom Navigation: 5 icon (Dashboard, Materi, Quiz, Progress, Profil)
- Sidebar tidak tampil
- Cards: 1 kolom
- Header: hanya logo + hamburger (jika perlu)
- Font headline: dikurangi 20-30%
- Padding content: 16px

TABLET (640px – 1024px):
- Sidebar: collapsible (icon-only 64px atau tersembunyi)
- Cards: 2 kolom
- Toggle sidebar via hamburger icon

DESKTOP (≥ 1024px):
- Sidebar: fixed 260px, always visible
- Cards: 3 kolom (materi), 4 kolom (stat)
- Konten max-width: 1280px
```

---

## 🤖 AI FEATURE VISUAL TREATMENT

```
Setiap fitur yang menggunakan AI harus terasa SPESIAL secara visual:

AI BADGE:
- "✦ AI" atau "⚡ Powered by Gemini"
- Warna: violet (bg #f5f3ff, text #6d28d9, border #ddd6fe)
- Ukuran: 11px pill

AI BUTTON:
- Ikon ✦ atau sparkle sebelum teks
- Subtle glow saat hover: box-shadow 0 0 16px rgba(124,58,237,0.3)

AI LOADING (saat generate soal berlangsung):
Tampilkan progress steps bukan spinner biasa:
┌───────────────────────────────┐
│  ✦ AI sedang bekerja...       │
│                               │
│  ✓ Membaca materi             │  ← sudah selesai (hijau)
│  ✓ Menganalisis topik         │  ← sudah selesai (hijau)
│  ◌ Membuat 10 soal...         │  ← sedang proses (animasi)
│  ○ Menyimpan hasil            │  ← menunggu (abu)
│                               │
│  [====════════════] 60%       │  ← progress bar
└───────────────────────────────┘

AI RECOMMENDATION CARD:
- Border-left: 4px solid #7c3aed
- Background: #f5f3ff
- Header: "✦ Rekomendasi AI" (violet, 13px, 600)
- Konten: rekomendasi dalam bullet terstruktur
```

---

## 🎯 TIPS AGAR DESAIN MENANG KOMPETISI

```
YANG BIKIN JURI TERKESAN:

1. KONSISTENSI — setiap halaman terasa seperti satu produk
2. DETAIL KECIL — hover states, loading states, empty states yang rapi
3. AI TERASA NYATA — loading state AI yang informatif, bukan sekedar spinner
4. RESPONSIVE — coba di HP, harus tetap bagus
5. DARK MODE — tunjukkan saat demo, kesan profesional langsung naik
6. MICRO-ANIMATION — skor count-up, confetti, slide quiz — terasa "alive"
7. TYPOGRAPHY — campuran Syne + Outfit membedakan dari website kampus biasa

SAAT PITCHING:
- Demo live dari HP/laptop langsung (bukan screenshot)
- Tunjukkan flow: Upload → AI Loading → Kerjakan Quiz → Lihat Hasil
- Highlight angka: "AI generate 10 soal dalam < 8 detik"
- Dark mode toggle live — selalu bikin wow
```

---

## 📋 CHECKLIST DESAIN SEBELUM PITCHING

```
VISUAL IDENTITY
☐ Logo konsisten di semua halaman
☐ Color palette tidak ada yang menyimpang
☐ Font hanya Syne + Outfit + JetBrains Mono

HALAMAN WAJIB ADA
☐ Landing page (dengan hero + fitur + CTA)
☐ Login / Register
☐ Dashboard
☐ Halaman materi
☐ Upload materi
☐ Generate soal (dengan AI loading state)
☐ Quiz interface
☐ Hasil quiz
☐ Progress tracker

KOMPONEN WAJIB
☐ Sidebar navigasi
☐ Toast notification (minimal 1 contoh)
☐ Empty state (minimal 1 halaman)
☐ Loading skeleton (minimal 1 halaman)
☐ Responsive mobile (test di 375px width)
☐ Dark mode (semua halaman)
☐ AI badge / treatment pada fitur AI

MICRO-INTERACTIONS
☐ Button hover + active
☐ Card hover
☐ Input focus state
☐ Quiz option selection
☐ AI loading animation
☐ Skor count-up

AKSESIBILITAS DASAR
☐ Kontras teks cukup (WCAG AA)
☐ Focus indicator terlihat
☐ Alt text pada gambar/ikon penting
```

---

*Design Prompt untuk EduMind — Final Project Informatika · Kompetisi CODE 2024*
*Aesthetic: "Neural Clarity" · Font: Syne + Outfit · Color: Indigo + Violet*
