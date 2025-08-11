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
        Schema::create('new_batch_upcomings', function (Blueprint $table) {
            $table->id();
            $table->string('course_id')->nullable();
            $table->string('training_category_id')->nullable();
            $table->string('trainer_id')->nullable();
            $table->string('batch_id')->unique();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('author_id');
            $table->tinyInteger('status')->default('0')->comment('1=active and 0= Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_batch_upcomings');
    }
};
