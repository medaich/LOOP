<?php

namespace App\Services;

use App\Models\User;
use App\Models\Exercise;
use App\Models\ExerciseProgress;
use Illuminate\Support\Facades\DB;

class ExerciseService
{
    public function __construct(
        protected GamificationService $gamificationService
    ) {
    }

    public function submitExercise(User $user, Exercise $exercise, array $data): array
    {
        $score = 0;
        $feedback = [];

        if ($exercise->type === 'cv') {
            $score = $this->calculateCvScore($data['order'] ?? [], $exercise->metadata['correct_order'] ?? []);
            if ($score === 100) {
                $feedback[] = "Perfect! Your CV structure is professional.";
            } else {
                $feedback[] = "Good effort! Try to align the sections for better flow.";
            }
        } elseif ($exercise->type === 'email') {
            $score = $this->calculateEmailScore($data['body'] ?? '');
            $feedback[] = "Great start on your professional email! We'll add AI correction soon.";
        }

        $passed = $score >= 60;
        $xpEarned = $passed ? $exercise->xp_reward : 0;

        // Bonus for perfect score
        if ($score === 100) {
            $xpEarned = (int) ($xpEarned * 1.5);
        }

        $progress = ExerciseProgress::updateOrCreate(
            ['user_id' => $user->id, 'exercise_id' => $exercise->id],
            [
                'score' => $score,
                'xp_earned' => $xpEarned,
                'status' => $passed ? 'completed' : 'in_progress',
                'user_data' => $data,
                'completed_at' => $passed ? now() : null,
            ]
        );

        $gamificationResult = null;
        if ($passed) {
            $gamificationResult = $this->gamificationService->awardXP($user, $xpEarned);
            $this->gamificationService->updateStreak($user);
        }

        return [
            'score' => $score,
            'passed' => $passed,
            'xp_earned' => $xpEarned,
            'feedback' => $feedback,
            'gamification' => $gamificationResult,
        ];
    }

    protected function calculateCvScore(array $userOrder, array $correctOrder): int
    {
        if (empty($correctOrder))
            return 0;

        $correctCount = 0;
        $totalCount = count($correctOrder);

        foreach ($correctOrder as $index => $section) {
            if (isset($userOrder[$index]) && $userOrder[$index] === $section) {
                $correctCount++;
            }
        }

        return (int) (($correctCount / $totalCount) * 100);
    }

    protected function calculateEmailScore(string $body): int
    {
        $length = strlen($body);
        if ($length < 50)
            return 30;
        if ($length < 100)
            return 60;

        // Basic keyword check for professional tone
        $keywords = ['regards', 'sincerely', 'thank', 'dear', 'appreciate'];
        $foundCount = 0;
        foreach ($keywords as $word) {
            if (stripos($body, $word) !== false) {
                $foundCount++;
            }
        }

        $score = 60 + ($foundCount * 8);
        return min(100, $score);
    }
}
