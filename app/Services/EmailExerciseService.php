<?php

namespace App\Services;

use App\Models\User;
use App\Models\Quiz;
use App\Models\EmailExercise;
use Illuminate\Support\Facades\DB;

class EmailExerciseService
{
    public function __construct(
        private GamificationService $gamificationService
    ) {
    }

    /**
     * Submit email exercise with basic auto-scoring
     */
    public function submitEmail(
        User $user,
        Quiz $exercise,
        string $scenario,
        string $subjectLine,
        string $body
    ): array {
        return DB::transaction(function () use ($user, $exercise, $scenario, $subjectLine, $body) {
            // Basic auto-scoring (can be enhanced with NLP)
            $toneScore = $this->scoreTone($body);
            $structureScore = $this->scoreStructure($body);
            $grammarScore = $this->scoreGrammar($body);

            $totalScore = round(($toneScore + $structureScore + $grammarScore) / 3, 2);

            // Determine XP
            $xpEarned = 0;
            if ($totalScore >= 90) {
                $xpEarned = $exercise->xp_reward * 1.2;
            } elseif ($totalScore >= 70) {
                $xpEarned = $exercise->xp_reward;
            } elseif ($totalScore >= 50) {
                $xpEarned = $exercise->xp_reward * 0.5;
            }

            $emailExercise = EmailExercise::create([
                'user_id' => $user->id,
                'exercise_id' => $exercise->id,
                'scenario' => $scenario,
                'user_subject_line' => $subjectLine,
                'user_body' => $body,
                'tone_score' => $toneScore,
                'structure_score' => $structureScore,
                'grammar_score' => $grammarScore,
                'total_score' => $totalScore,
                'xp_earned' => $xpEarned,
                'feedback' => $this->generateFeedback(
                    $toneScore,
                    $structureScore,
                    $grammarScore
                ),
                'is_completed' => $totalScore >= 50
            ]);

            // Award XP
            $gamificationResult = null;
            if ($totalScore >= 50) {
                // Update global user progress for dashboard
                \App\Models\UserProgress::updateOrCreate(
                    ['user_id' => $user->id, 'quiz_id' => $exercise->id],
                    [
                        'score' => $totalScore,
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
                'score' => $totalScore,
                'breakdown' => [
                    'tone' => $toneScore,
                    'structure' => $structureScore,
                    'grammar' => $grammarScore
                ],
                'xp_earned' => $xpEarned,
                'feedback' => $emailExercise->feedback,
                'gamification' => $gamificationResult
            ];
        });
    }

    private function scoreTone(string $body): int
    {
        // Basic professional tone check
        $professionalWords = ['regards', 'sincerely', 'please', 'thank you', 'appreciate'];
        $unprofessionalWords = ['hey', 'sup', 'lol', 'gonna', 'wanna'];

        $body = strtolower($body);
        $score = 70; // Base score

        foreach ($professionalWords as $word) {
            if (str_contains($body, $word)) {
                $score += 6;
            }
        }

        foreach ($unprofessionalWords as $word) {
            if (str_contains($body, $word)) {
                $score -= 15;
            }
        }

        return min(100, max(0, $score));
    }

    private function scoreStructure(string $body): int
    {
        $score = 0;

        // Check for greeting
        if (preg_match('/^(dear|hello|hi|greetings)/i', trim($body))) {
            $score += 33;
        }

        // Check for body content (reasonable length)
        if (str_word_count($body) >= 20) {
            $score += 34;
        }

        // Check for closing
        if (preg_match('/(regards|sincerely|best|thank you)/i', $body)) {
            $score += 33;
        }

        return $score;
    }

    private function scoreGrammar(string $body): int
    {
        // Very basic grammar check
        $score = 100;

        // Check for capitalization at start
        if (!preg_match('/^[A-Z]/', trim($body))) {
            $score -= 10;
        }

        // Check for punctuation at end
        if (!preg_match('/[.!?]$/', trim($body))) {
            $score -= 10;
        }

        return max(0, $score);
    }

    private function generateFeedback(int $tone, int $structure, int $grammar): array
    {
        $feedback = [];

        if ($tone < 70) {
            $feedback[] = "Consider using more professional language and tone.";
        }

        if ($structure < 70) {
            $feedback[] = "Include a proper greeting, body, and closing in your email.";
        }

        if ($grammar < 70) {
            $feedback[] = "Check capitalization and punctuation.";
        }

        if (empty($feedback)) {
            $feedback[] = "Excellent! Your email is professional and well-structured.";
        }

        return $feedback;
    }
}
