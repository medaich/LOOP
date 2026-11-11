<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@communicationlms.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_xp' => 0,
                'current_level' => 1,
                'streak_days' => 0,
                'last_activity_date' => null,
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'student@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_xp' => 350,
                'current_level' => 4,
                'streak_days' => 5,
                'last_activity_date' => now()->subDay(),
            ],
            [
                'name' => 'Ahmed Hassan',
                'email' => 'ahmed.hassan@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_xp' => 180,
                'current_level' => 2,
                'streak_days' => 3,
                'last_activity_date' => now()->subDays(2),
            ],
            [
                'name' => 'Maria Garcia',
                'email' => 'maria.garcia@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_xp' => 520,
                'current_level' => 6,
                'streak_days' => 12,
                'last_activity_date' => now(),
            ],
            [
                'name' => 'James Wilson',
                'email' => 'james.wilson@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_xp' => 95,
                'current_level' => 1,
                'streak_days' => 1,
                'last_activity_date' => now(),
            ],
            [
                'name' => 'Fatima Al-Rashid',
                'email' => 'fatima.rashid@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_xp' => 780,
                'current_level' => 8,
                'streak_days' => 20,
                'last_activity_date' => now(),
            ],
            [
                'name' => 'Chen Wei',
                'email' => 'chen.wei@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_xp' => 45,
                'current_level' => 1,
                'streak_days' => 0,
                'last_activity_date' => now()->subWeek(),
            ],
            [
                'name' => 'Priya Patel',
                'email' => 'priya.patel@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_xp' => 420,
                'current_level' => 5,
                'streak_days' => 7,
                'last_activity_date' => now()->subDay(),
            ],
            [
                'name' => 'Lucas Silva',
                'email' => 'lucas.silva@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_xp' => 650,
                'current_level' => 7,
                'streak_days' => 15,
                'last_activity_date' => now(),
            ],
            [
                'name' => 'Emma Thompson',
                'email' => 'emma.thompson@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'current_xp' => 230,
                'current_level' => 3,
                'streak_days' => 4,
                'last_activity_date' => now()->subDays(2),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        $this->command->info('✅ Created ' . count($users) . ' demo users');
        $this->command->newLine();
        $this->command->info('Demo User Credentials (all use password: "password"):');
        $this->command->info('  • admin@communicationlms.com (Admin - Level 1)');
        $this->command->info('  • student@example.com (Sarah - Level 4, 5-day streak)');
        $this->command->info('  • fatima.rashid@example.com (Fatima - Level 8, 20-day streak)');
        $this->command->info('  • maria.garcia@example.com (Maria - Level 6, 12-day streak)');
    }
}
