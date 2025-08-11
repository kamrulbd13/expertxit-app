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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('category_id') // Ensures foreign key reference
//            ->constrained('event_categories') // References 'event_categories' table
//            ->onDelete('cascade'); // Deletes events when category is deleted
            $table->integer('category_id');// Ensures foreign key reference
            $table->string('title');
            $table->text('description');
            $table->text('session_method')->nullable();
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
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
        Schema::dropIfExists('events');
    }
};
