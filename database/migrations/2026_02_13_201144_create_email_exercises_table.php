<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained('quizzes')->onDelete('cascade');

            $table->string('scenario'); // e.g., "Job Application", "Follow-up"
            $table->text('user_subject_line');
            $table->text('user_body');

            // Auto-scoring criteria
            $table->integer('tone_score')->nullable(); // Professional tone check
            $table->integer('structure_score')->nullable(); // Has greeting, body, closing
            $table->integer('grammar_score')->nullable(); // Basic grammar check

            $table->integer('total_score')->default(0);
            $table->integer('xp_earned')->default(0);
            $table->text('feedback')->nullable(); // Auto-generated feedback
            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'exercise_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_exercises');
    }
};
