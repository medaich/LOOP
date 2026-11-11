<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        $quizzes = [
            // Course 1: Professional Written Communication
            [
                'course_id' => 1,
                'title' => 'CV Structure Game - The Basics',
                'description' => 'Arrange CV sections in the correct professional order. This digital version of the Injaz "CV Game" provides instant feedback!',
                'type' => 'cv',
                'metadata' => json_encode([
                    'correct_order' => ['header', 'summary', 'experience', 'education', 'skills', 'certifications'],
                    'sections' => [
                        'header' => 'Contact Information & Header',
                        'summary' => 'Professional Summary',
                        'experience' => 'Professional Experience',
                        'education' => 'Education',
                        'skills' => 'Skills & Competencies',
                        'certifications' => 'Certifications & Awards'
                    ]
                ]),
                'xp_reward' => 150,
                'passing_score' => 80,
                'time_limit_minutes' => 15,
                'max_attempts' => 5,
                'is_active' => true,
            ],
            [
                'course_id' => 1,
                'title' => 'Professional Email Basics Quiz',
                'description' => 'Test your knowledge of email etiquette, structure, and professional writing conventions.',
                'type' => 'quiz',
                'metadata' => null,
                'xp_reward' => 100,
                'passing_score' => 70,
                'time_limit_minutes' => 20,
                'max_attempts' => 3,
                'is_active' => true,
            ],
            
            // Course 2: Advanced Email Etiquette
            [
                'course_id' => 2,
                'title' => 'Job Application Email Exercise',
                'description' => 'Write a professional job application email. Your tone, structure, and grammar will be automatically evaluated.',
                'type' => 'email',
                'metadata' => json_encode([
                    'scenario' => 'job_application',
                    'context' => 'You\'re applying for a Marketing Manager position at TechCorp. Write a professional cover email.',
                    'requirements' => [
                        'Include proper greeting',
                        'State the position clearly',
                        'Highlight 2-3 key qualifications',
                        'Express enthusiasm',
                        'Professional closing'
                    ]
                ]),
                'xp_reward' => 120,
                'passing_score' => 70,
                'time_limit_minutes' => 30,
                'max_attempts' => 3,
                'is_active' => true,
            ],
            [
                'course_id' => 2,
                'title' => 'Follow-Up Email Exercise',
                'description' => 'Write a professional follow-up email after a job interview.',
                'type' => 'email',
                'metadata' => json_encode([
                    'scenario' => 'interview_followup',
                    'context' => 'You interviewed yesterday for a Project Manager role. Send a thank-you email.',
                    'requirements' => [
                        'Thank the interviewer',
                        'Reference specific discussion points',
                        'Reaffirm your interest',
                        'Professional tone'
                    ]
                ]),
                'xp_reward' => 120,
                'passing_score' => 70,
                'time_limit_minutes' => 25,
                'max_attempts' => 3,
                'is_active' => true,
            ],
            [
                'course_id' => 2,
                'title' => 'Networking Introduction Email',
                'description' => 'Reach out to a professional connection for networking purposes.',
                'type' => 'email',
                'metadata' => json_encode([
                    'scenario' => 'networking',
                    'context' => 'You met Sarah at a conference. Send an email to connect and suggest a coffee meeting.',
                    'requirements' => [
                        'Reference where you met',
                        'Find common ground',
                        'Make a specific suggestion',
                        'Be brief and respectful of their time'
                    ]
                ]),
                'xp_reward' => 120,
                'passing_score' => 70,
                'time_limit_minutes' => 25,
                'max_attempts' => 3,
                'is_active' => true,
            ],
            
            // Course 3: CV & Resume Mastery
            [
                'course_id' => 3,
                'title' => 'Advanced CV Structure Challenge',
                'description' => 'Master the optimal CV structure for different industries and career levels.',
                'type' => 'cv',
                'metadata' => json_encode([
                    'correct_order' => ['header', 'summary', 'key_achievements', 'experience', 'education', 'skills', 'languages', 'certifications'],
                    'sections' => [
                        'header' => 'Contact Information',
                        'summary' => 'Executive Summary',
                        'key_achievements' => 'Key Achievements & Metrics',
                        'experience' => 'Professional Experience',
                        'education' => 'Education & Qualifications',
                        'skills' => 'Technical & Soft Skills',
                        'languages' => 'Languages',
                        'certifications' => 'Certifications & Professional Development'
                    ]
                ]),
                'xp_reward' => 200,
                'passing_score' => 85,
                'time_limit_minutes' => 20,
                'max_attempts' => 5,
                'is_active' => true,
            ],
            [
                'course_id' => 3,
                'title' => 'CV Content Quality Quiz',
                'description' => 'Learn what makes CV content compelling and effective.',
                'type' => 'quiz',
                'metadata' => null,
                'xp_reward' => 100,
                'passing_score' => 75,
                'time_limit_minutes' => 15,
                'max_attempts' => 3,
                'is_active' => true,
            ],
            
            // Course 4: Elevator Pitch Excellence
            [
                'course_id' => 4,
                'title' => 'Your First Elevator Pitch',
                'description' => 'Record and submit your first 60-90 second elevator pitch. Introduce yourself professionally and explain what you do.',
                'type' => 'video',
                'metadata' => json_encode([
                    'duration_target' => 75, // seconds
                    'rubric' => [
                        'clarity' => 'Message is clear and easy to understand',
                        'confidence' => 'Speaks with confidence and poise',
                        'structure' => 'Well-organized with clear beginning, middle, end',
                        'persuasiveness' => 'Compelling and memorable'
                    ],
                    'tips' => [
                        'Start with your name and role/aspiration',
                        'Highlight 2-3 key skills or achievements',
                        'Explain what makes you unique',
                        'End with what you\'re looking for'
                    ]
                ]),
                'xp_reward' => 200,
                'passing_score' => 60,
                'time_limit_minutes' => null,
                'max_attempts' => 5,
                'is_active' => true,
            ],
            [
                'course_id' => 4,
                'title' => 'Industry-Specific Pitch',
                'description' => 'Create a tailored pitch for your target industry or role.',
                'type' => 'video',
                'metadata' => json_encode([
                    'duration_target' => 90,
                    'rubric' => [
                        'clarity' => 'Clear industry knowledge',
                        'confidence' => 'Professional presence',
                        'structure' => 'Tailored to industry context',
                        'persuasiveness' => 'Demonstrates value proposition'
                    ]
                ]),
                'xp_reward' => 250,
                'passing_score' => 70,
                'time_limit_minutes' => null,
                'max_attempts' => 5,
                'is_active' => true,
            ],
            
            // Course 5: Presentation Skills Fundamentals
            [
                'course_id' => 5,
                'title' => 'Presentation Opener Video',
                'description' => 'Record a compelling 90-second presentation opening on a topic of your choice.',
                'type' => 'video',
                'metadata' => json_encode([
                    'duration_target' => 90,
                    'rubric' => [
                        'clarity' => 'Clear hook and topic introduction',
                        'confidence' => 'Engaging delivery style',
                        'structure' => 'Strong opening that captures attention',
                        'persuasiveness' => 'Makes audience want to hear more'
                    ]
                ]),
                'xp_reward' => 200,
                'passing_score' => 65,
                'time_limit_minutes' => null,
                'max_attempts' => 5,
                'is_active' => true,
            ],
            [
                'course_id' => 5,
                'title' => 'Presentation Skills Knowledge Check',
                'description' => 'Test your understanding of effective presentation techniques.',
                'type' => 'quiz',
                'metadata' => null,
                'xp_reward' => 100,
                'passing_score' => 70,
                'time_limit_minutes' => 20,
                'max_attempts' => 3,
                'is_active' => true,
            ],
            
            // Course 6: Job Interview Communication
            [
                'course_id' => 6,
                'title' => 'Tell Me About Yourself - Video Response',
                'description' => 'Record your answer to the classic interview question: "Tell me about yourself"',
                'type' => 'video',
                'metadata' => json_encode([
                    'duration_target' => 120,
                    'question' => 'Tell me about yourself',
                    'rubric' => [
                        'clarity' => 'Clear career narrative',
                        'confidence' => 'Professional and confident delivery',
                        'structure' => 'Past-Present-Future structure',
                        'persuasiveness' => 'Demonstrates fit for role'
                    ]
                ]),
                'xp_reward' => 200,
                'passing_score' => 70,
                'time_limit_minutes' => null,
                'max_attempts' => 5,
                'is_active' => true,
            ],
            [
                'course_id' => 6,
                'title' => 'Interview Questions Quiz',
                'description' => 'Practice answering common interview questions.',
                'type' => 'quiz',
                'metadata' => null,
                'xp_reward' => 150,
                'passing_score' => 75,
                'time_limit_minutes' => 30,
                'max_attempts' => 3,
                'is_active' => true,
            ],
            
            // Course 7: Business Correspondence
            [
                'course_id' => 7,
                'title' => 'Formal Business Letter Exercise',
                'description' => 'Write a formal business letter for a professional scenario.',
                'type' => 'email',
                'metadata' => json_encode([
                    'scenario' => 'business_letter',
                    'context' => 'Write to a supplier about delayed shipment and request resolution.',
                    'requirements' => [
                        'Formal business letter format',
                        'Clear statement of issue',
                        'Professional tone despite problem',
                        'Specific resolution request'
                    ]
                ]),
                'xp_reward' => 150,
                'passing_score' => 75,
                'time_limit_minutes' => 40,
                'max_attempts' => 3,
                'is_active' => true,
            ],
            
            // Course 8: Networking & Small Talk
            [
                'course_id' => 8,
                'title' => 'Networking Pitch Video',
                'description' => 'Record a 30-second introduction you\'d use at a networking event.',
                'type' => 'video',
                'metadata' => json_encode([
                    'duration_target' => 30,
                    'rubric' => [
                        'clarity' => 'Quick and memorable introduction',
                        'confidence' => 'Approachable and engaging',
                        'structure' => 'Name, role, interesting hook',
                        'persuasiveness' => 'Makes people want to continue conversation'
                    ]
                ]),
                'xp_reward' => 150,
                'passing_score' => 65,
                'time_limit_minutes' => null,
                'max_attempts' => 5,
                'is_active' => true,
            ],
            
            // Course 9: Digital Communication Best Practices
            [
                'course_id' => 9,
                'title' => 'Slack Message Exercise',
                'description' => 'Write professional messages for a team collaboration platform.',
                'type' => 'email',
                'metadata' => json_encode([
                    'scenario' => 'slack_message',
                    'context' => 'Inform your team about a project delay and propose next steps.',
                    'requirements' => [
                        'Brief and scannable',
                        'Clear action items',
                        'Professional but conversational',
                        'Uses appropriate formatting'
                    ]
                ]),
                'xp_reward' => 100,
                'passing_score' => 70,
                'time_limit_minutes' => 20,
                'max_attempts' => 3,
                'is_active' => true,
            ],
            
            // Course 10: Conflict Resolution Communication
            [
                'course_id' => 10,
                'title' => 'Difficult Conversation Email',
                'description' => 'Address a workplace conflict via email using de-escalation techniques.',
                'type' => 'email',
                'metadata' => json_encode([
                    'scenario' => 'conflict_resolution',
                    'context' => 'A colleague took credit for your work. Write an email to address this professionally.',
                    'requirements' => [
                        'Calm and professional tone',
                        'State facts without accusations',
                        'Express impact using I-statements',
                        'Suggest constructive resolution'
                    ]
                ]),
                'xp_reward' => 200,
                'passing_score' => 75,
                'time_limit_minutes' => 35,
                'max_attempts' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($quizzes as $quizData) {
            Quiz::create($quizData);
        }

        $this->command->info('✅ Created ' . count($quizzes) . ' communication exercises and quizzes');
    }
}
