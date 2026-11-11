# Communication Skills LMS - Database Seeders

Complete database seeding suite for the Gamified Communication Skills Learning Management System, inspired by the Injaz "Steer Your Career" program.

## 📋 Overview

This seeder package provides realistic, production-ready sample data for developing and testing the Communication Skills LMS. All seeders are designed to work with the provided Laravel migrations and create a fully functional demo environment.

## 🗂️ Seeder Files

### 1. **DatabaseSeeder.php**
Main orchestrator that calls all other seeders in the correct order to respect foreign key constraints.

### 2. **BadgeSeeder.php** (35 badges)
Creates communication-focused achievement badges:
- **Level-based**: Communication Novice → Master Communicator (Levels 1-20)
- **Written Skills**: CV Apprentice, Email Professional, Writing Virtuoso
- **Oral Skills**: First Pitch, Pitch Perfect, Presentation Master
- **Peer Review**: Helpful Reviewer, Constructive Critic, Review Legend
- **Streaks**: 3-day, 7-day, 30-day consistency badges
- **XP Milestones**: 1K, 5K, 10K XP achievements

### 3. **CourseSeeder.php** (10 courses)
Communication skills courses across written and oral categories:
- Professional Written Communication
- Advanced Email Etiquette
- CV & Resume Mastery
- Elevator Pitch Excellence
- Presentation Skills Fundamentals
- Job Interview Communication
- Business Correspondence
- Networking & Small Talk
- Digital Communication Best Practices
- Conflict Resolution Communication

### 4. **QuizSeeder.php** (17 exercises)
Diverse exercise types including:
- **CV Structure Games**: Drag-and-drop CV section ordering (Injaz "CV Game" digital version)
- **Email Exercises**: Job applications, follow-ups, networking emails
- **Video Pitch Challenges**: Elevator pitches, interview questions, presentations
- **Knowledge Quizzes**: Multiple-choice assessments

### 5. **QuestionSeeder.php** (38 questions)
Multiple-choice questions for knowledge-based quizzes covering:
- Email etiquette and professional writing
- CV content and formatting best practices
- Presentation skills and delivery techniques
- Interview question strategies (STAR method)

### 6. **UserSeeder.php** (10 users)
Demo accounts with varying skill levels and engagement:
- **Admin**: admin@communicationlms.com (Level 1, fresh account)
- **Sarah Johnson**: student@example.com (Level 4, 5-day streak, active learner)
- **Fatima Al-Rashid**: Level 8, 20-day streak (power user with highest engagement)
- **Maria Garcia**: Level 6, 12-day streak (advanced learner)
- 6 additional users at various levels (1-7)

**All passwords**: `password`

### 7. **CourseEnrollmentSeeder.php** (29 enrollments)
Realistic course enrollment patterns showing:
- Active learners (multiple courses, high progress)
- Beginners (1-2 courses, low progress)
- Completed courses with timestamps
- Inactive users with stalled progress

### 8. **ExerciseProgressSeeder.php**
Comprehensive progress data including:
- **Quiz completions**: 8 quiz attempts with scores (70-100%)
- **CV exercises**: 5 completed CV structure games (including perfect scores)
- **Email exercises**: 4 professional email submissions with auto-scoring
- **Video pitches**: 6 elevator pitch videos with metadata

### 9. **PeerReviewSeeder.php** (23 reviews)
Authentic peer review data demonstrating:
- Structured rubric scores (1-5 scale): Clarity, Confidence, Structure, Persuasiveness
- Written feedback with constructive comments
- "Helpful" flags from video owners
- Average rating calculations for pitches

## 🚀 Installation

### Step 1: Copy Seeders
Place all `.php` files in your Laravel project:
```bash
cp *.php /path/to/your-project/database/seeders/
```

### Step 2: Run Migrations
Ensure all migrations are run first:
```bash
php artisan migrate:fresh
```

### Step 3: Seed Database
Run the main seeder:
```bash
php artisan db:seed
```

Or seed specific classes:
```bash
php artisan db:seed --class=BadgeSeeder
php artisan db:seed --class=CourseSeeder
```

### Step 4: Verify
Check that data was created:
```bash
php artisan tinker
>>> App\Models\User::count();  // Should return 10
>>> App\Models\Badge::count(); // Should return 35
>>> App\Models\Course::count(); // Should return 10
```

## 📊 Data Summary

After seeding, your database will contain:

| Table | Records | Description |
|-------|---------|-------------|
| `badges` | 35 | Communication-focused achievements |
| `courses` | 10 | Written & Oral communication courses |
| `quizzes` | 17 | CV games, email exercises, video pitches, quizzes |
| `questions` | 38 | Multiple-choice quiz questions |
| `users` | 10 | Demo accounts (1 admin + 9 students) |
| `course_enrollments` | 29 | User course registrations |
| `user_progress` | 8 | Quiz attempt records |
| `cv_exercises` | 5 | CV structure game completions |
| `email_exercises` | 4 | Professional email submissions |
| `video_pitches` | 6 | Elevator pitch videos |
| `peer_reviews` | 23 | Video pitch peer evaluations |

