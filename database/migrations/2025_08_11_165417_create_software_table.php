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
        Schema::create('software', function (Blueprint $table) {
            $table->id();
            $table->integer('software_category_id');// Ensures foreign key reference
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('core_features')->nullable();
            $table->longText('why_choose_our_solution')->nullable();
            $table->longText('advanced_modules')->nullable();
            $table->longText('benefits_for_every_stakeholder')->nullable();
            $table->longText('get_started_today')->nullable();
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
        Schema::dropIfExists('software');
    }
};
