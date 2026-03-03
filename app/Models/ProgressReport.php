<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressReport extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'title',
        'content',
        'progress_percentage',
        'status',
        'report_date',
    ];

    protected $casts = [
        'report_date' => 'date',
        'progress_percentage' => 'integer',
        'status' => 'string',
    ];

    /**
     * Get the project that owns the progress report.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user that created the progress report.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the progress report.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the progress status options.
     */
    public static function getStatusOptions(): array
    {
        return [
            'pending_review' => 'Pending Review',
            'approved' => 'Approved',
            'needs_revision' => 'Needs Revision',
        ];
    }
}
