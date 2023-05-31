<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cemeteries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cemeteries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("province_id");
            $table->unsignedBigInteger("district_id");
            $table->unsignedBigInteger("neighborhood_id");
            $table->enum("type", ["cemetery", "monument", "martyrdom", "tomb"]);
            $table->string("image")->nullable();
            $table->string("title");
            $table->string("slug");
            $table->string("phone")->nullable();
            $table->string("address");
            $table->text("address_map")->nullable();
            $table->longText("content");
            $table->string("opening_time")->nullable();
            $table->string("closing_time")->nullable();
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
        Schema::dropIfExists('cemeteries');
    }
}
