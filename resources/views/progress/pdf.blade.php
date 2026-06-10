<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progress Report — EduMind</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #0f172a; margin: 0; padding: 20px; }
        h1 { font-size: 20px; color: #4f46e5; margin-bottom: 4px; }
        .subtitle { color: #64748b; font-size: 11px; margin-bottom: 20px; }
        .stats { display: flex; gap: 20px; margin-bottom: 20px; }
        .stat-box { border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; flex: 1; }
        .stat-value { font-size: 24px; font-weight: bold; color: #4f46e5; }
        .stat-label { font-size: 10px; color: #64748b; margin-top: 2px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f1f5f9; text-align: left; padding: 8px 10px; font-size: 10px; text-transform: uppercase; color: #64748b; }
        td { padding: 8px 10px; border-bottom: 1px solid #f1f5f9; font-size: 11px; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 99px; font-size: 10px; font-weight: 600; }
        .badge-success { background: #f0fdf4; color: #15803d; }
        .badge-warning { background: #fefce8; color: #a16207; }
        .badge-danger  { background: #fef2f2; color: #dc2626; }
        .footer { margin-top: 30px; text-align: center; color: #94a3b8; font-size: 10px; }
    </style>
</head>
<body>
    <h1>EduMind — Laporan Progress Belajar</h1>
    <p class="subtitle">{{ $user->name }} · {{ now()->locale('id')->isoFormat('D MMMM Y') }}</p>

    <div class="stats">
        <div class="stat-box">
            <div class="stat-value">{{ $history->count() }}</div>
            <div class="stat-label">Total Quiz Selesai</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ round($avgScore ?? 0) }}%</div>
            <div class="stat-label">Rata-rata Skor</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ $history->sum('total_questions') }}</div>
            <div class="stat-label">Total Soal Dikerjakan</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Materi</th>
                <th>Sesi Quiz</th>
                <th>Soal</th>
                <th>Skor</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($history as $session)
            @php
                $score = $session->score ?? 0;
                $cls = $score >= 70 ? 'badge-success' : ($score >= 50 ? 'badge-warning' : 'badge-danger');
            @endphp
            <tr>
                <td>{{ $session->material->title ?? '—' }}</td>
                <td>{{ $session->title }}</td>
                <td>{{ $session->total_questions }}</td>
                <td><span class="badge {{ $cls }}">{{ $score }}%</span></td>
                <td>{{ $session->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Digenerate oleh EduMind · Powered by Google Gemini AI · edumind.id
    </div>
</body>
</html>
