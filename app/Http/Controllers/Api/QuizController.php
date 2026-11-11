<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct(
        private QuizService $quizService
    ) {
    }

    /**
     * Get quiz details
     */
    public function show(Quiz $quiz)
    {
        $quiz->load('course', 'questions');

        return response()->json([
            'id' => $quiz->id,
            'title' => $quiz->title,
            'description' => $quiz->description,
            'course' => [
                'id' => $quiz->course->id,
                'title' => $quiz->course->title,
            ],
            'xp_reward' => $quiz->xp_reward,
            'passing_score' => $quiz->passing_score,
            'time_limit_minutes' => $quiz->time_limit_minutes,
            'question_count' => $quiz->questions->count(),
            'max_attempts' => $quiz->max_attempts,
            'type' => $quiz->type,
            'metadata' => $quiz->metadata,
            'questions' => $quiz->questions,
        ]);
    }

    /**
     * Start quiz attempt
     */
    public function start(Request $request, Quiz $quiz)
    {
        try {
            $user = $request->user() ?: \App\Models\User::first();
            $result = $this->quizService->startQuiz($user, $quiz);

            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Submit quiz answers
     */
    public function submit(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'answers' => 'required|array',
        ]);

        try {
            $user = $request->user() ?: \App\Models\User::first();
            $result = $this->quizService->submitQuiz(
                $user,
                $quiz,
                $validated['answers']
            );

            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
