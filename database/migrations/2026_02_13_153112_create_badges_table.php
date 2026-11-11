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
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->string('icon_url')->nullable();
            $table->string('criteria_type'); // 'level', 'exercise_count', 'xp_threshold'
            $table->integer('criteria_value');
            $table->integer('rarity')->default(1); // 1=Common, 2=Rare, 3=Epic, 4=Legendary
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
