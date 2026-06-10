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
        Schema::create('quiz_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('material_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->unsignedTinyInteger('total_questions')->default(10);
            $table->enum('question_type', ['multiple_choice', 'essay', 'mixed'])->default('multiple_choice');
            $table->enum('status', ['generating', 'active', 'completed'])->default('generating');
            $table->unsignedTinyInteger('score')->nullable();   // 0-100
            $table->unsignedInteger('time_spent')->nullable();  // detik
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_sessions');
    }
};
