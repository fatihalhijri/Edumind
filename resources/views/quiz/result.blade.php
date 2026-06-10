<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('edumind-dark-mode')==='true' }" :class="{ 'dark': darkMode }" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Quiz — EduMind</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Outfit:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>(function(){if(localStorage.getItem('edumind-dark-mode')==='true')document.documentElement.classList.add('dark');})()</script>
</head>
<body class="font-sans" style="background: var(--surface-1);">

@php
    $score = $quizSession->score ?? 0;
    $total = $quizSession->questions->count();
    $correct = $quizSession->attempts->where('is_correct', true)->count();
    $wrong   = $total - $correct;

    if ($score >= 90)     { $badgeLabel = 'Luar Biasa! 🏆'; $badgeClass = 'badge-success'; }
    elseif ($score >= 70) { $badgeLabel = 'Bagus! ⭐';       $badgeClass = 'badge-info'; }
    elseif ($score >= 50) { $badgeLabel = 'Terus Berkembang 📈'; $badgeClass = 'badge-warning'; }
    else                  { $badgeLabel = 'Jangan Menyerah 💪'; $badgeClass = 'badge-danger'; }

    // Warna ring chart
    $strokeColor = $score >= 70 ? '#10b981' : ($score >= 50 ? '#f59e0b' : '#ef4444');
    $radius = 54;
    $circumference = 2 * pi() * $radius;
    $dashOffset = $circumference * (1 - $score / 100);
@endphp

{{-- Confetti (jika skor ≥ 80%) --}}
@if($score >= 80)
<div id="confetti-container" class="fixed inset-0 pointer-events-none z-50 overflow-hidden"></div>
@endif

