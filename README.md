<div align="center">

# 🧠 EduMind
### AI-Powered Interactive Learning Platform

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v3-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Gemini API](https://img.shields.io/badge/Gemini_API-Google-4285F4?style=for-the-badge&logo=google&logoColor=white)](https://aistudio.google.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

> Platform pembelajaran interaktif berbasis AI yang membantu pengguna belajar lebih cerdas, bukan lebih keras.

[Demo](#) · [Laporan Bug](issues) · [Fitur Baru](issues)

</div>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Struktur Proyek](#-struktur-proyek)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)

---

## 🚀 Tentang Proyek

**EduMind** adalah platform pembelajaran interaktif berbasis kecerdasan buatan yang dirancang untuk memberikan pengalaman belajar yang personal dan adaptif. Dengan memanfaatkan Google Gemini API, EduMind mampu memahami kebutuhan setiap pengguna dan menyajikan materi yang relevan secara real-time.

Proyek ini dikembangkan sebagai solusi atas permasalahan nyata di lingkungan kampus — khususnya kurangnya platform belajar yang interaktif, terjangkau, dan dapat diakses kapan saja.

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 🤖 **AI Tutor** | Asisten belajar berbasis Gemini AI yang menjawab pertanyaan secara kontekstual |
| 📚 **Manajemen Materi** | Upload, kelola, dan akses materi pembelajaran dengan mudah |
| 📝 **Kuis Interaktif** | Soal latihan yang di-generate otomatis oleh AI sesuai topik |
| 📊 **Progress Tracking** | Pantau perkembangan belajar secara visual dan real-time |
| 🔐 **Autentikasi** | Login & Register aman menggunakan Laravel Breeze |
| 📱 **Responsive UI** | Tampilan optimal di semua perangkat (mobile & desktop) |

---

## 🛠 Tech Stack

**Backend**
- [Laravel 11](https://laravel.com/) — PHP Framework
- [Laravel Breeze](https://laravel.com/docs/starter-kits) — Autentikasi starter kit
- [Eloquent ORM](https://laravel.com/docs/eloquent) — Database interaction

**Frontend**
- [Blade](https://laravel.com/docs/blade) — Laravel templating engine
- [Tailwind CSS v3](https://tailwindcss.com/) — Utility-first CSS framework
- [Alpine.js](https://alpinejs.dev/) — Lightweight JavaScript framework

**Database**
- [MySQL](https://www.mysql.com/) — Relational database

**AI Integration**
- [Google Gemini API](https://aistudio.google.com/) — Primary AI engine (gratis)
- [OpenAI GPT-4o-mini](https://openai.com/) — Alternatif AI engine

---

## ⚙️ Instalasi

### Prasyarat

Pastikan kamu sudah menginstall:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL


> 💡 Dapatkan Gemini API Key gratis di [Google AI Studio](https://aistudio.google.com/apikey)

---

## 📖 Penggunaan

1. **Register** akun baru atau **Login** dengan akun yang sudah ada
2. Pilih **topik pembelajaran** yang ingin dipelajari
3. Gunakan **AI Tutor** untuk bertanya atau meminta penjelasan materi
4. Kerjakan **kuis interaktif** yang di-generate otomatis
5. Pantau **progress belajar** kamu di dashboard

---

## 📁 Struktur Proyek

```
edumind/
├── app/
│   ├── Http/Controllers/     # Controller utama
│   ├── Models/               # Eloquent models
│   └── Services/             # AI service layer (Gemini/OpenAI)
├── resources/
│   ├── views/                # Blade templates
│   └── js/                   # Alpine.js components
├── routes/
│   └── web.php               # Routing aplikasi
├── database/
│   ├── migrations/           # Skema database
│   └── seeders/              # Data awal
└── .env.example              # Template konfigurasi
```

---

## 🤝 Kontribusi

Kontribusi sangat kami sambut! Ikuti langkah berikut:

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b fitur/NamaFitur`)
3. Commit perubahan (`git commit -m 'Menambahkan NamaFitur'`)
4. Push ke branch (`git push origin fitur/NamaFitur`)
5. Buat Pull Request

---


## 📄 Lisensi

Didistribusikan di bawah Lisensi MIT. Lihat [`LICENSE`](LICENSE) untuk informasi lebih lanjut.

---

<div align="center">

⭐ **Jangan lupa makan!** ⭐

Made with ❤️ by EduMind · AMIKOM Yogyakarta

</div>
