<x-app-layout>
    <x-slot name="title">{{ $quizSession->title }}</x-slot>
    <x-slot name="breadcrumb">Quiz › {{ Str::limit($quizSession->title, 30) }}</x-slot>

    <div class="max-w-2xl mx-auto pb-20 md:pb-0">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('quiz.index') }}" class="btn-ghost text-sm px-3 py-2">← Kembali</a>
            <h1 class="font-serif text-xl font-bold flex-1" style="color: var(--text-primary);">{{ $quizSession->title }}</h1>
        </div>

        <div class="card-static rounded-2xl p-5 mb-4">
            <div class="flex flex-wrap gap-2 mb-4">
                <span class="badge badge-neutral">{{ $quizSession->total_questions }} soal</span>
                <span class="badge {{ $quizSession->status === 'completed' ? 'badge-success' : 'badge-primary' }}">
                    {{ ucfirst($quizSession->status) }}
                </span>
                <span class="badge badge-neutral">{{ $quizSession->material->title ?? '—' }}</span>
            </div>

            <div class="flex gap-3">
                @if($quizSession->status === 'active')
                <a href="{{ route('quiz.start', $quizSession) }}" class="btn-primary flex-1 justify-center">▶ Mulai Quiz</a>
                @elseif($quizSession->status === 'completed')
                <a href="{{ route('quiz.result', $quizSession) }}" class="btn-secondary flex-1 justify-center">📊 Lihat Hasil</a>
                <a href="{{ route('quiz.start', $quizSession) }}" class="btn-ghost">Coba Lagi</a>
                @endif
            </div>
        </div>

        {{-- Daftar Soal --}}
        <div class="card-static rounded-2xl p-5">
            <h2 class="font-semibold mb-4" style="color: var(--text-primary);">Daftar Soal ({{ $quizSession->questions->count() }})</h2>
            <div class="space-y-3">
                @foreach($quizSession->questions as $i => $question)
                <div class="flex gap-3 p-3 rounded-xl" style="background: var(--surface-1);">
                    <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0"
                          style="background: var(--primary-50); color: var(--primary-700);">{{ $i+1 }}</span>
                    <div class="flex-1">
                        <p class="text-sm" style="color: var(--text-primary);">{{ $question->question_text }}</p>
                        <span class="badge badge-neutral mt-1 text-xs">{{ $question->question_type === 'multiple_choice' ? 'Pilihan Ganda' : 'Esai' }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
