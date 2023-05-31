<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CemeteryServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cemetery_services', function (Blueprint $table) {
            $table->id();
            $table->string("image")->nullable();
            $table->string("title");
            $table->string("slug");
            $table->text("short_description");
            $table->longText("content");
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
        Schema::dropIfExists('cemetery_services');
    }
}
