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
        Schema::create('exercise_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained()->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->integer('xp_earned')->default(0);
            $table->string('status')->default('in_progress'); // 'in_progress', 'completed'
            $table->json('user_data')->nullable(); // Stores user's answer/submission
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'exercise_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercise_progress');
    }
};
