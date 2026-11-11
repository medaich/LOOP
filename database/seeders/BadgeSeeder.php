<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        $badges = [
            // Level-based badges
            [
                'name' => 'Communication Novice',
                'description' => 'Welcome to your communication skills journey!',
                'icon_url' => '/badges/novice.svg',
                'criteria_type' => 'level',
                'criteria_value' => 1,
                'rarity' => 1
            ],
            [
                'name' => 'Rising Communicator',
                'description' => 'Reached Level 5 - You\'re making great progress!',
                'icon_url' => '/badges/rising-star.svg',
                'criteria_type' => 'level',
                'criteria_value' => 5,
                'rarity' => 2
            ],
            [
                'name' => 'Communication Expert',
                'description' => 'Reached Level 10 - You\'re a skilled communicator!',
                'icon_url' => '/badges/expert.svg',
                'criteria_type' => 'level',
                'criteria_value' => 10,
                'rarity' => 3
            ],
            [
                'name' => 'Master Communicator',
                'description' => 'Reached Level 20 - Elite communication skills!',
                'icon_url' => '/badges/master.svg',
                'criteria_type' => 'level',
                'criteria_value' => 20,
                'rarity' => 4
            ],
            
            // Written Communication Badges - CV
            [
                'name' => 'CV Apprentice',
                'description' => 'Completed your first CV structuring exercise',
                'icon_url' => '/badges/cv-apprentice.svg',
                'criteria_type' => 'cv_count',
                'criteria_value' => 1,
                'rarity' => 1
            ],
            [
                'name' => 'CV Master',
                'description' => 'Achieved perfect score on CV structuring exercise',
                'icon_url' => '/badges/cv-master.svg',
                'criteria_type' => 'cv_perfect',
                'criteria_value' => 1,
                'rarity' => 3
            ],
            [
                'name' => 'Resume Virtuoso',
                'description' => 'Completed 5 CV exercises with high scores',
                'icon_url' => '/badges/resume-virtuoso.svg',
                'criteria_type' => 'cv_count',
                'criteria_value' => 5,
                'rarity' => 3
            ],
            
            // Written Communication Badges - Email
            [
                'name' => 'Email Beginner',
                'description' => 'Sent your first professional email',
                'icon_url' => '/badges/email-beginner.svg',
                'criteria_type' => 'email_count',
                'criteria_value' => 1,
                'rarity' => 1
            ],
            [
                'name' => 'Email Professional',
                'description' => 'Completed 5 professional email exercises',
                'icon_url' => '/badges/email-pro.svg',
                'criteria_type' => 'email_count',
                'criteria_value' => 5,
                'rarity' => 2
            ],
            [
                'name' => 'Correspondence Master',
                'description' => 'Completed 10 email exercises with excellent scores',
                'icon_url' => '/badges/correspondence-master.svg',
                'criteria_type' => 'email_count',
                'criteria_value' => 10,
                'rarity' => 3
            ],
            [
                'name' => 'Writing Virtuoso',
                'description' => 'Achieved perfect scores on 3 written exercises',
                'icon_url' => '/badges/writing-virtuoso.svg',
                'criteria_type' => 'perfect_written',
                'criteria_value' => 3,
                'rarity' => 4
            ],
            
            // Oral Communication Badges
            [
                'name' => 'First Pitch',
                'description' => 'Submitted your first elevator pitch video - Great start!',
                'icon_url' => '/badges/first-pitch.svg',
                'criteria_type' => 'pitch_count',
                'criteria_value' => 1,
                'rarity' => 1
            ],
            [
                'name' => 'Confident Speaker',
                'description' => 'Submitted 3 pitch videos - You\'re gaining confidence!',
                'icon_url' => '/badges/confident-speaker.svg',
                'criteria_type' => 'pitch_count',
                'criteria_value' => 3,
                'rarity' => 2
            ],
            [
                'name' => 'Pitch Perfect',
                'description' => 'Submitted 5 high-quality pitch videos',
                'icon_url' => '/badges/pitch-perfect.svg',
                'criteria_type' => 'pitch_count',
                'criteria_value' => 5,
                'rarity' => 3
            ],
            [
                'name' => 'Presentation Master',
                'description' => 'Average rating of 4.5+ on pitch videos',
                'icon_url' => '/badges/presentation-master.svg',
                'criteria_type' => 'pitch_rating',
                'criteria_value' => 45, // 4.5 * 10 for integer storage
                'rarity' => 3
            ],
            [
                'name' => 'Public Speaking Legend',
                'description' => 'Achieved 5.0 average rating on 3+ pitches',
                'icon_url' => '/badges/speaking-legend.svg',
                'criteria_type' => 'pitch_rating',
                'criteria_value' => 50,
                'rarity' => 4
            ],
            
            // Peer Review Badges
            [
                'name' => 'Helpful Reviewer',
                'description' => 'Provided your first peer review',
                'icon_url' => '/badges/helpful-reviewer.svg',
                'criteria_type' => 'review_count',
                'criteria_value' => 1,
                'rarity' => 1
            ],
            [
                'name' => 'Constructive Critic',
                'description' => 'Provided 10 thoughtful peer reviews',
                'icon_url' => '/badges/constructive-critic.svg',
                'criteria_type' => 'review_count',
                'criteria_value' => 10,
                'rarity' => 2
            ],
            [
                'name' => 'Feedback Champion',
                'description' => '5 of your reviews marked as helpful by peers',
                'icon_url' => '/badges/feedback-champion.svg',
                'criteria_type' => 'helpful_reviews',
                'criteria_value' => 5,
                'rarity' => 3
            ],
            [
                'name' => 'Review Legend',
                'description' => 'Provided 50 quality peer reviews - Exceptional contribution!',
                'icon_url' => '/badges/review-legend.svg',
                'criteria_type' => 'review_count',
                'criteria_value' => 50,
                'rarity' => 4
            ],
            
            // General Exercise Completion
            [
                'name' => 'First Steps',
                'description' => 'Completed your first communication exercise',
                'icon_url' => '/badges/first-steps.svg',
                'criteria_type' => 'exercise_count',
                'criteria_value' => 1,
                'rarity' => 1
            ],
            [
                'name' => 'Skills Builder',
                'description' => 'Completed 10 communication exercises',
                'icon_url' => '/badges/skills-builder.svg',
                'criteria_type' => 'exercise_count',
                'criteria_value' => 10,
                'rarity' => 2
            ],
            [
                'name' => 'Practice Makes Perfect',
                'description' => 'Completed 25 exercises - True dedication!',
                'icon_url' => '/badges/practice-perfect.svg',
                'criteria_type' => 'exercise_count',
                'criteria_value' => 25,
                'rarity' => 3
            ],
            [
                'name' => 'Communication Champion',
                'description' => 'Completed 50 exercises - You\'re unstoppable!',
                'icon_url' => '/badges/communication-champion.svg',
                'criteria_type' => 'exercise_count',
                'criteria_value' => 50,
                'rarity' => 4
            ],
            
            // XP-based Badges
            [
                'name' => 'XP Collector',
                'description' => 'Earned 1,000 XP - Keep up the great work!',
                'icon_url' => '/badges/xp-collector.svg',
                'criteria_type' => 'xp_threshold',
                'criteria_value' => 1000,
                'rarity' => 2
            ],
            [
                'name' => 'XP Champion',
                'description' => 'Earned 5,000 XP - Outstanding achievement!',
                'icon_url' => '/badges/xp-champion.svg',
                'criteria_type' => 'xp_threshold',
                'criteria_value' => 5000,
                'rarity' => 3
            ],
            [
                'name' => 'XP Legend',
                'description' => 'Earned 10,000 XP - Legendary status!',
                'icon_url' => '/badges/xp-legend.svg',
                'criteria_type' => 'xp_threshold',
                'criteria_value' => 10000,
                'rarity' => 4
            ],
            
            // Streak Badges
            [
                'name' => 'Three Day Streak',
                'description' => 'Practiced for 3 consecutive days',
                'icon_url' => '/badges/streak-3.svg',
                'criteria_type' => 'streak',
                'criteria_value' => 3,
                'rarity' => 1
            ],
            [
                'name' => 'Consistency Champion',
                'description' => 'Maintained a 7-day practice streak',
                'icon_url' => '/badges/consistency-champion.svg',
                'criteria_type' => 'streak',
                'criteria_value' => 7,
                'rarity' => 3
            ],
            [
                'name' => 'Dedicated Learner',
                'description' => 'Maintained a 30-day practice streak - Incredible dedication!',
                'icon_url' => '/badges/dedicated-learner.svg',
                'criteria_type' => 'streak',
                'criteria_value' => 30,
                'rarity' => 4
            ],
            
            // Special Achievement Badges
            [
                'name' => 'Well-Rounded Communicator',
                'description' => 'Completed exercises in all communication categories',
                'icon_url' => '/badges/well-rounded.svg',
                'criteria_type' => 'all_categories',
                'criteria_value' => 1,
                'rarity' => 3
            ],
            [
                'name' => 'Team Player',
                'description' => 'Completed 5 peer reviews and received 5 reviews',
                'icon_url' => '/badges/team-player.svg',
                'criteria_type' => 'collaborative',
                'criteria_value' => 5,
                'rarity' => 2
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }

        $this->command->info('✅ Created ' . count($badges) . ' communication-focused badges');
    }
}
