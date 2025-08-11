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
        Schema::create('exam_systems', function (Blueprint $table) {
            $table->id();
            // Foreign key to trainings table
            $table->foreignId('training_id')->constrained('trainings')->onDelete('cascade');

            // Exam info
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('duration'); // in minutes
            $table->unsignedInteger('total_marks')->default(0);
            $table->unsignedInteger('pass_marks')->default(0);

            // Optional scheduling
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->boolean('is_published')->default(false);

            // Creator (e.g., admin user)
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_systems');
    }
};
