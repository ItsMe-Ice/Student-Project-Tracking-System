<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'project_id',
        'progress_report_id',
        'user_id',
        'content',
        'comment_type',
        'parent_id',
    ];

    protected $casts = [
        'comment_type' => 'string',
    ];

    /**
     * Get the project that owns the comment.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the progress report that owns the comment.
     */
    public function progressReport(): BelongsTo
    {
        return $this->belongsTo(ProgressReport::class);
    }

    /**
     * Get the user that created the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent comment (for nested comments).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Get the child comments (replies).
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Get the comment type options.
     */
    public static function getCommentTypeOptions(): array
    {
        return [
            'general' => 'General',
            'feedback' => 'Feedback',
            'question' => 'Question',
            'answer' => 'Answer',
        ];
    }
}
