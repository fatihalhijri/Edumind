<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('progress_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->unsignedInteger('total_questions_answered')->default(0);
            $table->unsignedInteger('correct_answers')->default(0);
            $table->unsignedInteger('materials_studied')->default(0);
            $table->unsignedInteger('streak_days')->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'date']); // 1 record per user per hari
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_stats');
    }
};
