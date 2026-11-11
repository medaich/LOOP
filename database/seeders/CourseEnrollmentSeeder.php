<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseEnrollment;

class CourseEnrollmentSeeder extends Seeder
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        $enrollments = [
            // Sarah Johnson (User 2) - Active learner
            ['user_id' => 2, 'course_id' => 1, 'progress_percentage' => 60, 'enrolled_at' => now()->subDays(10), 'completed_at' => null],
            ['user_id' => 2, 'course_id' => 3, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(15), 'completed_at' => now()->subDays(3)],
            ['user_id' => 2, 'course_id' => 4, 'progress_percentage' => 40, 'enrolled_at' => now()->subDays(5), 'completed_at' => null],
            
            // Ahmed Hassan (User 3) - Beginner
            ['user_id' => 3, 'course_id' => 1, 'progress_percentage' => 25, 'enrolled_at' => now()->subDays(7), 'completed_at' => null],
            ['user_id' => 3, 'course_id' => 8, 'progress_percentage' => 15, 'enrolled_at' => now()->subDays(3), 'completed_at' => null],
            
            // Maria Garcia (User 4) - Advanced learner
            ['user_id' => 4, 'course_id' => 1, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(20), 'completed_at' => now()->subDays(10)],
            ['user_id' => 4, 'course_id' => 2, 'progress_percentage' => 80, 'enrolled_at' => now()->subDays(15), 'completed_at' => null],
            ['user_id' => 4, 'course_id' => 4, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(12), 'completed_at' => now()->subDays(5)],
            ['user_id' => 4, 'course_id' => 5, 'progress_percentage' => 50, 'enrolled_at' => now()->subDays(8), 'completed_at' => null],
            ['user_id' => 4, 'course_id' => 6, 'progress_percentage' => 70, 'enrolled_at' => now()->subDays(6), 'completed_at' => null],
            
            // James Wilson (User 5) - Just started
            ['user_id' => 5, 'course_id' => 1, 'progress_percentage' => 10, 'enrolled_at' => now()->subDays(2), 'completed_at' => null],
            
            // Fatima Al-Rashid (User 6) - Power user
            ['user_id' => 6, 'course_id' => 1, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(25), 'completed_at' => now()->subDays(18)],
            ['user_id' => 6, 'course_id' => 2, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(22), 'completed_at' => now()->subDays(15)],
            ['user_id' => 6, 'course_id' => 3, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(20), 'completed_at' => now()->subDays(14)],
            ['user_id' => 6, 'course_id' => 4, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(18), 'completed_at' => now()->subDays(12)],
            ['user_id' => 6, 'course_id' => 5, 'progress_percentage' => 90, 'enrolled_at' => now()->subDays(15), 'completed_at' => null],
            ['user_id' => 6, 'course_id' => 6, 'progress_percentage' => 85, 'enrolled_at' => now()->subDays(12), 'completed_at' => null],
            ['user_id' => 6, 'course_id' => 7, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(10), 'completed_at' => now()->subDays(3)],
            
            // Chen Wei (User 7) - Inactive
            ['user_id' => 7, 'course_id' => 1, 'progress_percentage' => 5, 'enrolled_at' => now()->subDays(14), 'completed_at' => null],
            
            // Priya Patel (User 8) - Consistent learner
            ['user_id' => 8, 'course_id' => 1, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(18), 'completed_at' => now()->subDays(8)],
            ['user_id' => 8, 'course_id' => 2, 'progress_percentage' => 65, 'enrolled_at' => now()->subDays(12), 'completed_at' => null],
            ['user_id' => 8, 'course_id' => 4, 'progress_percentage' => 55, 'enrolled_at' => now()->subDays(9), 'completed_at' => null],
            ['user_id' => 8, 'course_id' => 8, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(6), 'completed_at' => now()->subDays(2)],
            
            // Lucas Silva (User 9) - Focused learner
            ['user_id' => 9, 'course_id' => 1, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(20), 'completed_at' => now()->subDays(12)],
            ['user_id' => 9, 'course_id' => 3, 'progress_percentage' => 100, 'enrolled_at' => now()->subDays(17), 'completed_at' => now()->subDays(10)],
            ['user_id' => 9, 'course_id' => 4, 'progress_percentage' => 80, 'enrolled_at' => now()->subDays(14), 'completed_at' => null],
            ['user_id' => 9, 'course_id' => 6, 'progress_percentage' => 95, 'enrolled_at' => now()->subDays(10), 'completed_at' => null],
            
            // Emma Thompson (User 10) - Moderate pace
            ['user_id' => 10, 'course_id' => 1, 'progress_percentage' => 45, 'enrolled_at' => now()->subDays(12), 'completed_at' => null],
            ['user_id' => 10, 'course_id' => 8, 'progress_percentage' => 30, 'enrolled_at' => now()->subDays(6), 'completed_at' => null],
        ];

        foreach ($enrollments as $enrollmentData) {
            CourseEnrollment::create($enrollmentData);
        }

        $this->command->info('✅ Created ' . count($enrollments) . ' course enrollments');
    }
}
