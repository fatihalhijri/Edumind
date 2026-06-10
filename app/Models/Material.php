<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description',
        'file_path', 'file_type', 'raw_text', 'quiz_count',
    ];

    protected $casts = [
        'quiz_count' => 'integer',
    ];

    // ── Relationships ─────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quizSessions(): HasMany
    {
        return $this->hasMany(QuizSession::class);
    }

    // ── Scopes ────────────────────────────────────────────
    public function scopeForUser($query)
    {
        return $query->where('user_id', auth()->id());
    }

    // ── Helpers ───────────────────────────────────────────
    public function getPreviewAttribute(): string
    {
        return str($this->raw_text ?? '')->limit(250);
    }

    public function getFileSizeAttribute(): string
    {
        if (!$this->file_path || !file_exists(storage_path('app/' . $this->file_path))) {
            return '—';
        }
        $bytes = filesize(storage_path('app/' . $this->file_path));
        return round($bytes / 1024, 1) . ' KB';
    }
}
