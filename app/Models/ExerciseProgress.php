<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseProgress extends Model
{
    protected $table = 'exercise_progress';

    protected $fillable = [
        'user_id',
        'exercise_id',
        'score',
        'xp_earned',
        'status',
        'user_data',
        'completed_at',
    ];

    protected $casts = [
        'user_data' => 'json',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
