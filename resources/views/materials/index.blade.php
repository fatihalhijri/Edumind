<x-app-layout>
    <x-slot name="title">Materi Saya</x-slot>
    <x-slot name="breadcrumb">Materi Saya</x-slot>

    <div class="space-y-5 pb-20 md:pb-0">

        {{-- ── HEADER ───────────────────────────────────── --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="font-serif text-2xl font-bold" style="color: var(--text-primary);">Materi Saya</h1>
                <p class="text-sm mt-0.5" style="color: var(--text-muted);">
                    {{ $materials->total() }} materi tersimpan
                </p>
            </div>
            <a href="{{ route('materials.create') }}" class="btn-primary self-start">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Upload Materi Baru
            </a>
        </div>

        {{-- ── FILTER & SEARCH ──────────────────────────── --}}
        <form method="GET" action="{{ route('materials.index') }}"
              class="flex flex-col sm:flex-row gap-3">
            {{-- Search --}}
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--text-muted);">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-input pl-10 w-full"
                       placeholder="Cari judul atau deskripsi...">
            </div>

            {{-- Filter --}}
            <select name="filter" onchange="this.form.submit()"
                    class="form-input w-full sm:w-40">
                <option value="" {{ !request('filter') ? 'selected' : '' }}>Semua</option>
                <option value="pdf"     {{ request('filter') === 'pdf'     ? 'selected' : '' }}>PDF</option>
                <option value="text"    {{ request('filter') === 'text'    ? 'selected' : '' }}>Teks</option>
                <option value="no_quiz" {{ request('filter') === 'no_quiz' ? 'selected' : '' }}>Belum di-quiz</option>
            </select>

            <button type="submit" class="btn-primary px-5">Cari</button>
        </form>

        {{-- ── MATERIALS GRID ───────────────────────────── --}}
        @if($materials->isEmpty())
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <svg class="w-32 h-24 mb-4" viewBox="0 0 160 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="20" y="20" width="80" height="100" rx="8" fill="#e0e7ff" stroke="#a5b4fc" stroke-width="2"/>
                    <rect x="35" y="40" width="50" height="6" rx="3" fill="#a5b4fc"/>
                    <rect x="35" y="55" width="40" height="6" rx="3" fill="#c7d2fe"/>
                    <rect x="35" y="70" width="45" height="6" rx="3" fill="#c7d2fe"/>
                    <circle cx="125" cy="45" r="22" fill="#eef2ff" stroke="#818cf8" stroke-width="2"/>
                    <path d="M125 35v20M115 45h20" stroke="#6366f1" stroke-width="3" stroke-linecap="round"/>
                </svg>
                <h2 class="font-serif text-xl font-bold mb-2" style="color: var(--text-primary);">
                    {{ request('search') ? 'Materi tidak ditemukan' : 'Belum ada materi' }}
                </h2>
                <p class="text-sm mb-5" style="color: var(--text-muted);">
                    {{ request('search') ? 'Coba kata kunci yang berbeda' : 'Upload materi pertamamu dan biarkan AI bekerja!' }}
                </p>
                @if(!request('search'))
                    <a href="{{ route('materials.create') }}" class="btn-primary">
                        + Upload Materi Pertama
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($materials as $material)
                <div class="card group p-5 flex flex-col gap-4" style="cursor: default;">
                    {{-- Header --}}
                    <div class="flex items-start gap-3">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                             style="background: {{ $material->file_type === 'pdf' ? 'var(--primary-50)' : '#f5f3ff' }};">
                            <span class="text-xl">{{ $material->file_type === 'pdf' ? '📄' : '📝' }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-sm leading-snug line-clamp-2" style="color: var(--text-primary);">
                                {{ $material->title }}
                            </h3>
                            <p class="text-xs mt-1" style="color: var(--text-muted);">
                                {{ $material->created_at->locale('id')->isoFormat('D MMM Y') }}
                            </p>
                        </div>
                        <span class="badge {{ $material->file_type === 'pdf' ? 'badge-primary' : 'badge-ai' }} flex-shrink-0">
                            {{ strtoupper($material->file_type) }}
                        </span>
                    </div>

                    {{-- Description --}}
                    @if($material->description)
                    <p class="text-xs line-clamp-2" style="color: var(--text-secondary);">{{ $material->description }}</p>
                    @endif

                    {{-- Stats --}}
                    <div class="flex items-center gap-4 text-xs" style="color: var(--text-muted);">
                        <span>
                            {{ $material->raw_text ? number_format(str_word_count($material->raw_text)) . ' kata' : '—' }}
                        </span>
                        <span class="w-1 h-1 rounded-full" style="background: var(--border-strong);"></span>
                        <span>{{ $material->quiz_count }} sesi quiz</span>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2 mt-auto pt-3" style="border-top: 1px solid var(--border);">
                        <a href="{{ route('quiz.generate', $material) }}"
                           class="btn-ai flex-1 justify-center text-xs py-2">
                            ✦ Generate Soal
                        </a>
                        <a href="{{ route('materials.show', $material) }}"
                           class="btn-ghost px-3 py-2 text-xs">Lihat</a>
                        <form method="POST" action="{{ route('materials.destroy', $material) }}"
                              onsubmit="return confirm('Hapus materi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger px-3 py-2 text-xs">Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($materials->hasPages())
            <div class="mt-4">{{ $materials->links() }}</div>
            @endif
        @endif
    </div>
</x-app-layout>
