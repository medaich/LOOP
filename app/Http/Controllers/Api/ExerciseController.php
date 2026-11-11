<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Services\ExerciseService;

class ExerciseController extends Controller
{
    public function __construct(
        protected ExerciseService $exerciseService
    ) {
    }

    public function index()
    {
        return response()->json(Exercise::where('is_active', true)->get());
    }

    public function show(Exercise $exercise)
    {
        return response()->json($exercise);
    }

    public function submit(Request $request, Exercise $exercise)
    {
        $user = $request->user() ?? \App\Models\User::first();

        $validated = $request->validate([
            'order' => 'nullable|array',
            'body' => 'nullable|string',
        ]);

        $result = $this->exerciseService->submitExercise($user, $exercise, $validated);

        return response()->json($result);
    }
}
