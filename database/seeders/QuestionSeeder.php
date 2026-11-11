<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        $questions = [
            // Quiz 2: Professional Email Basics Quiz
            [
                'quiz_id' => 2,
                'question_text' => 'What is the most professional email greeting for a first business contact?',
                'options' => json_encode(['Hey there!', 'Hi,', 'Dear Mr./Ms. [Last Name],', 'Yo,']),
                'correct_answer' => 'Dear Mr./Ms. [Last Name],',
                'points' => 10,
                'order' => 1,
            ],
            [
                'quiz_id' => 2,
                'question_text' => 'Which subject line is most effective for a job application email?',
                'options' => json_encode([
                    'Job Application',
                    'Application for Marketing Manager Position - Jane Smith',
                    'Please Read: Job Application',
                    'Regarding Employment'
                ]),
                'correct_answer' => 'Application for Marketing Manager Position - Jane Smith',
                'points' => 10,
                'order' => 2,
            ],
            [
                'quiz_id' => 2,
                'question_text' => 'When should you follow up after sending an important business email?',
                'options' => json_encode([
                    'After 24 hours',
                    'After 2-3 business days',
                    'After 1 week',
                    'Never follow up, it\'s unprofessional'
                ]),
                'correct_answer' => 'After 2-3 business days',
                'points' => 10,
                'order' => 3,
            ],
            [
                'quiz_id' => 2,
                'question_text' => 'Which closing is most appropriate for a formal business email?',
                'options' => json_encode(['Cheers,', 'Best regards,', 'Later,', 'TTYL,']),
                'correct_answer' => 'Best regards,',
                'points' => 10,
                'order' => 4,
            ],
            [
                'quiz_id' => 2,
                'question_text' => 'What should you do before sending an important email?',
                'options' => json_encode([
                    'Send it immediately',
                    'Proofread and check attachments',
                    'Ask someone else to write it',
                    'Add emojis to make it friendly'
                ]),
                'correct_answer' => 'Proofread and check attachments',
                'points' => 10,
                'order' => 5,
            ],
            [
                'quiz_id' => 2,
                'question_text' => 'How long should a professional email typically be?',
                'options' => json_encode([
                    'As long as needed to explain everything',
                    'Brief and to the point (3-5 short paragraphs)',
                    '1 sentence only',
                    'At least 500 words'
                ]),
                'correct_answer' => 'Brief and to the point (3-5 short paragraphs)',
                'points' => 10,
                'order' => 6,
            ],
            [
                'quiz_id' => 2,
                'question_text' => 'When is it appropriate to use ALL CAPS in a professional email?',
                'options' => json_encode([
                    'When you want emphasis',
                    'For important points',
                    'Never, it appears like shouting',
                    'Only in the subject line'
                ]),
                'correct_answer' => 'Never, it appears like shouting',
                'points' => 10,
                'order' => 7,
            ],
            [
                'quiz_id' => 2,
                'question_text' => 'What should you include in your email signature?',
                'options' => json_encode([
                    'Just your name',
                    'Name, title, company, and contact information',
                    'Your favorite quote',
                    'Personal information only'
                ]),
                'correct_answer' => 'Name, title, company, and contact information',
                'points' => 10,
                'order' => 8,
            ],
            [
                'quiz_id' => 2,
                'question_text' => 'How should you handle urgent matters in email?',
                'options' => json_encode([
                    'Mark every email as urgent',
                    'Use "URGENT" in the subject line sparingly and only when truly needed',
                    'Send multiple emails until they respond',
                    'Never indicate urgency in emails'
                ]),
                'correct_answer' => 'Use "URGENT" in the subject line sparingly and only when truly needed',
                'points' => 10,
                'order' => 9,
            ],
            [
                'quiz_id' => 2,
                'question_text' => 'What is the best practice for email tone?',
                'options' => json_encode([
                    'Be casual and use lots of emojis',
                    'Be professional but warm',
                    'Be extremely formal at all times',
                    'Match exactly the tone of the sender'
                ]),
                'correct_answer' => 'Be professional but warm',
                'points' => 10,
                'order' => 10,
            ],

            // Quiz 7: CV Content Quality Quiz
            [
                'quiz_id' => 7,
                'question_text' => 'What is the ideal length for a CV for someone with 5-10 years of experience?',
                'options' => json_encode(['1 page', '2 pages', '3-4 pages', 'As long as needed']),
                'correct_answer' => '2 pages',
                'points' => 10,
                'order' => 1,
            ],
            [
                'quiz_id' => 7,
                'question_text' => 'Which type of bullet points are most effective on a CV?',
                'options' => json_encode([
                    'Duty-focused: "Responsible for managing..."',
                    'Achievement-focused: "Increased sales by 30%..."',
                    'Activity-focused: "Attended meetings..."',
                    'All of the above equally'
                ]),
                'correct_answer' => 'Achievement-focused: "Increased sales by 30%..."',
                'points' => 10,
                'order' => 2,
            ],
            [
                'quiz_id' => 7,
                'question_text' => 'Should you include a photo on your CV?',
                'options' => json_encode([
                    'Always',
                    'Never',
                    'Depends on country/industry norms',
                    'Only if you\'re attractive'
                ]),
                'correct_answer' => 'Depends on country/industry norms',
                'points' => 10,
                'order' => 3,
            ],
            [
                'quiz_id' => 7,
                'question_text' => 'How far back should your work experience typically go?',
                'options' => json_encode([
                    'All jobs ever held',
                    '10-15 years of relevant experience',
                    'Only the last 2 years',
                    'Only current job'
                ]),
                'correct_answer' => '10-15 years of relevant experience',
                'points' => 10,
                'order' => 4,
            ],
            [
                'quiz_id' => 7,
                'question_text' => 'What should you do about employment gaps?',
                'options' => json_encode([
                    'Try to hide them',
                    'Address them honestly with brief explanations',
                    'Lie about dates',
                    'Leave them unexplained'
                ]),
                'correct_answer' => 'Address them honestly with brief explanations',
                'points' => 10,
                'order' => 5,
            ],
            [
                'quiz_id' => 7,
                'question_text' => 'Which font is most appropriate for a professional CV?',
                'options' => json_encode(['Arial or Calibri', 'Comic Sans', 'Papyrus', 'Brush Script']),
                'correct_answer' => 'Arial or Calibri',
                'points' => 10,
                'order' => 6,
            ],
            [
                'quiz_id' => 7,
                'question_text' => 'Should you include references on your CV?',
                'options' => json_encode([
                    'Yes, always include full contact details',
                    'Write "References available upon request"',
                    'No need to mention references at all',
                    'Include references only if you have space'
                ]),
                'correct_answer' => 'No need to mention references at all',
                'points' => 10,
                'order' => 7,
            ],
            [
                'quiz_id' => 7,
                'question_text' => 'What is the best way to list technical skills?',
                'options' => json_encode([
                    'In long paragraphs',
                    'Grouped by category with proficiency levels',
                    'Mixed throughout work experience',
                    'Not needed on a CV'
                ]),
                'correct_answer' => 'Grouped by category with proficiency levels',
                'points' => 10,
                'order' => 8,
            ],

            // Quiz 11: Presentation Skills Knowledge Check
            [
                'quiz_id' => 11,
                'question_text' => 'What is the most effective way to open a presentation?',
                'options' => json_encode([
                    'With an apology for taking their time',
                    'With a compelling hook (story, statistic, or question)',
                    'By reading your entire slide deck',
                    'With a long introduction about yourself'
                ]),
                'correct_answer' => 'With a compelling hook (story, statistic, or question)',
                'points' => 10,
                'order' => 1,
            ],
            [
                'quiz_id' => 11,
                'question_text' => 'How much text should you include on each slide?',
                'options' => json_encode([
                    'Full paragraphs so people can read along',
                    'Minimal text - key points only (5-7 words per line)',
                    'No text, only images',
                    'As much as fits on the slide'
                ]),
                'correct_answer' => 'Minimal text - key points only (5-7 words per line)',
                'points' => 10,
                'order' => 2,
            ],
            [
                'quiz_id' => 11,
                'question_text' => 'What should you do if you lose your place during a presentation?',
                'options' => json_encode([
                    'Panic and apologize repeatedly',
                    'Pause briefly, take a breath, and continue',
                    'Start over from the beginning',
                    'End the presentation immediately'
                ]),
                'correct_answer' => 'Pause briefly, take a breath, and continue',
                'points' => 10,
                'order' => 3,
            ],
            [
                'quiz_id' => 11,
                'question_text' => 'How should you handle questions during a presentation?',
                'options' => json_encode([
                    'Ignore all questions',
                    'Answer questions as they arise',
                    'Save questions for the end (unless specified otherwise)',
                    'Get defensive if questioned'
                ]),
                'correct_answer' => 'Save questions for the end (unless specified otherwise)',
                'points' => 10,
                'order' => 4,
            ],
            [
                'quiz_id' => 11,
                'question_text' => 'What is the ideal speaking pace for a presentation?',
                'options' => json_encode([
                    'As fast as possible to fit everything in',
                    'Moderate pace with strategic pauses for emphasis',
                    'Very slow to ensure everyone understands',
                    'Varying wildly to keep it interesting'
                ]),
                'correct_answer' => 'Moderate pace with strategic pauses for emphasis',
                'points' => 10,
                'order' => 5,
            ],

            // Quiz 13: Interview Questions Quiz
            [
                'quiz_id' => 13,
                'question_text' => 'When answering "Tell me about yourself", you should:',
                'options' => json_encode([
                    'Share your entire life story',
                    'Focus on professional background relevant to the role',
                    'Discuss only personal hobbies',
                    'Talk about your family'
                ]),
                'correct_answer' => 'Focus on professional background relevant to the role',
                'points' => 15,
                'order' => 1,
            ],
            [
                'quiz_id' => 13,
                'question_text' => 'How should you answer "What is your greatest weakness?"',
                'options' => json_encode([
                    'Say you have no weaknesses',
                    'Mention a genuine weakness and how you\'re improving it',
                    'Turn it into a strength ("I work too hard")',
                    'Blame others for your weaknesses'
                ]),
                'correct_answer' => 'Mention a genuine weakness and how you\'re improving it',
                'points' => 15,
                'order' => 2,
            ],
            [
                'quiz_id' => 13,
                'question_text' => 'What is the STAR method for behavioral questions?',
                'options' => json_encode([
                    'Smile, Talk, Act, React',
                    'Situation, Task, Action, Result',
                    'Start, Tell, Analyze, Review',
                    'Story, Theory, Application, Response'
                ]),
                'correct_answer' => 'Situation, Task, Action, Result',
                'points' => 15,
                'order' => 3,
            ],
            [
                'quiz_id' => 13,
                'question_text' => 'When asked about salary expectations, you should:',
                'options' => json_encode([
                    'Name the lowest number you\'d accept',
                    'Research market rates and provide a range',
                    'Say "I\'ll take anything"',
                    'Refuse to discuss salary'
                ]),
                'correct_answer' => 'Research market rates and provide a range',
                'points' => 15,
                'order' => 4,
            ],
            [
                'quiz_id' => 13,
                'question_text' => 'What questions should you ask the interviewer?',
                'options' => json_encode([
                    'None, it might seem presumptuous',
                    'Only about salary and benefits',
                    'Thoughtful questions about the role, team, and company culture',
                    'Personal questions about the interviewer'
                ]),
                'correct_answer' => 'Thoughtful questions about the role, team, and company culture',
                'points' => 15,
                'order' => 5,
            ],
        ];

        foreach ($questions as $questionData) {
            Question::create($questionData);
        }

        $this->command->info('✅ Created ' . count($questions) . ' quiz questions');
    }
}
