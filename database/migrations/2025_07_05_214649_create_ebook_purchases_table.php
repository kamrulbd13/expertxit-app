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
        Schema::create('ebook_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ebook_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Uses customers table
            $table->decimal('price_paid', 8, 2);
            $table->string('payment_method')->nullable(); // card, cash, etc.
            $table->string('sender_account')->nullable(); // remove trailing space
            $table->string('transaction_id')->nullable(); // remove trailing space
            $table->string('payment_proof')->nullable();
            $table->text('note')->nullable(); // remove trailing space
            $table->timestamp('purchased_at')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebook_purchases');
    }
};
