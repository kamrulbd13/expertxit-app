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
        Schema::create('kids_programing_curricula', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kidsProgramme_id');
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('description')->nullable();
            $table->integer('duration')->nullable();     // in minutes
            $table->tinyInteger('status')->default('0')->comment('1=active and 0= Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kids_programing_curricula');
    }
};
