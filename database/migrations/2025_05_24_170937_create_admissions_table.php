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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('skill_level_id')->nullable();
            $table->integer('event_id')->nullable();
            $table->integer('trainer_id')->nullable();
            $table->integer('course_booking_id')->nullable();
            $table->integer('training_category_id')->nullable();
            $table->integer('author_id')->nullable();
            $table->integer('status')->default('0')->comment('0 = pending and 1= done');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
