<?php

namespace App\Services;

use App\Models\User;
use App\Models\Quiz;
use App\Models\UserProgress;
use Illuminate\Support\Facades\DB;

class QuizService
{
    public function __construct(
        private GamificationService $gamificationService
    ) {
    }

    /**
     * Start a quiz attempt
     */
    public function startQuiz(User $user, Quiz $quiz): array
    {
        // Check if user has attempts left
        if ($quiz->getAttemptsLeft($user) <= 0) {
            throw new \Exception('No attempts remaining for this quiz');
        }

        // Check if already started
        $existingAttempt = UserProgress::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->where('is_completed', false)
            ->first();

        if ($existingAttempt) {
            return [
                'attempt_id' => $existingAttempt->id,
                'questions' => $quiz->questions()->get()->map(function ($q) {
                    return [
                        'id' => $q->id,
                        'question_text' => $q->question_text,
                        'options' => $q->options,
                        'points' => $q->points
                    ];
                }),
                'started_at' => $existingAttempt->started_at,
                'time_limit' => $quiz->time_limit_minutes
            ];
        }

        // Create new attempt
        $attempt = UserProgress::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'started_at' => now(),
            'attempt_number' => $this->getAttemptNumber($user, $quiz)
        ]);

        return [
            'attempt_id' => $attempt->id,
            'questions' => $quiz->questions()->get()->map(function ($q) {
                return [
                    'id' => $q->id,
                    'question_text' => $q->question_text,
                    'options' => $q->options,
                    'points' => $q->points
                ];
            }),
            'started_at' => $attempt->started_at,
            'time_limit' => $quiz->time_limit_minutes
        ];
    }

    /**
     * Submit quiz answers
     */
    public function submitQuiz(User $user, Quiz $quiz, array $answers): array
    {
        return DB::transaction(function () use ($user, $quiz, $answers) {
            $attempt = UserProgress::where('user_id', $user->id)
                ->where('quiz_id', $quiz->id)
                ->where('is_completed', false)
                ->latest()
                ->first();

            if (!$attempt) {
                // Auto-start for MVP simplicity
                $attempt = UserProgress::create([
                    'user_id' => $user->id,
                    'quiz_id' => $quiz->id,
                    'started_at' => now(),
                    'attempt_number' => $this->getAttemptNumber($user, $quiz)
                ]);
            }

            // Calculate score
            $questions = $quiz->questions;
            $totalPoints = $questions->sum('points');
            $earnedPoints = 0;

            foreach ($questions as $question) {
                $userAnswer = $answers[$question->id] ?? null;
                if ($userAnswer === $question->correct_answer) {
                    $earnedPoints += $question->points;
                }
            }

            $scorePercentage = ($totalPoints > 0) ? ($earnedPoints / $totalPoints) * 100 : 0;
            $passed = $scorePercentage >= $quiz->passing_score;

            // Update attempt
            $attempt->update([
                'answers' => $answers,
                'score' => round($scorePercentage, 2),
                'is_completed' => true,
                'completed_at' => now()
            ]);

            // Award XP if passed
            $gamificationResult = null;
            if ($passed) {
                $xpToAward = $quiz->xp_reward;

                // Bonus XP for perfect score
                if ($scorePercentage === 100) {
                    $xpToAward = (int) ($xpToAward * 1.5);
                }

                $attempt->update(['xp_earned' => $xpToAward]);

                // Award XP and check badges
                $gamificationResult = $this->gamificationService->awardXP(
                    $user,
                    $xpToAward
                );

                // Update streak
                $this->gamificationService->updateStreak($user);
            }

            return [
                'score' => $scorePercentage,
                'passed' => $passed,
                'earned_points' => $earnedPoints,
                'total_points' => $totalPoints,
                'xp_earned' => $passed ? $attempt->xp_earned : 0,
                'gamification' => $gamificationResult,
                'attempts_remaining' => $quiz->getAttemptsLeft($user)
            ];
        });
    }

    /**
     * Get attempt number for user
     */
    private function getAttemptNumber(User $user, Quiz $quiz): int
    {
        return UserProgress::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->count() + 1;
    }
}
