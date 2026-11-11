<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Get leaderboard data
     */
    public function index()
    {
        $users = User::orderBy('current_level', 'desc')
            ->orderBy('current_xp', 'desc')
            ->limit(50)
            ->get(['id', 'name', 'current_level', 'current_xp', 'streak_days'])
            ->map(function ($user, $index) {
                return [
                    'rank' => $index + 1,
                    'name' => $user->name,
                    'level' => $user->current_level,
                    'xp' => $user->current_xp,
                    'streak' => $user->streak_days,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }
}
