<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FuneralNotices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funeral_notices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("province_id");
            $table->unsignedBigInteger("district_id");
            $table->unsignedBigInteger("neighborhood_id");
            $table->string("cemetery");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("father_name")->nullable();
            $table->string("mosque");
            $table->string("funeral_address")->nullable();
            $table->string("funeral_time");
            $table->enum("status", ["0", "1"]);
            $table->date("date_of_death");
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
        Schema::dropIfExists('funeral_notices');
    }
}
