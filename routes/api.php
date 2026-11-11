<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\LeaderboardController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\CVExerciseController;
use App\Http\Controllers\Api\VideoPitchController;
use App\Http\Controllers\Api\EmailExerciseController;
use App\Http\Controllers\Api\CourseController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/leaderboard', [LeaderboardController::class, 'index']);

    // Course Routes
    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('/{course}', [CourseController::class, 'show']);
        Route::post('/{course}/enroll', [CourseController::class, 'enroll']);
    });

    // Quiz Routes
    Route::prefix('quizzes')->group(function () {
        Route::get('/{quiz}', [QuizController::class, 'show']);
        Route::post('/{quiz}/start', [QuizController::class, 'start']);
        Route::post('/{quiz}/submit', [QuizController::class, 'submit']);
    });

    // CV Exercise
    Route::post('/exercises/{exercise}/cv/submit', [CVExerciseController::class, 'submit']);

    // Video Pitch
    Route::prefix('pitches')->group(function () {
        Route::get('/for-review', [VideoPitchController::class, 'forReview']);
        Route::get('/my-pitches', [VideoPitchController::class, 'myPitches']);
        Route::post('/{exercise}/submit', [VideoPitchController::class, 'submit']);
        Route::post('/{pitch}/review', [VideoPitchController::class, 'submitReview']);
    });

    // Email Exercise
    Route::post('/exercises/{exercise}/email/submit', [EmailExerciseController::class, 'submit']);

    // Legacy/Old Exercise routes check
    Route::get('/exercises', [ExerciseController::class, 'index']);
    Route::get('/exercises/{exercise}', [ExerciseController::class, 'show']);
    Route::post('/exercises/{exercise}/submit', [ExerciseController::class, 'submit']);
});
