<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\QuizSession;
use App\Models\ProgressStat;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $hour   = now()->setTimezone('Asia/Jakarta')->hour;

        // Greeting dinamis berdasarkan jam
        if ($hour >= 5 && $hour < 12) {
            $greeting  = 'Selamat pagi';
            $greetEmoji = '☀️';
        } elseif ($hour < 15) {
            $greeting  = 'Selamat siang';
            $greetEmoji = '🌤️';
        } elseif ($hour < 18) {
            $greeting  = 'Selamat sore';
            $greetEmoji = '🌅';
        } else {
            $greeting  = 'Selamat malam';
            $greetEmoji = '🌙';
        }

        // ── Stat Cards ────────────────────────────────────
        $totalMaterials = Material::where('user_id', $userId)->count();

        $totalQuestions = QuizSession::where('user_id', $userId)
            ->where('status', 'completed')
            ->sum('total_questions');

        $avgScore = QuizSession::where('user_id', $userId)
            ->where('status', 'completed')
            ->avg('score');
        $avgScore = $avgScore ? (int) round($avgScore) : 0;

        // Streak: hitung hari berturut-turut user aktif belajar
        $streak = $this->calculateStreak($userId);

        // ── Materi Terakhir ────────────────────────────────
        $recentMaterials = Material::where('user_id', $userId)
            ->latest()
            ->limit(3)
            ->get();

        // ── Quiz Terakhir ──────────────────────────────────
        $recentQuizzes = QuizSession::where('user_id', $userId)
            ->with('material')
            ->whereIn('status', ['active', 'completed'])
            ->latest()
            ->limit(3)
            ->get();

        // ── Chart Data: skor 7 hari terakhir ──────────────
        $chartData = QuizSession::where('user_id', $userId)
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(created_at) as date, ROUND(AVG(score)) as avg_score')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('avg_score', 'date')
            ->toArray();

        // Isi hari yang kosong dengan null
        $chartLabels = [];
        $chartScores = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = now()->subDays($i)->locale('id')->isoFormat('D MMM');
            $chartScores[] = $chartData[$day] ?? null;
        }

        // ── Quote Motivasi ─────────────────────────────────
        $quotes = [
            ['text' => 'Belajar bukan tentang seberapa cepat kamu hafal, tapi seberapa dalam kamu memahami.', 'author' => 'Einstein'],
            ['text' => 'Setiap soal yang kamu kerjakan adalah latihan untuk pikiran yang lebih tajam.', 'author' => 'EduMind'],
            ['text' => 'Konsistensi kecil setiap hari mengalahkan usaha besar yang hanya sekali.', 'author' => 'James Clear'],
            ['text' => 'Otak yang dilatih adalah senjata terkuat yang kamu miliki.', 'author' => 'EduMind'],
            ['text' => 'Bukan tentang nilai sempurna, tapi tentang kemajuan yang nyata.', 'author' => 'EduMind'],
        ];
        $quote = $quotes[array_rand($quotes)];

        return view('dashboard.index', compact(
            'totalMaterials', 'totalQuestions', 'avgScore', 'streak',
            'recentMaterials', 'recentQuizzes',
            'chartLabels', 'chartScores', 'quote',
            'greeting', 'greetEmoji'
        ));
    }

    /** Hitung streak: berapa hari berturut-turut user aktif */
    private function calculateStreak(int $userId): int
    {
        $dates = QuizSession::where('user_id', $userId)
            ->where('status', 'completed')
            ->selectRaw('DATE(created_at) as date')
            ->groupBy('date')
            ->orderByDesc('date')
            ->pluck('date')
            ->toArray();

        if (empty($dates)) return 0;

        $streak  = 0;
        $current = now()->toDateString();

        foreach ($dates as $date) {
            if ($date === $current || $date === now()->subDays($streak)->toDateString()) {
                $streak++;
                $current = now()->subDays($streak)->toDateString();
            } else {
                break;
            }
        }

        return $streak;
    }
}
