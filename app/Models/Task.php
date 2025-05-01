<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subject_id', 'name', 'description', 'points',
    ];

    // Parent subject:
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    // Submitted solutions:
    public function solutions(): HasMany
    {
        return $this->hasMany(Solution::class);
    }
}
