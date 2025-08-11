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
        Schema::create('customer_courses', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('customer_id');
            $table->integer('batch_id')->nullable();
            $table->integer('booking_confirm_status')->default('0')->comment('0=pending and 1= done');
            $table->integer('study_status')->default('0')->comment('0=pending and 1= done');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_courses');
    }
};
