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
        Schema::create('lab_access_credentials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Related user
            $table->unsignedBigInteger('training_id');
            $table->string('username')->nullable();
            $table->string('password_access_key')->nullable();
            $table->string('portal_url')->nullable();
            $table->string('vm_rdp_ip')->nullable();
            $table->string('ssh')->nullable();
            $table->string('vpn')->nullable();
            $table->date('assigned_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->tinyInteger('status')->default('0')->comment('1=active and 0= Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_access_credentials');
    }
};
