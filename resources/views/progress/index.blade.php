<x-app-layout>
    <x-slot name="title">Progress Saya</x-slot>
    <x-slot name="breadcrumb">Progress Saya</x-slot>

    <div class="space-y-6 pb-20 md:pb-0">

        {{-- ── HEADER ──────────────────────────────────── --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="font-serif text-2xl font-bold" style="color: var(--text-primary);">Progress & Analitik</h1>
                <p class="text-sm mt-0.5" style="color: var(--text-muted);">
                    {{ $totalCompleted }} quiz selesai · Rata-rata {{ $avgScore }}%
                </p>
            </div>
            <a href="{{ route('progress.export') }}" class="btn-ghost self-start text-sm">
                📥 Export PDF
            </a>
        </div>

        {{-- ── CHART SKOR 30 HARI ───────────────────────── --}}
        <div class="card-static rounded-2xl p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold" style="color: var(--text-primary);">Tren Skor 30 Hari</h2>
            </div>
            <canvas id="progressChart" height="80"></canvas>
        </div>

        {{-- ── STREAK CALENDAR ─────────────────────────── --}}
        <div class="card-static rounded-2xl p-5">
            <h2 class="font-semibold mb-4" style="color: var(--text-primary);">Kalender Aktivitas</h2>
            <div class="grid gap-1.5" style="grid-template-columns: repeat(15, 1fr);">
                @foreach($calendar as $day)
                @php
                    $intensity = $day['count'] === 0 ? 0 :
                                 ($day['count'] <= 2 ? 1 : ($day['count'] <= 5 ? 2 : 3));
                    $colors = [
                        0 => 'var(--surface-3)',
                        1 => '#c7d2fe',
                        2 => '#818cf8',
                        3 => '#4f46e5',
                    ];
                @endphp
                <div class="aspect-square rounded-sm cursor-default relative group"
                     style="background: {{ $colors[$intensity] }};"
                     title="{{ $day['label'] }}: {{ $day['count'] }} quiz">
                    {{-- Tooltip --}}
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1 hidden group-hover:block
                                whitespace-nowrap text-xs px-2 py-1 rounded-md z-10"
                         style="background: var(--surface-0); color: var(--text-primary); border: 1px solid var(--border); box-shadow: var(--shadow-sm);">
                        {{ $day['label'] }}: {{ $day['count'] }} quiz
                    </div>
                </div>
                @endforeach
            </div>
            <div class="flex items-center gap-2 mt-3 text-xs" style="color: var(--text-muted);">
                <span>Kurang</span>
                @foreach(['var(--surface-3)', '#c7d2fe', '#818cf8', '#4f46e5'] as $c)
                <div class="w-3 h-3 rounded-sm" style="background: {{ $c }};"></div>
                @endforeach
                <span>Banyak</span>
            </div>
        </div>

        {{-- ── RIWAYAT QUIZ ─────────────────────────────── --}}
        <div class="card-static rounded-2xl p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold" style="color: var(--text-primary);">Riwayat Quiz</h2>
                <span class="text-xs" style="color: var(--text-muted);">{{ $history->total() }} total</span>
            </div>

            @if($history->isEmpty())
            <div class="text-center py-10">
                <p class="text-3xl mb-2">📊</p>
                <p class="text-sm" style="color: var(--text-muted);">Belum ada riwayat quiz</p>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border);">
                            <th class="text-left py-2 px-3 text-xs font-semibold uppercase tracking-wider" style="color: var(--text-muted);">Materi</th>
                            <th class="text-left py-2 px-3 text-xs font-semibold uppercase tracking-wider" style="color: var(--text-muted);">Sesi</th>
                            <th class="text-center py-2 px-3 text-xs font-semibold uppercase tracking-wider" style="color: var(--text-muted);">Soal</th>
                            <th class="text-center py-2 px-3 text-xs font-semibold uppercase tracking-wider" style="color: var(--text-muted);">Skor</th>
                            <th class="text-left py-2 px-3 text-xs font-semibold uppercase tracking-wider" style="color: var(--text-muted);">Tanggal</th>
                            <th class="py-2 px-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y" style="divide-color: var(--border);">
                        @foreach($history as $session)
                        @php
                            $score = $session->score ?? 0;
                            $badgeClass = $score >= 70 ? 'badge-success' : ($score >= 50 ? 'badge-warning' : 'badge-danger');
                        @endphp
                        <tr class="transition-colors" style=""
                            onmouseover="this.style.background='var(--surface-1)'"
                            onmouseout="this.style.background='transparent'">
                            <td class="py-3 px-3">
                                <p class="font-medium truncate max-w-[140px]" style="color: var(--text-primary);">{{ $session->material->title ?? '—' }}</p>
                            </td>
                            <td class="py-3 px-3">
                                <p class="truncate max-w-[120px]" style="color: var(--text-secondary);">{{ $session->title }}</p>
                            </td>
                            <td class="py-3 px-3 text-center font-mono" style="color: var(--text-muted);">
                                {{ $session->total_questions }}
                            </td>
                            <td class="py-3 px-3 text-center">
                                <span class="badge {{ $badgeClass }} font-mono">{{ $score }}%</span>
                            </td>
                            <td class="py-3 px-3 text-xs" style="color: var(--text-muted);">
                                {{ $session->created_at->locale('id')->isoFormat('D MMM Y') }}
                            </td>
                            <td class="py-3 px-3 text-right">
                                <a href="{{ route('quiz.result', $session) }}" class="text-xs hover:underline" style="color: var(--primary-600);">Review</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($history->hasPages())
            <div class="mt-4">{{ $history->links() }}</div>
            @endif
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#94a3b8' : '#475569';
        const gridColor = isDark ? 'rgba(241,245,249,0.08)' : 'rgba(15,23,42,0.06)';
        const ctx = document.getElementById('progressChart').getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, 200);
        gradient.addColorStop(0, 'rgba(99,102,241,0.3)');
        gradient.addColorStop(1, 'rgba(99,102,241,0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Skor Rata-rata',
                    data: @json($chartScores),
                    borderColor: '#6366f1',
                    backgroundColor: gradient,
                    borderWidth: 2,
                    pointBackgroundColor: '#4f46e5',
                    pointRadius: 3,
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
                        callbacks: { label: ctx => `Skor: ${ctx.raw ?? '—'}%` }
                    }
                },
                scales: {
                    y: { min: 0, max: 100, grid: { color: gridColor }, ticks: { color: textColor, callback: v => v + '%' } },
                    x: { grid: { display: false }, ticks: { color: textColor, maxTicksLimit: 10 } }
                }
            }
        });
    });
    </script>
</x-app-layout>