<div class="max-w-2xl mx-auto px-4 py-8 pb-24">

    {{-- ── HERO SKOR ────────────────────────────────────── --}}
    <div class="card-static rounded-3xl p-8 text-center mb-6">
        <p class="text-sm font-semibold mb-4 uppercase tracking-wider" style="color: var(--text-muted);">
            {{ $quizSession->title }}
        </p>

        {{-- Ring Chart SVG --}}
        <div class="relative w-40 h-40 mx-auto mb-5">
            <svg class="w-40 h-40 -rotate-90" viewBox="0 0 120 120">
                <circle cx="60" cy="60" r="{{ $radius }}" fill="none"
                        stroke-width="10" style="stroke: var(--surface-3);"/>
                <circle cx="60" cy="60" r="{{ $radius }}" fill="none"
                        stroke="{{ $strokeColor }}" stroke-width="10"
                        stroke-linecap="round"
                        stroke-dasharray="{{ $circumference }}"
                        stroke-dashoffset="{{ $circumference }}"
                        style="transition: stroke-dashoffset 1.5s ease-out;"
                        id="score-ring"/>
            </svg>
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="font-mono font-bold text-4xl" id="score-display" style="color: {{ $strokeColor }};">0</span>
                <span class="text-xs font-medium" style="color: var(--text-muted);">/ 100</span>
            </div>
        </div>

        <span class="badge {{ $badgeClass }} text-sm px-4 py-2 mb-4 inline-block">{{ $badgeLabel }}</span>

        <p class="text-sm" style="color: var(--text-secondary);">
            Kamu menjawab <strong style="color: var(--text-primary);">{{ $correct }} dari {{ $total }}</strong> soal dengan benar
        </p>

        {{-- Quick stats --}}
        <div class="grid grid-cols-3 gap-4 mt-6 pt-6" style="border-top: 1px solid var(--border);">
            <div>
                <p class="font-mono text-2xl font-bold" style="color: #10b981;">{{ $correct }}</p>
                <p class="text-xs" style="color: var(--text-muted);">Benar</p>
            </div>
            <div>
                <p class="font-mono text-2xl font-bold" style="color: #ef4444;">{{ $wrong }}</p>
                <p class="text-xs" style="color: var(--text-muted);">Salah</p>
            </div>
            <div>
                @php
                    $avgTime = $quizSession->attempts->avg('time_spent_seconds');
                @endphp
                <p class="font-mono text-2xl font-bold" style="color: var(--primary-600);">{{ $avgTime ? round($avgTime) . 'd' : '—' }}</p>
                <p class="text-xs" style="color: var(--text-muted);">Rata-rata</p>
            </div>
        </div>

        {{-- Action buttons --}}
        <div class="flex gap-3 mt-6">
            <a href="{{ route('quiz.start', $quizSession) }}" class="btn-ghost flex-1 justify-center">Coba Lagi</a>
            <a href="{{ route('dashboard') }}" class="btn-primary flex-1 justify-center">Dashboard</a>
        </div>
    </div>

    {{-- ── AI REKOMENDASI ───────────────────────────────── --}}
    @if($wrong > 0)
    <div class="rounded-2xl p-5 mb-6" style="background: #f5f3ff; border-left: 4px solid #7c3aed; border: 1px solid #ddd6fe;">
        <p class="text-xs font-semibold mb-2" style="color: #7c3aed;">✦ Rekomendasi AI</p>
        <p class="text-sm font-medium mb-2" style="color: var(--text-primary);">Berdasarkan hasil ini, fokus pada:</p>
        <ul class="space-y-1">
            @foreach($quizSession->questions->filter(fn($q) => $q->attempts->first()?->is_correct === false)->take(3) as $q)
            <li class="text-xs flex items-start gap-2" style="color: var(--text-secondary);">
                <span style="color: #7c3aed; flex-shrink: 0;">→</span>
                {{ Str::limit($q->question_text, 80) }}
            </li>
            @endforeach
        </ul>
        <a href="{{ route('quiz.generate', $quizSession->material) }}" class="btn-ai text-xs mt-3 inline-flex">
            ✦ Generate Quiz Topik Lemah
        </a>
    </div>
    @endif

    {{-- ── PEMBAHASAN SOAL ─────────────────────────────── --}}
    <div class="card-static rounded-2xl p-5">
        <h2 class="font-serif text-lg font-bold mb-4" style="color: var(--text-primary);">Pembahasan Soal</h2>

        <div class="space-y-3" x-data="{ open: null }">
            @foreach($quizSession->questions as $i => $question)
            @php
                $attempt    = $question->attempts->first();
                $isCorrect  = $attempt?->is_correct;
                $userAnswer = $attempt?->user_answer ?? '—';
                $bgColor    = $isCorrect ? '#f0fdf4' : '#fef2f2';
                $borderColor= $isCorrect ? '#16a34a' : '#ef4444';
                $icon       = $isCorrect ? '✓' : '✕';
                $iconColor  = $isCorrect ? '#15803d' : '#dc2626';
            @endphp

            <div class="rounded-xl overflow-hidden" style="border: 1px solid {{ $borderColor }}30;">
                {{-- Accordion Header --}}
                <button @click="open = open === {{ $i }} ? null : {{ $i }}"
                        class="w-full flex items-center gap-3 px-4 py-3 text-left transition-colors"
                        :style="open === {{ $i }} ? 'background: {{ $bgColor }};' : 'background: var(--surface-1);'">
                    <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 text-white"
                          style="background: {{ $borderColor }};">{{ $icon }}</span>
                    <span class="text-sm font-medium flex-1" style="color: var(--text-primary);">
                        {{ $i + 1 }}. {{ Str::limit($question->question_text, 60) }}
                    </span>
                    <svg class="w-4 h-4 transition-transform flex-shrink-0" style="color: var(--text-muted);"
                         :style="open === {{ $i }} ? 'transform: rotate(180deg)' : ''"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Accordion Body --}}
                <div x-show="open === {{ $i }}"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="px-4 pb-4 pt-2" style="background: {{ $bgColor }};">
                    <p class="text-sm mb-3" style="color: var(--text-primary);">{{ $question->question_text }}</p>

                    @if($question->question_type === 'multiple_choice' && $question->options)
                    <div class="space-y-1.5 mb-3">
                        @foreach($question->options as $opt)
                        @php
                            $letter = $opt[0] ?? '';
                            $isCorrectOpt = strtoupper($letter) === strtoupper($question->correct_answer ?? '');
                            $isUserOpt    = strtoupper($letter) === strtoupper($userAnswer ?? '');
                        @endphp
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm"
                             style="background: {{ $isCorrectOpt ? '#dcfce7' : ($isUserOpt && !$isCorrectOpt ? '#fee2e2' : 'var(--surface-0)') }};
                                    border: 1px solid {{ $isCorrectOpt ? '#16a34a' : ($isUserOpt && !$isCorrectOpt ? '#ef4444' : 'var(--border)') }};">
                            <span class="font-bold text-xs w-5">{{ $letter }}</span>
                            <span>{{ substr($opt, 3) }}</span>
                            @if($isCorrectOpt) <span class="ml-auto text-xs" style="color: #15803d;">✓ Benar</span> @endif
                            @if($isUserOpt && !$isCorrectOpt) <span class="ml-auto text-xs" style="color: #dc2626;">✕ Jawabanmu</span> @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="rounded-lg p-3 mb-3 text-sm" style="background: var(--surface-0); border: 1px solid var(--border);">
                        <p class="text-xs font-medium mb-1" style="color: var(--text-muted);">Jawabanmu:</p>
                        <p style="color: var(--text-primary);">{{ $userAnswer }}</p>
                    </div>
                    @endif

                    @if($question->explanation)
                    <div class="rounded-lg p-3 text-xs" style="background: var(--surface-0); border: 1px solid var(--border);">
                        <p class="font-semibold mb-1" style="color: var(--text-primary);">💡 Penjelasan:</p>
                        <p style="color: var(--text-secondary);">{{ $question->explanation }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Count-up animation skor
    const target = {{ $score }};
    const display = document.getElementById('score-display');
    const ring    = document.getElementById('score-ring');
    const circumference = {{ $circumference }};
    const dashOffset    = {{ $dashOffset }};

    if (!display || !ring) return;

    const duration = 1500;
    const steps    = 60;
    const interval = duration / steps;
    let current    = 0;
    const increment = target / steps;

    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        display.textContent = Math.floor(current);
        const offset = circumference * (1 - current / 100);
        ring.style.strokeDashoffset = offset;
    }, interval);

    @if($score >= 80)
    // Confetti
    createConfetti();
    @endif
});

@if($score >= 80)
function createConfetti() {
    const container = document.getElementById('confetti-container');
    const colors = ['#6366f1','#7c3aed','#10b981','#f59e0b','#f97316','#ec4899'];
    for (let i = 0; i < 80; i++) {
        const div = document.createElement('div');
        const size = Math.random() * 10 + 5;
        div.style.cssText = `
            position: absolute;
            width: ${size}px; height: ${size}px;
            background: ${colors[Math.floor(Math.random() * colors.length)]};
            left: ${Math.random() * 100}%;
            top: -20px;
            border-radius: ${Math.random() > 0.5 ? '50%' : '0'};
            animation: confettiFall ${Math.random() * 2 + 2}s ease-in ${Math.random() * 2}s forwards;
            opacity: 0.9;
        `;
        container.appendChild(div);
    }
}
@endif
</script>

</body>
</html>
