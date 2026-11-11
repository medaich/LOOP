<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;
use Illuminate\Support\Facades\Log;

class GamificationService
{
    /**
     * Award XP to a user and handle level progression
     */
    public function awardXP(User $user, int $amount): array
    {
        $initialLevel = $user->current_level;
        $user->current_xp += $amount;

        $leveledUp = false;
        $newBadges = [];

        // Check for level up
        while ($user->current_xp >= $this->getXpForLevel($user->current_level)) {
            $user->current_xp -= $this->getXpForLevel($user->current_level);
            $user->current_level++;
            $leveledUp = true;

            // Award level badge
            $levelBadge = $this->checkAndAwardLevelBadge($user);
            if ($levelBadge) {
                $newBadges[] = $levelBadge;
            }
        }

        $user->save();

        // Check for other badge criteria
        $otherBadges = $this->checkAllBadgeCriteria($user);
        $newBadges = array_merge($newBadges, $otherBadges);

        return [
            'xp_awarded' => $amount,
            'current_xp' => $user->current_xp,
            'current_level' => $user->current_level,
            'leveled_up' => $leveledUp,
            'levels_gained' => $user->current_level - $initialLevel,
            'new_badges' => $newBadges,
            'xp_to_next_level' => $this->getXpForLevel($user->current_level),
            'progress_percentage' => $this->getProgressPercentage($user)
        ];
    }

    /**
     * Calculate XP needed for a specific level
     */
    private function getXpForLevel(int $level): int
    {
        // Progressive difficulty: level * 100
        return $level * 100;
    }

    /**
     * Get progress percentage to next level
     */
    private function getProgressPercentage(User $user): float
    {
        $xpForNext = $this->getXpForLevel($user->current_level);
        return round(($user->current_xp / $xpForNext) * 100, 2);
    }

    /**
     * Check and award level-based badge
     */
    private function checkAndAwardLevelBadge(User $user): ?Badge
    {
        $badge = Badge::where('criteria_type', 'level')
            ->where('criteria_value', $user->current_level)
            ->first();

        if ($badge && !$user->badges()->where('badge_id', $badge->id)->exists()) {
            return $this->awardBadge($user, $badge);
        }

        return null;
    }

    /**
     * Check all badge criteria for the user
     */
    private function checkAllBadgeCriteria(User $user): array
    {
        $newBadges = [];

        // XP threshold badges
        $totalXP = ($user->current_level - 1) * 100 + $user->current_xp;
        $xpBadges = Badge::where('criteria_type', 'xp_threshold')
            ->where('criteria_value', '<=', $totalXP)
            ->get();

        foreach ($xpBadges as $badge) {
            /** @var Badge $badge */
            if (!$user->badges()->where('badge_id', $badge->id)->exists()) {
                $awarded = $this->awardBadge($user, $badge);
                if ($awarded) {
                    $newBadges[] = $awarded;
                }
            }
        }

        // Streak badges
        $streakBadges = Badge::where('criteria_type', 'streak')
            ->where('criteria_value', '<=', $user->streak_days)
            ->get();

        foreach ($streakBadges as $badge) {
            /** @var Badge $badge */
            if (!$user->badges()->where('badge_id', $badge->id)->exists()) {
                $awarded = $this->awardBadge($user, $badge);
                if ($awarded) {
                    $newBadges[] = $awarded;
                }
            }
        }

        return $newBadges;
    }

    /**
     * Award a badge to a user
     */
    private function awardBadge(User $user, Badge $badge): ?Badge
    {
        try {
            $user->badges()->attach($badge->id, [
                'awarded_at' => now()
            ]);

            Log::info("Badge awarded", [
                'user_id' => $user->id,
                'badge_id' => $badge->id,
                'badge_name' => $badge->name
            ]);

            return $badge;
        } catch (\Exception $e) {
            Log::error("Failed to award badge", [
                'user_id' => $user->id,
                'badge_id' => $badge->id,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Update user's activity streak
     */
    public function updateStreak(User $user): void
    {
        $today = now()->startOfDay();
        $lastActivity = $user->last_activity_date;

        if ($lastActivity) {
            $lastActivityDate = \Illuminate\Support\Carbon::parse($lastActivity);
            $daysSinceLastActivity = $today->diffInDays($lastActivityDate);

            if ($daysSinceLastActivity === 1) {
                // Consecutive day - increment streak
                $user->streak_days++;
            } elseif ($daysSinceLastActivity > 1) {
                // Streak broken - reset
                $user->streak_days = 1;
            }
            // Same day - no change
        } else {
            // First activity
            $user->streak_days = 1;
        }

        $user->last_activity_date = $today->toDateString();
        $user->save();

        // Check for streak badges
        $this->checkAllBadgeCriteria($user);
    }
}
