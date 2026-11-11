<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Services\CVExerciseService;
use Illuminate\Http\Request;

class CVExerciseController extends Controller
{
    public function __construct(
        private CVExerciseService $cvService
    ) {
    }

    public function submit(Request $request, Quiz $exercise)
    {
        $validated = $request->validate([
            'structure' => 'required|array',
            'structure.*' => 'required|string'
        ]);

        try {
            $user = $request->user() ?: \App\Models\User::first();
            $result = $this->cvService->submitCVStructure(
                $user,
                $exercise,
                $validated['structure']
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
