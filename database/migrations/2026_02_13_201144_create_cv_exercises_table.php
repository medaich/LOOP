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
        Schema::create('cv_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained('quizzes')->onDelete('cascade');

            // JSON storing the user's CV structure
            $table->json('cv_structure'); // e.g., ["header", "experience", "education"]
            $table->json('correct_structure'); // The ideal order
            $table->integer('score')->default(0); // Percentage match
            $table->integer('xp_earned')->default(0);
            $table->integer('attempts')->default(1);
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'exercise_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_exercises');
    }
};
