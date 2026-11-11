<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'type',
        'metadata',
        'xp_reward',
        'passing_score',
        'time_limit_minutes',
        'max_attempts',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'metadata' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function getAttemptsLeft(User $user): int
    {
        $attempts = $this->userProgress()
            ->where('user_id', $user->id)
            ->count();

        return max(0, $this->max_attempts - $attempts);
    }
}
