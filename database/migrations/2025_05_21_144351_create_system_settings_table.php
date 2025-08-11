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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('slogan')->nullable();
            $table->string('mail1')->nullable();
            $table->string('mail2')->nullable();
            $table->string('number1')->nullable();
            $table->string('number2')->nullable();
            $table->text('address')->nullable();
            $table->string('map_link')->nullable();
            $table->string('website_link')->nullable();
            $table->string('copy_right')->nullable();
            $table->string('image_logo_color')->nullable();
            $table->unsignedInteger('logo_width')->nullable();
            $table->unsignedInteger('logo_height')->nullable();
            $table->string('image_logo_white')->nullable();
            $table->string('fevicon_icon')->nullable();
            $table->string('org_seal')->nullable();
            $table->string('signature')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
        });

        DB::table('system_settings')->insert([
            'site_name'         => 'Demo',
            'slogan'            => 'Default Slogan',
            'mail1'             => 'demo1@mail.com',
            'mail2'             => 'demo2@mail.com',
            'number1'           => '00000000001',
            'number2'           => '00000000002',
            'address'           => '#15, R#05, Dhaka, Bangladesh',
            'map_link'          => 'http://127.0.0.1:8000/',
            'website_link'      => 'http://demo.com/',
            'copy_right'        => '© ' . date('Y') . ' n/a . All rights reserved.',
            'image_logo_color'  => 'backend/images/systemSetting/logo_color.png',
            'image_logo_white'  => 'backend/images/systemSetting/logo_white.png',
            'fevicon_icon'      => 'backend/images/systemSetting/fevicon_icon.png',
            'org_seal'          => 'backend/images/systemSetting/org_seal.png',
            'signature'         => 'backend/images/systemSetting/signature.png',
            'logo_width'        => 200,
            'logo_height'       => 150,
            'facebook'          => 'http://facebook.com/',
            'linkedin'          => 'http://linkedin.com/',
            'twitter'           => 'http://twitter.com/',
            'youtube'           => 'http://youtube.com/',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
