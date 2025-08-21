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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->default(0)->after('remember_token');

            // Add foreign key constraint
//            $table->foreign('role_id')
//                ->references('id')
//                ->on('roles')
//                ->onDelete('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);

            // Drop the column
            $table->dropColumn('role_id');
        });
    }
};
