<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Services\EmailExerciseService;
use Illuminate\Http\Request;

class EmailExerciseController extends Controller
{
    public function __construct(
        private EmailExerciseService $emailService
    ) {
    }

    public function submit(Request $request, Quiz $exercise)
    {
        $validated = $request->validate([
            'scenario' => 'required|string',
            'subject_line' => 'required|string|max:255',
            'body' => 'required|string|min:50|max:2000'
        ]);

        try {
            $user = $request->user() ?: \App\Models\User::first();
            $result = $this->emailService->submitEmail(
                $user,
                $exercise,
                $validated['scenario'],
                $validated['subject_line'],
                $validated['body']
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
