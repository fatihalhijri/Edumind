<?php

namespace App\Http\Controllers;

use App\Models\QuizSession;
use App\Models\ProgressStat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // ── Chart skor 30 hari ────────────────────────────
        $chartData = QuizSession::where('user_id', $userId)
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->selectRaw('DATE(created_at) as date, ROUND(AVG(score)) as avg_score, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('avg_score', 'date')
            ->toArray();

        // Build 30-day labels & data
        $chartLabels = [];
        $chartScores = [];
        $calendarData = [];
        for ($i = 29; $i >= 0; $i--) {
            $day   = now()->subDays($i)->format('Y-m-d');
            $score = $chartData[$day] ?? null;
            $chartLabels[] = now()->subDays($i)->format('d/m');
            $chartScores[] = $score;
            $calendarData[$day] = $score !== null ? 1 : 0;
        }

        // ── Streak Calendar (30 hari, hitung aktivitas) ───
        $activityCounts = QuizSession::where('user_id', $userId)
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(29))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as cnt')
            ->groupBy('date')
            ->pluck('cnt', 'date')
            ->toArray();

        $calendar = [];
        for ($i = 29; $i >= 0; $i--) {
            $day = now()->subDays($i)->format('Y-m-d');
            $calendar[] = [
                'date'  => $day,
                'label' => now()->subDays($i)->format('d M'),
                'count' => $activityCounts[$day] ?? 0,
            ];
        }

        // ── Riwayat semua quiz ─────────────────────────────
        $history = QuizSession::where('user_id', $userId)
            ->with('material')
            ->where('status', 'completed')
            ->latest()
            ->paginate(10);

        // ── Total stats ────────────────────────────────────
        $totalCompleted  = QuizSession::where('user_id', $userId)->where('status', 'completed')->count();
        $avgScore        = QuizSession::where('user_id', $userId)->where('status', 'completed')->avg('score');
        $avgScore        = $avgScore ? (int) round($avgScore) : 0;

        return view('progress.index', compact(
            'chartLabels', 'chartScores', 'calendar',
            'history', 'totalCompleted', 'avgScore'
        ));
    }

    /** Export progress ke PDF */
    public function exportPdf()
    {
        $userId  = auth()->id();
        $history = QuizSession::where('user_id', $userId)
            ->with('material')
            ->where('status', 'completed')
            ->latest()
            ->get();

        $avgScore = $history->avg('score');
        $user     = auth()->user();

        $pdf = Pdf::loadView('progress.pdf', compact('history', 'avgScore', 'user'));
        return $pdf->download('progress-edumind-' . now()->format('Ymd') . '.pdf');
    }
}
