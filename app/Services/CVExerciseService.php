<?php

namespace App\Services;

use App\Models\User;
use App\Models\Quiz;
use App\Models\CVExercise;
use Illuminate\Support\Facades\DB;

class CVExerciseService
{
    public function __construct(
        private GamificationService $gamificationService
    ) {
    }

    /**
     * Submit CV structure and calculate score
     */
    public function submitCVStructure(
        User $user,
        Quiz $exercise,
        array $userStructure
    ): array {
        return DB::transaction(function () use ($user, $exercise, $userStructure) {
            // Get the correct structure from exercise metadata
            $metadata = $exercise->metadata ?: [];
            $correctStructure = $metadata['correct_order']
                ?? ['contact', 'profile', 'xp', 'edu', 'skills'];

            // Calculate score (percentage match in correct positions)
            $score = $this->calculateStructureScore(
                $userStructure,
                $correctStructure
            );

            // Determine XP based on score
            $xpEarned = 0;
            if ((int) $score === 100) {
                $xpEarned = (int) ($exercise->xp_reward * 1.5); // Bonus for perfect
            } elseif ($score >= 80) {
                $xpEarned = (int) $exercise->xp_reward;
            } elseif ($score >= 60) {
                $xpEarned = (int) ($exercise->xp_reward * 0.5);
            }

            // Save exercise attempt
            $cvExercise = CVExercise::create([
                'user_id' => $user->id,
                'exercise_id' => $exercise->id,
                'cv_structure' => $userStructure,
                'correct_structure' => $correctStructure,
                'score' => $score,
                'xp_earned' => $xpEarned,
                'is_completed' => $score >= 60,
                'completed_at' => $score >= 60 ? now() : null
            ]);

            // Award XP if passed
            $gamificationResult = null;
            if ($score >= 60) {
                // Update global user progress for dashboard
                \App\Models\UserProgress::updateOrCreate(
                    ['user_id' => $user->id, 'quiz_id' => $exercise->id],
                    [
                        'score' => $score,
                        'xp_earned' => $xpEarned,
                        'is_completed' => true,
                        'completed_at' => now(),
                        'started_at' => now()
                    ]
                );

                $gamificationResult = $this->gamificationService->awardXP(
                    $user,
                    (int) $xpEarned
                );

                $this->gamificationService->updateStreak($user);
            }

            return [
                'score' => $score,
                'passed' => $score >= 60,
                'xp_earned' => $xpEarned,
                'feedback' => $this->generateFeedback($userStructure, $correctStructure),
                'gamification' => $gamificationResult
            ];
        });
    }

    private function calculateStructureScore(array $user, array $correct): float
    {
        $correctPositions = 0;
        $totalPositions = count($correct);

        foreach ($correct as $index => $section) {
            if (isset($user[$index]) && $user[$index] === $section) {
                $correctPositions++;
            }
        }

        return $totalPositions > 0 ? round(($correctPositions / $totalPositions) * 100, 2) : 0;
    }

    private function generateFeedback(array $user, array $correct): array
    {
        $feedback = [];

        foreach ($correct as $index => $section) {
            if (!isset($user[$index]) || $user[$index] !== $section) {
                $feedback[] = "Section '$section' should be at position " . ($index + 1);
            }
        }

        if (empty($feedback)) {
            $feedback[] = "Perfect! Your CV structure is excellent.";
        }

        return $feedback;
    }
}
