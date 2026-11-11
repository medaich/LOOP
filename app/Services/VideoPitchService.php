<?php

namespace App\Services;

use App\Models\User;
use App\Models\Quiz;
use App\Models\VideoPitch;
use App\Models\PeerReview;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoPitchService
{
    public function __construct(
        private GamificationService $gamificationService
    ) {
    }

    /**
     * Submit a video pitch
     */
    public function submitPitch(
        User $user,
        Quiz $exercise,
        $videoFile,
        string $title,
        ?string $description = null
    ): VideoPitch {
        return DB::transaction(function () use ($user, $exercise, $videoFile, $title, $description) {
            // Store video file
            $videoPath = $videoFile->store('pitches', 'public');

            $pitch = VideoPitch::create([
                'user_id' => $user->id,
                'exercise_id' => $exercise->id,
                'title' => $title,
                'description' => $description,
                'video_url' => Storage::url($videoPath),
                'status' => 'submitted',
                'submitted_at' => now()
            ]);

            // Award XP for submission
            $xpEarned = $exercise->xp_reward;
            $pitch->update(['xp_earned' => $xpEarned]);

            $this->gamificationService->awardXP($user, $xpEarned);
            $this->gamificationService->updateStreak($user);

            return $pitch;
        });
    }

    /**
     * Submit peer review
     */
    public function submitPeerReview(
        User $reviewer,
        VideoPitch $pitch,
        array $scores,
        string $feedback
    ): array {
        return DB::transaction(function () use ($reviewer, $pitch, $scores, $feedback) {
            // Prevent self-review
            if ($reviewer->id === $pitch->user_id) {
                throw new \Exception('Cannot review your own pitch');
            }

            // Check if already reviewed
            if (
                PeerReview::where('reviewer_id', $reviewer->id)
                    ->where('video_pitch_id', $pitch->id)
                    ->exists()
            ) {
                throw new \Exception('You have already reviewed this pitch');
            }

            $review = PeerReview::create([
                'reviewer_id' => $reviewer->id,
                'video_pitch_id' => $pitch->id,
                'clarity_score' => $scores['clarity'] ?? null,
                'confidence_score' => $scores['confidence'] ?? null,
                'structure_score' => $scores['structure'] ?? null,
                'persuasiveness_score' => $scores['persuasiveness'] ?? null,
                'written_feedback' => $feedback,
                'xp_earned' => 25
            ]);

            // Update pitch average rating
            $this->updatePitchRating($pitch);

            // Award XP to reviewer
            $gamificationResult = $this->gamificationService->awardXP($reviewer, 25);

            return [
                'review' => $review,
                'gamification' => $gamificationResult
            ];
        });
    }

    /**
     * Get pitches available for peer review
     */
    public function getPitchesForReview(?User $user, int $limit = 10): array
    {
        $query = VideoPitch::where('status', 'submitted');

        if ($user) {
            $query->where('user_id', '!=', $user->id) // Not own pitches
                ->whereDoesntHave('peerReviews', function ($query) use ($user) {
                    $query->where('reviewer_id', $user->id);
                });
        }

        return $query->with('user:id,name')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    private function updatePitchRating(VideoPitch $pitch): void
    {
        $reviews = $pitch->peerReviews;

        if ($reviews->isEmpty()) {
            return;
        }

        $totalScore = 0;
        $scoreCount = 0;

        foreach ($reviews as $review) {
            $avgReviewScore = collect([
                $review->clarity_score,
                $review->confidence_score,
                $review->structure_score,
                $review->persuasiveness_score
            ])->filter()->average();

            $totalScore += $avgReviewScore;
            $scoreCount++;
        }

        $pitch->update([
            'average_rating' => $scoreCount > 0 ? $totalScore / $scoreCount : null,
            'review_count' => $scoreCount,
            'status' => 'reviewed'
        ]);
    }
}
