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
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('course_booking_id')->unique();
            $table->integer('course_id');
            $table->string('training_id');
            $table->string('invoice_id')->unique();
            $table->integer('current_fees');
            $table->integer('total_paid_payment')->nullable();
            $table->string('payment_sender_ac');
            $table->string('transaction_id');
            $table->text('image_path')->nullable();
            $table->text('note_reference')->nullable();
            $table->integer('payment_status')->default('0')->comment('0 = pending and 1= done');
            $table->integer('verify_status')->default('0')->comment('0 = pending and 1= done');
            $table->integer('customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_payments');
    }
};
