<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UserProgress;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Get user dashboard data
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            $user = User::first(); // Fallback for demo
        }

        if (!$user) {
            return response()->json(['error' => 'No user found'], 404);
        }

        $user->load(['badges', 'progress.quiz']);

        // Stats
        $stats = [
            'level' => $user->current_level,
            'xp' => $user->current_xp,
            'xp_to_next_level' => $user->current_level * 100,
            'streak' => $user->streak_days,
            'courses_enrolled' => $user->enrollments()->count(),
            'exercises_completed' => UserProgress::where('user_id', $user->id)->where('is_completed', true)->count(),
            'global_rank' => $this->getGlobalRank($user),
        ];

        // Recent Activity
        $recentActivity = UserProgress::where('user_id', $user->id)
            ->with('quiz')
            ->orderBy('completed_at', 'desc')
            ->limit(5)
            ->get();

        // Available Courses
        $courses = Course::where('is_published', true)
            ->withCount('quizzes')
            ->with([
                'quizzes' => function ($query) {
                    $query->select('id', 'course_id')->limit(1);
                }
            ])
            ->limit(3)
            ->get()
            ->map(function ($course) {
                $course->first_quiz_id = $course->quizzes->first()?->id;
                return $course;
            });

        return response()->json([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'progress_percentage' => $user->getProgressPercentage(),
            ],
            'stats' => $stats,
            'recent_badges' => $user->badges()->orderBy('pivot_awarded_at', 'desc')->limit(4)->get(),
            'recent_activity' => $recentActivity,
            'available_courses' => $courses,
        ]);
    }

    private function getGlobalRank($user)
    {
        return User::where('current_level', '>', $user->current_level)
            ->orWhere(function ($query) use ($user) {
                $query->where('current_level', $user->current_level)
                    ->where('current_xp', '>', $user->current_xp);
            })
            ->count() + 1;
    }
}
