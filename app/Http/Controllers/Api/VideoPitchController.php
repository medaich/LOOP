<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\VideoPitch;
use App\Services\VideoPitchService;
use Illuminate\Http\Request;

class VideoPitchController extends Controller
{
    public function __construct(
        private VideoPitchService $pitchService
    ) {
    }

    /**
     * Submit a video pitch
     */
    public function submit(Request $request, Quiz $exercise)
    {
        $validated = $request->validate([
            'video' => 'required|file|mimes:mp4,mov,avi|max:51200', // 50MB max
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000'
        ]);

        try {
            $user = $request->user() ?: \App\Models\User::first();
            $pitch = $this->pitchService->submitPitch(
                $user,
                $exercise,
                $request->file('video'),
                $validated['title'],
                $validated['description'] ?? null
            );

            return response()->json([
                'success' => true,
                'data' => $pitch
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get pitches for peer review
     */
    public function forReview(Request $request)
    {
        $user = $request->user() ?: \App\Models\User::first();
        $pitches = $this->pitchService->getPitchesForReview(
            $user,
            $request->input('limit', 10)
        );

        return response()->json([
            'success' => true,
            'data' => $pitches
        ]);
    }

    /**
     * Submit peer review
     */
    public function submitReview(Request $request, VideoPitch $pitch)
    {
        $validated = $request->validate([
            'scores' => 'required|array',
            'scores.clarity' => 'required|integer|min:1|max:5',
            'scores.confidence' => 'required|integer|min:1|max:5',
            'scores.structure' => 'required|integer|min:1|max:5',
            'scores.persuasiveness' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string|min:20|max:1000'
        ]);

        try {
            $user = $request->user() ?: \App\Models\User::first();
            $result = $this->pitchService->submitPeerReview(
                $user,
                $pitch,
                $validated['scores'],
                $validated['feedback']
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

    /**
     * Get user's own pitches
     */
    public function myPitches(Request $request)
    {
        $user = $request->user() ?: \App\Models\User::first();
        $pitches = VideoPitch::where('user_id', $user->id)
            ->with('peerReviews.reviewer:id,name')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $pitches
        ]);
    }
}
