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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('category')->nullable()->after('description');
            $table->string('difficulty')->nullable()->after('category');
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->string('type')->default('quiz')->after('description');
            $table->json('metadata')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['category', 'difficulty']);
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn(['type', 'metadata']);
        });
    }
};