## 🎯 Usage Scenarios

### Testing Different User Levels
- **Beginner**: Login as `james.wilson@example.com` (Level 1, 95 XP)
- **Intermediate**: Login as `priya.patel@example.com` (Level 5, 420 XP)
- **Advanced**: Login as `fatima.rashid@example.com` (Level 8, 780 XP)

### Testing Exercise Types
- **CV Game**: Quiz ID 1, 6 (basic and advanced structure challenges)
- **Email Writing**: Quiz ID 3, 4, 5 (job application, follow-up, networking)
- **Video Pitches**: Quiz ID 8, 9 (elevator pitch, industry-specific)

### Testing Social Features
- **Peer Reviews**: 6 video pitches with 23 total reviews
- **Leaderboard**: 10 users with varying XP totals
- **Streaks**: Users with 0, 1, 3, 5, 7, 12, 15, 20-day streaks

## 🔑 Demo Credentials

| Email | Password | Level | XP | Streak | Profile |
|-------|----------|-------|-----|--------|---------|
| admin@communicationlms.com | password | 1 | 0 | 0 | Administrator account |
| student@example.com | password | 4 | 350 | 5 | Active beginner (Sarah) |
| fatima.rashid@example.com | password | 8 | 780 | 20 | Power user, highest engagement |
| maria.garcia@example.com | password | 6 | 520 | 12 | Advanced learner |
| lucas.silva@example.com | password | 7 | 650 | 15 | Consistent learner |

## 🎮 Gamification Elements

### XP Distribution
- Quiz completion: 100-150 XP
- CV exercise perfect score: 225 XP (with bonus)
- Email exercise: 120-144 XP (score-based)
- Video pitch submission: 200-250 XP
- Peer review: 25 XP per review

### Level Progression
Formula: Next level requires `level * 100` XP
- Level 1→2: 100 XP
- Level 2→3: 200 XP
- Level 5→6: 500 XP

### Badge Criteria Examples
- "Communication Novice": Awarded at Level 1
- "CV Master": Perfect score on CV exercise
- "Pitch Perfect": 5 video pitches submitted
- "Constructive Critic": 10 peer reviews provided
- "Consistency Champion": 7-day streak

## 📝 Customization

### Adding More Users
Edit `UserSeeder.php` and add entries to the `$users` array.

### Modifying Badge Criteria
Edit `BadgeSeeder.php` - adjust `criteria_value` for difficulty tuning.

### Adding Course Content
Edit `CourseSeeder.php` - update URLs, descriptions, estimated hours.

### Adjusting XP Rewards
Edit `QuizSeeder.php` - modify `xp_reward` values for each exercise.

## ⚠️ Important Notes

1. **Order Matters**: DatabaseSeeder runs seeders in dependency order. Don't change the sequence.

2. **Foreign Keys**: Ensure migrations create proper foreign key constraints before seeding.

3. **File Storage**: Video pitch URLs (`/videos/pitches/*.mp4`) are placeholders. Configure actual file storage for production.

4. **Email Validation**: All seeded users have `email_verified_at` set. Remove for testing verification flows.

5. **Realistic Data**: Exercise submissions include realistic feedback, scores, and timestamps for authentic testing.

## 🛠️ Troubleshooting

### "Class not found" error
```bash
composer dump-autoload
php artisan db:seed
```

### Foreign key constraint errors
Ensure migrations are run first:
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Duplicate entry errors
If re-seeding, use `migrate:fresh`:
```bash
php artisan migrate:fresh --seed
```

## 📚 Integration with Injaz Methodology

These seeders implement the Injaz "Steer Your Career" program concepts:

1. **CV Game**: Digital version of analog CV sorting activity (Quiz ID 1, 6)
2. **Experiential Learning**: Hands-on exercises over passive content
3. **Peer Feedback**: Structured review system with rubrics
4. **Immediate Feedback**: Auto-scoring for instant validation
5. **Progress Tracking**: XP, levels, streaks, badges

## 🤝 Contributing

When adding new seeders:
1. Follow the existing naming convention
2. Include descriptive comments
3. Use realistic data (names, content, timestamps)
4. Respect foreign key relationships
5. Update this README with changes

## 📄 License

These seeders are part of the Communication Skills LMS project. Use freely for development and testing.

---

**Created for**: Gamified Communication Skills LMS MVP  
**Based on**: Injaz Al-Maghrib "Steer Your Career" Program  
**Last Updated**: February 2026  
**Version**: 1.0.0
