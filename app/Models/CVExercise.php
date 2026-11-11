<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CVExercise extends Model
{
    protected $table = 'cv_exercises';

    protected $fillable = [
        'user_id',
        'exercise_id',
        'cv_structure',
        'correct_structure',
        'score',
        'xp_earned',
        'attempts',
        'is_completed',
        'completed_at'
    ];

    protected $casts = [
        'cv_structure' => 'json',
        'correct_structure' => 'json',
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'exercise_id');
    }
}
