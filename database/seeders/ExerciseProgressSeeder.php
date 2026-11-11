<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserProgress;
use App\Models\CVExercise;
use App\Models\EmailExercise;
use App\Models\VideoPitch;

class ExerciseProgressSeeder extends Seeder
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        $this->seedQuizProgress();
        $this->seedCVExercises();
        $this->seedEmailExercises();
        $this->seedVideoPitches();
        
        $this->command->info('✅ Exercise progress data seeded successfully');
    }

    private function seedQuizProgress(): void
    {
        $progressData = [
            // Sarah Johnson (User 2)
            [
                'user_id' => 2,
                'quiz_id' => 2, // Professional Email Basics Quiz
                'score' => 85,
                'xp_earned' => 100,
                'answers' => json_encode(['answer1' => 'option3', 'answer2' => 'option2']),
                'is_completed' => true,
                'attempt_number' => 1,
                'started_at' => now()->subDays(8),
                'completed_at' => now()->subDays(8),
            ],
            [
                'user_id' => 2,
                'quiz_id' => 7, // CV Content Quality Quiz
                'score' => 90,
                'xp_earned' => 100,
                'answers' => json_encode(['answer1' => 'option2', 'answer2' => 'option2']),
                'is_completed' => true,
                'attempt_number' => 1,
                'started_at' => now()->subDays(4),
                'completed_at' => now()->subDays(4),
            ],
            
            // Maria Garcia (User 4)
            [
                'user_id' => 4,
                'quiz_id' => 2,
                'score' => 95,
                'xp_earned' => 100,
                'answers' => json_encode(['answer1' => 'option3', 'answer2' => 'option2']),
                'is_completed' => true,
                'attempt_number' => 1,
                'started_at' => now()->subDays(12),
                'completed_at' => now()->subDays(12),
            ],
            [
                'user_id' => 4,
                'quiz_id' => 7,
                'score' => 100,
                'xp_earned' => 100,
                'answers' => json_encode(['answer1' => 'option2', 'answer2' => 'option2']),
                'is_completed' => true,
                'attempt_number' => 1,
                'started_at' => now()->subDays(9),
                'completed_at' => now()->subDays(9),
            ],
            [
                'user_id' => 4,
                'quiz_id' => 11, // Presentation Skills Knowledge Check
                'score' => 88,
                'xp_earned' => 100,
                'answers' => json_encode(['answer1' => 'option2', 'answer2' => 'option2']),
                'is_completed' => true,
                'attempt_number' => 1,
                'started_at' => now()->subDays(5),
                'completed_at' => now()->subDays(5),
            ],
            
            // Fatima Al-Rashid (User 6) - Power user
            [
                'user_id' => 6,
                'quiz_id' => 2,
                'score' => 100,
                'xp_earned' => 100,
                'answers' => json_encode(['answer1' => 'option3', 'answer2' => 'option2']),
                'is_completed' => true,
                'attempt_number' => 1,
                'started_at' => now()->subDays(20),
                'completed_at' => now()->subDays(20),
            ],
            [
                'user_id' => 6,
                'quiz_id' => 7,
                'score' => 100,
                'xp_earned' => 100,
                'answers' => json_encode(['answer1' => 'option2', 'answer2' => 'option2']),
                'is_completed' => true,
                'attempt_number' => 1,
                'started_at' => now()->subDays(16),
                'completed_at' => now()->subDays(16),
            ],
            [
                'user_id' => 6,
                'quiz_id' => 11,
                'score' => 95,
                'xp_earned' => 100,
                'answers' => json_encode(['answer1' => 'option2', 'answer2' => 'option2']),
                'is_completed' => true,
                'attempt_number' => 1,
                'started_at' => now()->subDays(13),
                'completed_at' => now()->subDays(13),
            ],
            [
                'user_id' => 6,
                'quiz_id' => 13, // Interview Questions Quiz
                'score' => 92,
                'xp_earned' => 150,
                'answers' => json_encode(['answer1' => 'option2', 'answer2' => 'option2']),
                'is_completed' => true,
                'attempt_number' => 1,
                'started_at' => now()->subDays(8),
                'completed_at' => now()->subDays(8),
            ],
        ];

        foreach ($progressData as $data) {
            UserProgress::create($data);
        }

        $this->command->info('  → Quiz progress records created');
    }

    private function seedCVExercises(): void
    {
        $cvExercises = [
            // Sarah Johnson
            [
                'user_id' => 2,
                'exercise_id' => 1, // CV Structure Game - The Basics
                'cv_structure' => json_encode(['header', 'summary', 'experience', 'education', 'skills', 'certifications']),
                'correct_structure' => json_encode(['header', 'summary', 'experience', 'education', 'skills', 'certifications']),
                'score' => 100,
                'xp_earned' => 225, // Bonus for perfect
                'attempts' => 1,
                'is_completed' => true,
                'completed_at' => now()->subDays(6),
            ],
            
            // Maria Garcia
            [
                'user_id' => 4,
                'exercise_id' => 1,
                'cv_structure' => json_encode(['header', 'summary', 'experience', 'education', 'skills', 'certifications']),
                'correct_structure' => json_encode(['header', 'summary', 'experience', 'education', 'skills', 'certifications']),
                'score' => 100,
                'xp_earned' => 225,
                'attempts' => 1,
                'is_completed' => true,
                'completed_at' => now()->subDays(11),
            ],
            [
                'user_id' => 4,
                'exercise_id' => 6, // Advanced CV Structure Challenge
                'cv_structure' => json_encode(['header', 'summary', 'key_achievements', 'experience', 'education', 'skills', 'languages', 'certifications']),
                'correct_structure' => json_encode(['header', 'summary', 'key_achievements', 'experience', 'education', 'skills', 'languages', 'certifications']),
                'score' => 100,
                'xp_earned' => 300, // Bonus for perfect advanced
                'attempts' => 1,
                'is_completed' => true,
                'completed_at' => now()->subDays(7),
            ],
            
            // Fatima Al-Rashid
            [
                'user_id' => 6,
                'exercise_id' => 1,
                'cv_structure' => json_encode(['header', 'summary', 'experience', 'education', 'skills', 'certifications']),
                'correct_structure' => json_encode(['header', 'summary', 'experience', 'education', 'skills', 'certifications']),
                'score' => 100,
                'xp_earned' => 225,
                'attempts' => 1,
                'is_completed' => true,
                'completed_at' => now()->subDays(19),
            ],
            [
                'user_id' => 6,
                'exercise_id' => 6,
                'cv_structure' => json_encode(['header', 'summary', 'key_achievements', 'experience', 'education', 'skills', 'languages', 'certifications']),
                'correct_structure' => json_encode(['header', 'summary', 'key_achievements', 'experience', 'education', 'skills', 'languages', 'certifications']),
                'score' => 100,
                'xp_earned' => 300,
                'attempts' => 1,
                'is_completed' => true,
                'completed_at' => now()->subDays(15),
            ],
            
            // Lucas Silva
            [
                'user_id' => 9,
                'exercise_id' => 1,
                'cv_structure' => json_encode(['header', 'summary', 'experience', 'education', 'skills', 'certifications']),
                'correct_structure' => json_encode(['header', 'summary', 'experience', 'education', 'skills', 'certifications']),
                'score' => 100,
                'xp_earned' => 225,
                'attempts' => 1,
                'is_completed' => true,
                'completed_at' => now()->subDays(13),
            ],
        ];

        foreach ($cvExercises as $data) {
            CVExercise::create($data);
        }

        $this->command->info('  → CV exercise records created');
    }

    private function seedEmailExercises(): void
    {
        $emailExercises = [
            // Sarah Johnson
            [
                'user_id' => 2,
                'exercise_id' => 3, // Job Application Email
                'scenario' => 'job_application',
                'user_subject_line' => 'Application for Marketing Manager Position - Sarah Johnson',
                'user_body' => 'Dear Hiring Manager,

I am writing to express my strong interest in the Marketing Manager position at TechCorp. With over 5 years of experience in digital marketing and a proven track record of increasing brand engagement by 40%, I am confident I would be a valuable addition to your team.

In my current role at ABC Company, I have successfully led cross-functional campaigns and managed a team of marketing specialists. I am particularly excited about TechCorp\'s innovative approach to product marketing.

I would welcome the opportunity to discuss how my skills align with your needs. Thank you for your consideration.

Best regards,
Sarah Johnson',
                'tone_score' => 90,
                'structure_score' => 95,
                'grammar_score' => 100,
                'total_score' => 95,
                'xp_earned' => 144, // 120 * 1.2 for score >= 90
                'feedback' => json_encode(['Excellent! Your email is professional and well-structured.']),
                'is_completed' => true,
            ],
            
            // Maria Garcia
            [
                'user_id' => 4,
                'exercise_id' => 3,
                'scenario' => 'job_application',
                'user_subject_line' => 'Marketing Manager Application - Maria Garcia',
                'user_body' => 'Dear Hiring Team,

I am excited to apply for the Marketing Manager position at TechCorp. My background in strategic marketing and passion for technology make me an ideal candidate for this role.

Over the past 6 years, I have developed expertise in brand development, digital campaigns, and team leadership. At my current company, I increased our market share by 25% through innovative marketing strategies.

I would be thrilled to bring my skills to TechCorp and contribute to your continued success.

Best regards,
Maria Garcia',
                'tone_score' => 92,
                'structure_score' => 90,
                'grammar_score' => 100,
                'total_score' => 94,
                'xp_earned' => 144,
                'feedback' => json_encode(['Excellent! Your email is professional and well-structured.']),
                'is_completed' => true,
            ],
            [
                'user_id' => 4,
                'exercise_id' => 4, // Follow-Up Email
                'scenario' => 'interview_followup',
                'user_subject_line' => 'Thank You - Project Manager Interview',
                'user_body' => 'Dear Ms. Anderson,

Thank you for taking the time to meet with me yesterday to discuss the Project Manager position. I truly enjoyed learning more about the innovative projects at TechCorp.

Our conversation about agile methodologies and your team\'s approach to stakeholder management particularly resonated with me. I am even more excited about the opportunity to contribute to your team.

Please don\'t hesitate to contact me if you need any additional information.

Best regards,
Maria Garcia',
                'tone_score' => 95,
                'structure_score' => 95,
                'grammar_score' => 100,
                'total_score' => 97,
                'xp_earned' => 144,
                'feedback' => json_encode(['Excellent! Your email is professional and well-structured.']),
                'is_completed' => true,
            ],
            
            // Fatima Al-Rashid
            [
                'user_id' => 6,
                'exercise_id' => 3,
                'scenario' => 'job_application',
                'user_subject_line' => 'Application for Marketing Manager - Fatima Al-Rashid',
                'user_body' => 'Dear Hiring Manager,

I am writing to apply for the Marketing Manager position at TechCorp, as advertised on LinkedIn. With 7 years of progressive experience in marketing leadership and a Master\'s degree in Business Administration, I am confident in my ability to drive results for your organization.

At XYZ Corporation, I led a team that increased customer acquisition by 50% while reducing marketing costs by 20%. I am particularly drawn to TechCorp\'s commitment to innovation and customer-centric approach.

I would appreciate the opportunity to discuss how my background aligns with your team\'s needs. Thank you for your time and consideration.

Sincerely,
Fatima Al-Rashid',
                'tone_score' => 100,
                'structure_score' => 100,
                'grammar_score' => 100,
                'total_score' => 100,
                'xp_earned' => 144,
                'feedback' => json_encode(['Excellent! Your email is professional and well-structured.']),
                'is_completed' => true,
            ],
        ];

        foreach ($emailExercises as $data) {
            EmailExercise::create($data);
        }

        $this->command->info('  → Email exercise records created');
    }

    private function seedVideoPitches(): void
    {
        $videoPitches = [
            // Sarah Johnson
            [
                'user_id' => 2,
                'exercise_id' => 8, // Your First Elevator Pitch
                'title' => 'Marketing Professional Seeking Growth',
                'description' => 'My elevator pitch highlighting my digital marketing experience',
                'video_url' => '/videos/pitches/sarah_pitch_001.mp4',
                'duration_seconds' => 75,
                'xp_earned' => 200,
                'average_rating' => 4.2,
                'review_count' => 3,
                'status' => 'reviewed',
                'submitted_at' => now()->subDays(5),
            ],
            
            // Maria Garcia
            [
                'user_id' => 4,
                'exercise_id' => 8,
                'title' => 'Strategic Marketing Leader',
                'description' => 'Elevator pitch focusing on my leadership and results',
                'video_url' => '/videos/pitches/maria_pitch_001.mp4',
                'duration_seconds' => 82,
                'xp_earned' => 200,
                'average_rating' => 4.7,
                'review_count' => 4,
                'status' => 'reviewed',
                'submitted_at' => now()->subDays(9),
            ],
            [
                'user_id' => 4,
                'exercise_id' => 9, // Industry-Specific Pitch
                'title' => 'Tech Industry Marketing Specialist',
                'description' => 'Tailored pitch for technology sector roles',
                'video_url' => '/videos/pitches/maria_pitch_002.mp4',
                'duration_seconds' => 88,
                'xp_earned' => 250,
                'average_rating' => 4.5,
                'review_count' => 2,
                'status' => 'reviewed',
                'submitted_at' => now()->subDays(4),
            ],
            
            // Fatima Al-Rashid
            [
                'user_id' => 6,
                'exercise_id' => 8,
                'title' => 'Results-Driven Marketing Executive',
                'description' => 'Executive-level elevator pitch',
                'video_url' => '/videos/pitches/fatima_pitch_001.mp4',
                'duration_seconds' => 79,
                'xp_earned' => 200,
                'average_rating' => 5.0,
                'review_count' => 5,
                'status' => 'reviewed',
                'submitted_at' => now()->subDays(17),
            ],
            [
                'user_id' => 6,
                'exercise_id' => 9,
                'title' => 'Digital Transformation Leader',
                'description' => 'Pitch emphasizing digital marketing expertise',
                'video_url' => '/videos/pitches/fatima_pitch_002.mp4',
                'duration_seconds' => 90,
                'xp_earned' => 250,
                'average_rating' => 4.9,
                'review_count' => 4,
                'status' => 'reviewed',
                'submitted_at' => now()->subDays(11),
            ],
            
            // Lucas Silva
            [
                'user_id' => 9,
                'exercise_id' => 8,
                'title' => 'Creative Marketing Professional',
                'description' => 'Pitch highlighting creative problem-solving skills',
                'video_url' => '/videos/pitches/lucas_pitch_001.mp4',
                'duration_seconds' => 73,
                'xp_earned' => 200,
                'average_rating' => 4.3,
                'review_count' => 3,
                'status' => 'reviewed',
                'submitted_at' => now()->subDays(12),
            ],
        ];

        foreach ($videoPitches as $data) {
            VideoPitch::create($data);
        }

        $this->command->info('  → Video pitch records created');
    }
}
