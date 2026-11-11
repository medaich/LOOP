<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * List all published courses
     */
    public function index()
    {
        $courses = Course::where('is_published', true)
            ->withCount('quizzes')
            ->get();

        return response()->json($courses);
    }

    /**
     * Show a specific course with its quizzes
     */
    public function show(Course $course)
    {
        return response()->json($course->load([
            'quizzes' => function ($query) {
                $query->where('is_active', true);
            }
        ]));
    }

    /**
     * Enroll user in a course
     */
    public function enroll(Request $request, Course $course)
    {
        $user = $request->user() ?: \App\Models\User::first();

        $enrollment = CourseEnrollment::updateOrCreate(
            ['user_id' => $user->id, 'course_id' => $course->id],
            ['last_accessed_at' => now(), 'status' => 'active']
        );

        return response()->json([
            'success' => true,
            'message' => "Enrolled in {$course->title}",
            'enrollment' => $enrollment
        ]);
    }
}
