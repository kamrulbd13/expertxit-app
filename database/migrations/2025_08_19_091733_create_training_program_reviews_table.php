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
        Schema::create('training_program_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id');   // Which training
            $table->unsignedBigInteger('user_id');       // Who wrote review
            $table->tinyInteger('rating')->default(0);   // 1–5 stars
            $table->text('review')->nullable();
            $table->timestamps();

//            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_program_reviews');
    }
};
