<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoPitch extends Model
{
    protected $fillable = [
        'user_id',
        'exercise_id',
        'title',
        'description',
        'video_url',
        'duration_seconds',
        'xp_earned',
        'average_rating',
        'review_count',
        'status',
        'submitted_at'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'average_rating' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'exercise_id');
    }

    public function peerReviews()
    {
        return $this->hasMany(PeerReview::class);
    }
}
