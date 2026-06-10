<x-app-layout>
    <x-slot name="title">Quiz & Latihan</x-slot>
    <x-slot name="breadcrumb">Quiz & Latihan</x-slot>

    <div class="space-y-5 pb-20 md:pb-0">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="font-serif text-2xl font-bold" style="color: var(--text-primary);">Quiz & Latihan</h1>
                <p class="text-sm mt-0.5" style="color: var(--text-muted);">{{ $sessions->total() }} sesi quiz</p>
            </div>
            <a href="{{ route('materials.index') }}" class="btn-ai text-sm">
                ✦ Buat Quiz Baru
            </a>
        </div>

        @if($sessions->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <svg class="w-32 h-24 mb-4" viewBox="0 0 160 120" fill="none">
                <circle cx="80" cy="55" r="40" fill="#eef2ff" stroke="#a5b4fc" stroke-width="2"/>
                <path d="M70 55a10 10 0 0120 0c0 6-4 9-10 14" stroke="#6366f1" stroke-width="3" stroke-linecap="round"/>
                <circle cx="80" cy="78" r="3" fill="#6366f1"/>
                <circle cx="115" cy="30" r="12" fill="#f5f3ff" stroke="#c4b5fd" stroke-width="1.5"/>
                <text x="110" y="35" font-size="14" fill="#7c3aed">✦</text>
            </svg>
            <h2 class="font-serif text-xl font-bold mb-2" style="color: var(--text-primary);">Belum ada quiz</h2>
            <p class="text-sm mb-5" style="color: var(--text-muted);">Upload materi dulu, lalu generate soal dengan AI</p>
            <a href="{{ route('materials.create') }}" class="btn-primary">Upload Materi Pertama</a>
        </div>
        @else
        <div class="space-y-3">
            @foreach($sessions as $session)
            @php $badge = $session->score_badge; @endphp
            <div class="card-static rounded-xl p-4 flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="badge {{ $session->status === 'completed' ? 'badge-success' : ($session->status === 'active' ? 'badge-primary' : 'badge-neutral') }}">
                            {{ $session->status === 'completed' ? 'Selesai' : ($session->status === 'active' ? 'Aktif' : 'Generating') }}
                        </span>
                        <span class="badge badge-neutral text-xs">{{ $session->total_questions }} soal</span>
                    </div>
                    <h3 class="font-semibold text-sm" style="color: var(--text-primary);">{{ $session->title }}</h3>
                    <p class="text-xs mt-0.5" style="color: var(--text-muted);">
                        {{ $session->material->title ?? '—' }} · {{ $session->created_at->locale('id')->diffForHumans() }}
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    @if($session->score !== null)
                    <span class="badge {{ $badge['class'] }} font-mono text-sm px-3 py-1.5">{{ $session->score }}%</span>
                    @endif

                    @if($session->status === 'active')
                    <a href="{{ route('quiz.start', $session) }}" class="btn-primary text-sm">Mulai</a>
                    @elseif($session->status === 'completed')
                    <a href="{{ route('quiz.result', $session) }}" class="btn-secondary text-sm">Review</a>
                    @else
                    <span class="text-xs" style="color: var(--text-muted);">Memproses...</span>
                    @endif

                    <a href="{{ route('quiz.show', $session) }}" class="btn-ghost text-sm px-3">Lihat</a>
                </div>
            </div>
            @endforeach
        </div>

        @if($sessions->hasPages())
        <div>{{ $sessions->links() }}</div>
        @endif
        @endif
    </div>
</x-app-layout>
