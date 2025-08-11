<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_mail_settings', function (Blueprint $table) {
            $table->id();
            $table->string('mail_mailer')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_from_address')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->integer('author_id')->nullable();
            $table->tinyInteger('status')->default('0')->comment('1=active and 0= Draft');
            $table->timestamps();
        });

        DB::table('system_mail_settings')->insert([
            'mail_mailer'         => 'smtp',
            'mail_host'           => 'smtp.gmail.com',
            'mail_port'           => 465,
            'mail_username'       => 'microcodelab@gmail.com',
            'mail_password'       => 'xfkr mhrx aess ifhv',
            'mail_encryption'     => 'tls',
            'mail_from_address'   => 'microcodelab@gmail.com',
            'mail_from_name'      => 'demo',
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_mail_settings');
    }
};
