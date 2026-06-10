<x-app-layout>
    <x-slot name="title">{{ $material->title }}</x-slot>
    <x-slot name="breadcrumb">Materi Saya › Detail</x-slot>

    <div class="max-w-3xl mx-auto pb-20 md:pb-0">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('materials.index') }}" class="btn-ghost text-sm px-3 py-2">← Kembali</a>
        </div>

        <div class="card-static rounded-2xl p-6 mb-4">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: {{ $material->file_type === 'pdf' ? 'var(--primary-50)' : '#f5f3ff' }};">
                    <span class="text-2xl">{{ $material->file_type === 'pdf' ? '📄' : '📝' }}</span>
                </div>
                <div class="flex-1">
                    <h1 class="font-serif text-xl font-bold mb-1" style="color: var(--text-primary);">{{ $material->title }}</h1>
                    <div class="flex flex-wrap gap-2">
                        <span class="badge {{ $material->file_type === 'pdf' ? 'badge-primary' : 'badge-ai' }}">{{ strtoupper($material->file_type) }}</span>
                        <span class="badge badge-neutral">{{ $material->created_at->locale('id')->isoFormat('D MMM Y') }}</span>
                        <span class="badge badge-neutral">{{ $material->quiz_count }} quiz dibuat</span>
                    </div>
                </div>
            </div>

            @if($material->description)
            <p class="text-sm mb-4" style="color: var(--text-secondary);">{{ $material->description }}</p>
            @endif

            <div class="flex gap-3">
                <a href="{{ route('quiz.generate', $material) }}" class="btn-ai flex-1 justify-center">✦ Generate Soal</a>
                <form method="POST" action="{{ route('materials.destroy', $material) }}"
                      onsubmit="return confirm('Hapus materi ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger">Hapus</button>
                </form>
            </div>
        </div>

        @if($material->raw_text)
        <div class="card-static rounded-2xl p-5">
            <h2 class="font-semibold mb-3" style="color: var(--text-primary);">Preview Teks Materi</h2>
            <div class="rounded-xl p-4 text-sm leading-relaxed" style="background: var(--surface-1); color: var(--text-secondary); max-height: 400px; overflow-y: auto;">
                {{ Str::limit($material->raw_text, 2000) }}
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
