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
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->string('child_id')->unique();
            $table->integer('school_id');
            $table->string('child_name');
            $table->string('birth_of_date');
            $table->string('age');
            $table->string('gender');
            $table->string('education');
            $table->string('current_therapy');
            $table->string('autism_level');
            $table->string('cell');
            $table->text('address');
            $table->string('email');
            $table->string('father_name');
            $table->string('father_education');
            $table->string('father_occupation');
            $table->string('mother_name');
            $table->string('mother_education');
            $table->string('mother_occupation');
            $table->text('image_path');
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
        Schema::dropIfExists('trainees');
    }
};
