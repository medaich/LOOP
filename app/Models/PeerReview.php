<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeerReview extends Model
{
    protected $fillable = [
        'reviewer_id',
        'video_pitch_id',
        'clarity_score',
        'confidence_score',
        'structure_score',
        'persuasiveness_score',
        'written_feedback',
        'xp_earned',
        'is_helpful'
    ];

    protected $casts = [
        'is_helpful' => 'boolean',
    ];

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function videoPitch()
    {
        return $this->belongsTo(VideoPitch::class);
    }
}
