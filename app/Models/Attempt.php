<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attempt extends Model
{
    protected $fillable = [
        'user_id', 'quiz_session_id', 'question_id',
        'user_answer', 'is_correct', 'time_spent_seconds',
    ];

    protected $casts = [
        'is_correct'         => 'boolean',
        'time_spent_seconds' => 'integer',
    ];

    // ── Relationships ─────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quizSession(): BelongsTo
    {
        return $this->belongsTo(QuizSession::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
