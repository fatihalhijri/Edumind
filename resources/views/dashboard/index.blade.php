<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="breadcrumb">Dashboard</x-slot>

    <div class="space-y-6 pb-20 md:pb-0">

        {{-- ── GREETING ─────────────────────────────────── --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="font-serif text-2xl md:text-3xl font-bold" style="color: var(--text-primary);">
                    {{ $greeting ?? 'Halo' }}, {{ auth()->user()->name }}
                    <span>{{ $greetEmoji ?? '👋' }}</span>
                </h1>
                <p class="text-sm mt-1" style="color: var(--text-secondary);">
                    {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </p>
            </div>
            <a href="{{ route('materials.create') }}" class="btn-primary self-start">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Upload Materi
            </a>
        </div>

        {{-- ── STAT CARDS ───────────────────────────────── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @php
            $stats = [
                ['label' => 'Total Materi',    'value' => $totalMaterials,  'icon' => '📄', 'color' => 'var(--primary-600)'],
                ['label' => 'Soal Dikerjakan', 'value' => $totalQuestions,  'icon' => '✏️',  'color' => '#7c3aed'],
                ['label' => 'Rata-rata Skor',  'value' => $avgScore . '%',  'icon' => '🎯', 'color' => $avgScore >= 70 ? '#10b981' : ($avgScore >= 50 ? '#f59e0b' : '#ef4444')],
                ['label' => 'Hari Streak',     'value' => $streak,          'icon' => '🔥', 'color' => '#f97316'],
            ];
            @endphp

            @foreach ($stats as $i => $stat)
            <div class="card-static rounded-xl p-5 stat-card"
                 style="animation-delay: {{ $i * 80 }}ms;"
                 x-data="countUp({{ is_int($stat['value']) ? $stat['value'] : 0 }})"
                 x-intersect="start()">
                <div class="flex items-start justify-between mb-3">
                    <span class="text-2xl">{{ $stat['icon'] }}</span>
                </div>
                <p class="font-serif text-2xl md:text-3xl font-bold" style="color: {{ $stat['color'] }};">
                    @if(is_int($stat['value']))
                        <span x-text="displayed">0</span>
                    @else
                        {{ $stat['value'] }}
                    @endif
                </p>
                <p class="text-xs mt-1 font-medium" style="color: var(--text-muted);">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- ── QUICK ACTIONS ────────────────────────────── --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <a href="{{ route('materials.create') }}"
               class="flex items-center gap-3 p-4 rounded-xl border-2 border-dashed transition-all duration-200 group"
               style="border-color: var(--primary-200); background: var(--primary-50);"
               onmouseover="this.style.borderColor='var(--primary-500)';this.style.background='var(--primary-100)'"
               onmouseout="this.style.borderColor='var(--primary-200)';this.style.background='var(--primary-50)'">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white flex-shrink-0"
                     style="background: var(--primary-600);">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-sm" style="color: var(--primary-700);">Upload Materi</p>
                    <p class="text-xs" style="color: var(--text-muted);">PDF atau teks</p>
                </div>
            </a>

            <a href="{{ route('quiz.index') }}"
               class="flex items-center gap-3 p-4 rounded-xl border-2 border-dashed transition-all duration-200"
               style="border-color: #ddd6fe; background: #f5f3ff;"
               onmouseover="this.style.borderColor='#7c3aed';this.style.background='#ede9fe'"
               onmouseout="this.style.borderColor='#ddd6fe';this.style.background='#f5f3ff'">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white flex-shrink-0"
                     style="background: #7c3aed;">
                    <span class="text-lg">✦</span>
                </div>
                <div>
                    <p class="font-semibold text-sm" style="color: #6d28d9;">Generate Quiz</p>
                    <p class="text-xs" style="color: var(--text-muted);">Dengan AI</p>
                </div>
            </a>

            <a href="{{ route('progress.index') }}"
               class="flex items-center gap-3 p-4 rounded-xl border-2 border-dashed transition-all duration-200"
               style="border-color: #bbf7d0; background: #f0fdf4;"
               onmouseover="this.style.borderColor='#10b981';this.style.background='#dcfce7'"
               onmouseout="this.style.borderColor='#bbf7d0';this.style.background='#f0fdf4'">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white flex-shrink-0"
                     style="background: #10b981;">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-sm" style="color: #15803d;">Lihat Progress</p>
                    <p class="text-xs" style="color: var(--text-muted);">Analitik lengkap</p>
                </div>
            </a>
        </div>

        {{-- ── RECENT ACTIVITY ──────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Materi Terakhir --}}
            <div class="card-static rounded-xl p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-base" style="color: var(--text-primary);">Materi Terakhir</h2>
                    <a href="{{ route('materials.index') }}" class="text-xs hover:underline" style="color: var(--primary-600);">Lihat semua →</a>
                </div>

                @if($recentMaterials->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-3xl mb-2">📄</p>
                        <p class="text-sm" style="color: var(--text-muted);">Belum ada materi</p>
                        <a href="{{ route('materials.create') }}" class="btn-primary text-xs mt-3 inline-flex">Upload Sekarang</a>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($recentMaterials as $material)
                        <div class="flex items-center gap-3 p-3 rounded-xl transition-colors"
                             style="background: var(--surface-1);"
                             onmouseover="this.style.background='var(--surface-2)'"
                             onmouseout="this.style.background='var(--surface-1)'">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                                 style="background: {{ $material->file_type === 'pdf' ? 'var(--primary-50)' : '#f5f3ff' }};">
                                <span class="text-lg">{{ $material->file_type === 'pdf' ? '📄' : '📝' }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium truncate" style="color: var(--text-primary);">{{ $material->title }}</p>
                                <p class="text-xs" style="color: var(--text-muted);">{{ $material->created_at->locale('id')->diffForHumans() }}</p>
                            </div>
                            <a href="{{ route('quiz.generate', $material) }}" class="text-xs btn-secondary px-3 py-1.5 whitespace-nowrap">✦ Generate</a>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Quiz Terakhir --}}
            <div class="card-static rounded-xl p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-base" style="color: var(--text-primary);">Quiz Terakhir</h2>
                    <a href="{{ route('quiz.index') }}" class="text-xs hover:underline" style="color: var(--primary-600);">Lihat semua →</a>
                </div>

                @if($recentQuizzes->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-3xl mb-2">🧠</p>
                        <p class="text-sm" style="color: var(--text-muted);">Belum ada quiz</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($recentQuizzes as $quiz)
                        @php $badge = $quiz->score_badge; @endphp
                        <div class="flex items-center gap-3 p-3 rounded-xl" style="background: var(--surface-1);">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium truncate" style="color: var(--text-primary);">{{ $quiz->title }}</p>
                                <p class="text-xs" style="color: var(--text-muted);">{{ $quiz->material->title ?? '—' }} · {{ $quiz->created_at->locale('id')->diffForHumans() }}</p>
                            </div>
                            @if($quiz->score !== null)
                                <span class="badge {{ $badge['class'] }} font-mono">{{ $quiz->score }}%</span>
                            @else
                                <span class="badge badge-neutral">Belum selesai</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- ── CHART PROGRESS ───────────────────────────── --}}
        <div class="card-static rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-base" style="color: var(--text-primary);">Perkembangan Skor (7 Hari)</h2>
                <span class="badge badge-primary">Chart.js</span>
            </div>
            <canvas id="scoreChart" height="80"></canvas>
        </div>

        {{-- ── MOTIVASI ─────────────────────────────────── --}}
        <div class="rounded-xl p-5" style="background: linear-gradient(135deg, var(--primary-600), #7c3aed);">
            <p class="text-white/60 text-xs font-semibold uppercase tracking-wider mb-2">✦ Quote of the Day</p>
            <blockquote class="text-white text-base font-medium leading-relaxed mb-1">
                "{{ $quote['text'] }}"
            </blockquote>
            <p class="text-white/60 text-xs">— {{ $quote['author'] }}</p>
        </div>

    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const isDark = document.documentElement.classList.contains('dark');
        const gridColor = isDark ? 'rgba(241,245,249,0.08)' : 'rgba(15,23,42,0.06)';
        const textColor = isDark ? '#94a3b8' : '#475569';

        const ctx = document.getElementById('scoreChart').getContext('2d');

        // Gradient fill
        const gradient = ctx.createLinearGradient(0, 0, 0, 200);
        gradient.addColorStop(0, 'rgba(99,102,241,0.3)');
        gradient.addColorStop(1, 'rgba(99,102,241,0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Rata-rata Skor',
                    data: @json($chartScores),
                    borderColor: '#6366f1',
                    backgroundColor: gradient,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#4f46e5',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4,
                    spanGaps: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: isDark ? '#1e293b' : '#fff',
                        titleColor: textColor,
                        bodyColor: '#6366f1',
                        borderColor: isDark ? 'rgba(241,245,249,0.1)' : 'rgba(15,23,42,0.1)',
                        borderWidth: 1,
                        padding: 10,
                        callbacks: {
                            label: ctx => `Skor: ${ctx.raw ?? '—'}%`
                        }
                    }
                },
                scales: {
                    y: {
                        min: 0, max: 100,
                        grid: { color: gridColor },
                        ticks: { color: textColor, callback: v => v + '%' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: textColor }
                    }
                }
            }
        });
    });

    // Count-up animation
    function countUp(target) {
        return {
            displayed: 0,
            started: false,
            start() {
                if (this.started || target === 0) { this.displayed = target; return; }
                this.started = true;
                const duration = 1200;
                const steps = 40;
                const increment = target / steps;
                let current = 0;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        this.displayed = target;
                        clearInterval(timer);
                    } else {
                        this.displayed = Math.floor(current);
                    }
                }, duration / steps);
            }
        }
    }
    </script>

    <style>
    .stat-card { animation: fadeInUp 0.4s cubic-bezier(0.4,0,0.2,1) both; }
    </style>

</x-app-layout>
