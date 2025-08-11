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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_id');
            $table->string('from_type'); // 'admin' or 'customer'

            $table->unsignedBigInteger('to_id');
            $table->string('to_type'); // 'admin' or 'customer'

            $table->text('message')->nullable();

            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_type')->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->unsignedBigInteger('reply_to_id')->nullable();

            $table->timestamps();

            // Indexes for performance
            $table->index(['from_id', 'from_type']);
            $table->index(['to_id', 'to_type']);
            $table->foreign('reply_to_id')->references('id')->on('chat_messages')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
