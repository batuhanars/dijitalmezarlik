<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AboutApp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_app', function (Blueprint $table) {
            $table->id();
            $table->text("images")->nullable();
            $table->string("video_image")->nullable();
            $table->string("video")->nullable();
            $table->string("title")->nullable();
            $table->text("content")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_app');
    }
}
