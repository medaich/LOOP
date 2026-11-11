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
        Schema::create('peer_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('video_pitch_id')->constrained()->onDelete('cascade');

            // Structured rubric scores (1-5 scale)
            $table->integer('clarity_score')->nullable();
            $table->integer('confidence_score')->nullable();
            $table->integer('structure_score')->nullable();
            $table->integer('persuasiveness_score')->nullable();

            $table->text('written_feedback');
            $table->integer('xp_earned')->default(25); // Reviewer earns XP
            $table->boolean('is_helpful')->default(false); // Marked by video owner
            $table->timestamps();

            $table->index('reviewer_id');
            $table->index('video_pitch_id');
            $table->unique(['reviewer_id', 'video_pitch_id']); // One review per person
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peer_reviews');
    }
};
