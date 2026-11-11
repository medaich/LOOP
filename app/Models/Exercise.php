<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'title',
        'type',
        'xp_reward',
        'description',
        'metadata',
        'is_active',
    ];

    protected $casts = [
        'metadata' => 'json',
        'is_active' => 'boolean',
    ];

    public function progress()
    {
        return $this->hasMany(ExerciseProgress::class);
    }
}
