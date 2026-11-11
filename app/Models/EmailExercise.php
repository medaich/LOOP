<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailExercise extends Model
{
    protected $fillable = [
        'user_id',
        'exercise_id',
        'scenario',
        'user_subject_line',
        'user_body',
        'tone_score',
        'structure_score',
        'grammar_score',
        'total_score',
        'xp_earned',
        'feedback',
        'is_completed'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'feedback' => 'json',
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
