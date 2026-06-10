<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizSession extends Model
{
    protected $fillable = [
        'user_id', 'material_id', 'title',
        'total_questions', 'question_type', 'status', 'score', 'time_spent',
    ];

    protected $casts = [
        'total_questions' => 'integer',
        'score'           => 'integer',
        'time_spent'      => 'integer',
    ];

    // ── Relationships ─────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class);
    }

    // ── Helpers ───────────────────────────────────────────
    public function getScoreBadgeAttribute(): array
    {
        $s = $this->score ?? 0;
        if ($s >= 90) return ['label' => 'Luar Biasa! 🏆', 'class' => 'badge-success'];
        if ($s >= 70) return ['label' => 'Bagus! ⭐',       'class' => 'badge-info'];
        if ($s >= 50) return ['label' => 'Terus Berkembang 📈', 'class' => 'badge-warning'];
        return            ['label' => 'Jangan Menyerah 💪', 'class' => 'badge-danger'];
    }
}
