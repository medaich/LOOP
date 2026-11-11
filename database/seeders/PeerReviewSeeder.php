<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PeerReview;

class PeerReviewSeeder extends Seeder
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        $reviews = [
            // Reviews for Sarah's pitch (Video Pitch ID 1)
            [
                'reviewer_id' => 4, // Maria
                'video_pitch_id' => 1,
                'clarity_score' => 4,
                'confidence_score' => 4,
                'structure_score' => 4,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Great energy and clear message! Your passion for digital marketing really comes through. Consider adding a specific achievement or metric to make it even more compelling.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 6, // Fatima
                'video_pitch_id' => 1,
                'clarity_score' => 5,
                'confidence_score' => 4,
                'structure_score' => 4,
                'persuasiveness_score' => 4,
                'written_feedback' => 'Excellent structure and delivery! You maintained good eye contact and spoke at a clear pace. One suggestion: briefly mention what you\'re looking for at the end to give it a stronger call to action.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 9, // Lucas
                'video_pitch_id' => 1,
                'clarity_score' => 4,
                'confidence_score' => 4,
                'structure_score' => 4,
                'persuasiveness_score' => 4,
                'written_feedback' => 'Well done! Your pitch flows naturally and you come across as genuine and professional. The pacing was perfect for the 75-second timeframe.',
                'xp_earned' => 25,
                'is_helpful' => false,
            ],
            
            // Reviews for Maria's first pitch (Video Pitch ID 2)
            [
                'reviewer_id' => 2, // Sarah
                'video_pitch_id' => 2,
                'clarity_score' => 5,
                'confidence_score' => 5,
                'structure_score' => 5,
                'persuasiveness_score' => 4,
                'written_feedback' => 'Impressive! You clearly articulated your value proposition and backed it up with concrete results. Your confident delivery matches your strong credentials perfectly.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 6, // Fatima
                'video_pitch_id' => 2,
                'clarity_score' => 5,
                'confidence_score' => 5,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Outstanding pitch! You hit all the key points: who you are, what you do, and what makes you unique. The mention of specific metrics (25% market share increase) adds credibility. This is a model elevator pitch.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 9, // Lucas
                'video_pitch_id' => 2,
                'clarity_score' => 5,
                'confidence_score' => 4,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Very polished and professional. You maintained excellent eye contact and your enthusiasm is contagious. The strategic marketing focus is clear and compelling.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 8, // Priya
                'video_pitch_id' => 2,
                'clarity_score' => 4,
                'confidence_score' => 5,
                'structure_score' => 4,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Excellent delivery! I particularly liked how you connected your skills to the industry. Very persuasive and memorable.',
                'xp_earned' => 25,
                'is_helpful' => false,
            ],
            
            // Reviews for Maria's second pitch (Video Pitch ID 3)
            [
                'reviewer_id' => 2, // Sarah
                'video_pitch_id' => 3,
                'clarity_score' => 5,
                'confidence_score' => 4,
                'structure_score' => 5,
                'persuasiveness_score' => 4,
                'written_feedback' => 'Great job tailoring your pitch to the tech industry! You demonstrated clear knowledge of the sector. The only minor suggestion: maybe slow down slightly at the beginning to ensure every word lands.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 6, // Fatima
                'video_pitch_id' => 3,
                'clarity_score' => 4,
                'confidence_score' => 5,
                'structure_score' => 4,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Strong industry-specific pitch! Your tech sector knowledge shines through. Consider adding one specific technology or platform you\'ve worked with to add even more credibility.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            
            // Reviews for Fatima's first pitch (Video Pitch ID 4)
            [
                'reviewer_id' => 2, // Sarah
                'video_pitch_id' => 4,
                'clarity_score' => 5,
                'confidence_score' => 5,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Absolutely flawless! This is executive-level communication at its finest. Your authority and expertise come through clearly, and the 50% acquisition increase with 20% cost reduction is a killer stat. Nothing to improve here!',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 4, // Maria
                'video_pitch_id' => 4,
                'clarity_score' => 5,
                'confidence_score' => 5,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Exceptional! Your command of the subject matter is evident. The results you shared are impressive and the way you delivered them was both confident and approachable. A perfect pitch.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 9, // Lucas
                'video_pitch_id' => 4,
                'clarity_score' => 5,
                'confidence_score' => 5,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'This is how it\'s done! Clear, concise, compelling. You demonstrated value immediately with concrete metrics. Your professional presence is outstanding.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 8, // Priya
                'video_pitch_id' => 4,
                'clarity_score' => 5,
                'confidence_score' => 5,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Simply brilliant. The balance between professionalism and warmth is perfect. You\'re clearly a leader in your field and it shows in every aspect of this pitch.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 10, // Emma
                'video_pitch_id' => 4,
                'clarity_score' => 5,
                'confidence_score' => 5,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'I learned so much from watching this! The way you structured your pitch with the problem-solution-results format was masterful. Thank you for setting such a high bar!',
                'xp_earned' => 25,
                'is_helpful' => false,
            ],
            
            // Reviews for Fatima's second pitch (Video Pitch ID 5)
            [
                'reviewer_id' => 4, // Maria
                'video_pitch_id' => 5,
                'clarity_score' => 5,
                'confidence_score' => 5,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Another excellent pitch from you! The digital transformation angle is very relevant and you positioned yourself as a thought leader. Minor note: the ending could be slightly stronger with a more specific ask.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 2, // Sarah
                'video_pitch_id' => 5,
                'clarity_score' => 5,
                'confidence_score' => 5,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Outstanding pitch showcasing your digital expertise! You\'re clearly ahead of the curve in understanding digital marketing trends. Very inspiring!',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 9, // Lucas
                'video_pitch_id' => 5,
                'clarity_score' => 5,
                'confidence_score' => 4,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Excellent positioning as a digital transformation leader. Your expertise is clear and compelling. Great use of industry terminology without being overly technical.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 8, // Priya
                'video_pitch_id' => 5,
                'clarity_score' => 4,
                'confidence_score' => 5,
                'structure_score' => 5,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Really strong pitch! You demonstrated both strategic thinking and practical implementation. This would definitely make me want to continue the conversation.',
                'xp_earned' => 25,
                'is_helpful' => false,
            ],
            
            // Reviews for Lucas's pitch (Video Pitch ID 6)
            [
                'reviewer_id' => 4, // Maria
                'video_pitch_id' => 6,
                'clarity_score' => 4,
                'confidence_score' => 4,
                'structure_score' => 4,
                'persuasiveness_score' => 5,
                'written_feedback' => 'I really appreciated your creative approach! The problem-solving angle you highlighted sets you apart. Consider adding one specific campaign or project example to make it even more memorable.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 6, // Fatima
                'video_pitch_id' => 6,
                'clarity_score' => 4,
                'confidence_score' => 4,
                'structure_score' => 5,
                'persuasiveness_score' => 4,
                'written_feedback' => 'Good job! Your creative positioning is clear and authentic. The pitch flows well and you seem comfortable on camera. One tip: maintain eye contact throughout, especially in the middle section.',
                'xp_earned' => 25,
                'is_helpful' => true,
            ],
            [
                'reviewer_id' => 2, // Sarah
                'video_pitch_id' => 6,
                'clarity_score' => 4,
                'confidence_score' => 4,
                'structure_score' => 4,
                'persuasiveness_score' => 5,
                'written_feedback' => 'Well done! Your enthusiasm for creative marketing is infectious. The structure was solid and you stayed within the time limit perfectly.',
                'xp_earned' => 25,
                'is_helpful' => false,
            ],
        ];

        foreach ($reviews as $reviewData) {
            PeerReview::create($reviewData);
        }

        $this->command->info('✅ Created ' . count($reviews) . ' peer review records');
    }
}
