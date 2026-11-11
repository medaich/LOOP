<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Professional Written Communication',
                'description' => 'Master the art of professional writing including CV creation, business emails, and formal correspondence. Based on Injaz "Steer Your Career" methodology with hands-on exercises and instant feedback.',
                'category' => 'Written Communication',
                'difficulty' => 'Beginner',
                'thumbnail_url' => '/images/courses/written-communication.jpg',
                'content_url' => '/content/written-communication-guide.pdf',
                'estimated_hours' => 8,
                'is_published' => true,
            ],
            [
                'title' => 'Advanced Email Etiquette',
                'description' => 'Learn to craft compelling, professional emails for various business scenarios including job applications, follow-ups, networking, and client communication.',
                'category' => 'Written Communication',
                'difficulty' => 'Intermediate',
                'thumbnail_url' => '/images/courses/email-etiquette.jpg',
                'content_url' => '/content/email-etiquette-guide.pdf',
                'estimated_hours' => 6,
                'is_published' => true,
            ],
            [
                'title' => 'CV & Resume Mastery',
                'description' => 'Create standout CVs and resumes that get noticed. Learn optimal structure, formatting, and content strategies based on recruitment best practices.',
                'category' => 'Written Communication',
                'difficulty' => 'Beginner',
                'thumbnail_url' => '/images/courses/cv-mastery.jpg',
                'content_url' => '/content/cv-mastery-guide.pdf',
                'estimated_hours' => 5,
                'is_published' => true,
            ],
            [
                'title' => 'Elevator Pitch Excellence',
                'description' => 'Develop and deliver compelling 60-90 second elevator pitches. Learn structure, delivery techniques, and receive peer feedback on your video submissions.',
                'category' => 'Oral Communication',
                'difficulty' => 'Beginner',
                'thumbnail_url' => '/images/courses/elevator-pitch.jpg',
                'content_url' => '/content/elevator-pitch-guide.pdf',
                'estimated_hours' => 4,
                'is_published' => true,
            ],
            [
                'title' => 'Presentation Skills Fundamentals',
                'description' => 'Build confidence in public speaking and presentations. Learn to structure compelling narratives, use visual aids effectively, and engage your audience.',
                'category' => 'Oral Communication',
                'difficulty' => 'Intermediate',
                'thumbnail_url' => '/images/courses/presentation-skills.jpg',
                'content_url' => '/content/presentation-skills-guide.pdf',
                'estimated_hours' => 10,
                'is_published' => true,
            ],
            [
                'title' => 'Job Interview Communication',
                'description' => 'Master the communication skills needed to excel in job interviews. Practice answering common questions, behavioral scenarios, and salary negotiations.',
                'category' => 'Oral Communication',
                'difficulty' => 'Intermediate',
                'thumbnail_url' => '/images/courses/interview-skills.jpg',
                'content_url' => '/content/interview-skills-guide.pdf',
                'estimated_hours' => 7,
                'is_published' => true,
            ],
            [
                'title' => 'Business Correspondence',
                'description' => 'Write effective business letters, memos, and reports. Understand formal writing conventions and adapt your style to different professional contexts.',
                'category' => 'Written Communication',
                'difficulty' => 'Intermediate',
                'thumbnail_url' => '/images/courses/business-correspondence.jpg',
                'content_url' => '/content/business-correspondence-guide.pdf',
                'estimated_hours' => 6,
                'is_published' => true,
            ],
            [
                'title' => 'Networking & Small Talk',
                'description' => 'Develop conversational skills for professional networking events. Learn to start conversations, build rapport, and make lasting connections.',
                'category' => 'Oral Communication',
                'difficulty' => 'Beginner',
                'thumbnail_url' => '/images/courses/networking.jpg',
                'content_url' => '/content/networking-guide.pdf',
                'estimated_hours' => 5,
                'is_published' => true,
            ],
            [
                'title' => 'Digital Communication Best Practices',
                'description' => 'Navigate the world of digital communication including Slack, Teams, video calls, and professional social media. Maintain professionalism across all platforms.',
                'category' => 'Written Communication',
                'difficulty' => 'Beginner',
                'thumbnail_url' => '/images/courses/digital-communication.jpg',
                'content_url' => '/content/digital-communication-guide.pdf',
                'estimated_hours' => 4,
                'is_published' => true,
            ],
            [
                'title' => 'Conflict Resolution Communication',
                'description' => 'Learn to communicate effectively during conflicts and difficult conversations. Practice de-escalation techniques and assertive communication.',
                'category' => 'Oral Communication',
                'difficulty' => 'Advanced',
                'thumbnail_url' => '/images/courses/conflict-resolution.jpg',
                'content_url' => '/content/conflict-resolution-guide.pdf',
                'estimated_hours' => 8,
                'is_published' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            Course::create($courseData);
        }

        $this->command->info('✅ Created ' . count($courses) . ' communication skills courses');
    }
}
