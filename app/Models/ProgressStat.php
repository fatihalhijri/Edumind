<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressStat extends Model
{
    protected $fillable = [
        'user_id', 'date',
        'total_questions_answered', 'correct_answers',
        'materials_studied', 'streak_days',
    ];

    protected $casts = [
        'date'                     => 'date',
        'total_questions_answered' => 'integer',
        'correct_answers'          => 'integer',
        'materials_studied'        => 'integer',
        'streak_days'              => 'integer',
    ];

    // ── Relationships ─────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ── Helpers ───────────────────────────────────────────
    public function getAccuracyAttribute(): int
    {
        if ($this->total_questions_answered === 0) return 0;
        return (int) round(($this->correct_answers / $this->total_questions_answered) * 100);
    }
}
