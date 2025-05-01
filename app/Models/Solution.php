<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solution extends Model
{
    protected $fillable = [
        'task_id', 'user_id', 'content', 'evaluated_at', 'points_earned',
    ];

    // Which task this solves:
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    // Student author:
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
