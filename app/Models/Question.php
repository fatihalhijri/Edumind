<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'quiz_session_id', 'question_text', 'question_type',
        'options', 'correct_answer', 'explanation', 'order',
    ];

    protected $casts = [
        'options' => 'array',
        'order'   => 'integer',
    ];

    // ── Relationships ─────────────────────────────────────
    public function quizSession(): BelongsTo
    {
        return $this->belongsTo(QuizSession::class);
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class);
    }
}
