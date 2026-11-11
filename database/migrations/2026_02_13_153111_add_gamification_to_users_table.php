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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('current_xp')->default(0);
            $table->integer('current_level')->default(1);
            $table->integer('streak_days')->default(0);
            $table->date('last_activity_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['current_xp', 'current_level', 'streak_days', 'last_activity_date']);
        });
    }
};
