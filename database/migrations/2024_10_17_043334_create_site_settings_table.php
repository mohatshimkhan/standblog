<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('header_logo_title');
            $table->string('cta_title');
            $table->string('cta_description');
            $table->string('phone_number');
            $table->string('email');
            $table->text('address');
            $table->string('about_us_description');
            $table->string('facebook_url');
            $table->string('twitter_url');
            $table->string('behance_url');
            $table->string('linkedin_url');
            $table->string('dribble_url');
            $table->string('footer_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }

}