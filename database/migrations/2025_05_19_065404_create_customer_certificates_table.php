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
        Schema::create('customer_certificates', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->nullable();
            $table->string('invoice_id')->unique();
            $table->string('certificate_id')->unique();
            $table->date('certificate_issue_date')->nullable();
            $table->integer('payment_status_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('authorized_id')->nullable();
            $table->integer('study_status')->default('0')->comment('0=pending and 1= done');
            $table->integer('certificate_status')->default('0')->comment('0 = pending and 1= done');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_certificates');
    }
};
