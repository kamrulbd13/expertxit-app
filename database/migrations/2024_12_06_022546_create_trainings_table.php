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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->integer('training_category_id');// Ensures foreign key reference
            $table->string('training_id')->unique();
            $table->string('training_name')->nullable();
            $table->integer('trainer_id')->nullable();
            $table->integer('trainer_type_id')->nullable();
            $table->integer('skill_level_id')->nullable();
            $table->integer('language_id')->nullable();
            $table->longText('trainingDetails')->nullable();
            $table->string('lecture')->nullable();
            $table->longText('prerequisite')->nullable();
            $table->string('duration')->nullable();
            $table->string('assessment')->nullable();
            $table->string('quizzes')->nullable();
            $table->longText('certification')->nullable();
            $table->longText('learning_outcome')->nullable();
            $table->integer('regular_fees')->nullable();
            $table->integer('current_fees')->nullable();
            $table->text('image_path')->nullable();
            $table->tinyInteger('status')->default('0')->comment('1=active and 0= Draft');
            $table->integer('author_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
