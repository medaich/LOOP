<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'thumbnail_url',
        'content_url',
        'estimated_hours',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function getTotalXpReward(): int
    {
        return $this->quizzes()->sum('xp_reward');
    }
}
