<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Order matters - respect foreign key constraints
            BadgeSeeder::class,
            CourseSeeder::class,
            QuizSeeder::class,
            QuestionSeeder::class,
            UserSeeder::class,
            CourseEnrollmentSeeder::class,
            ExerciseProgressSeeder::class,
            PeerReviewSeeder::class,
        ]);

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📊 Summary:');
        $this->command->info('   - Badges: Communication-focused achievement system');
        $this->command->info('   - Courses: Written & Oral Communication modules');
        $this->command->info('   - Exercises: CV, Email, Video Pitch challenges');
        $this->command->info('   - Users: Demo accounts with varying progress');
        $this->command->info('   - Peer Reviews: Collaborative learning data');
        $this->command->info('');
        $this->command->info('🔐 Demo Credentials:');
        $this->command->info('   Admin: admin@communicationlms.com / password');
        $this->command->info('   Student: student@example.com / password');
    }
}
