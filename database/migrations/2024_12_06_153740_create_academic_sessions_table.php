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
        Schema::create('academic_sessions', function (Blueprint $table) {
            $table->id();
            $table->integer('training_id');
            $table->integer('child_id');
            $table->integer('trainer_id');
            $table->string('date');
            $table->string('actual_duration');
            $table->integer('achivement_id');
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
        Schema::dropIfExists('academic_sessions');
    }
};
