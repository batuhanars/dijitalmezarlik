<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Deceased extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deceased', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("province_id");
            $table->unsignedBigInteger("district_id");
            $table->unsignedBigInteger("cemetery_id")->nullable();
            $table->unsignedBigInteger("cemetery_name")->nullable();
            $table->unsignedBigInteger("organisation_id")->nullable();
            $table->unsignedBigInteger("creator_id");
            $table->unsignedBigInteger("neighborhood_id");
            $table->string("image")->nullable();
            $table->string("full_name");
            $table->string("father_name");
            $table->string("mother_name");
            $table->string("spouse_name")->nullable();
            $table->string("job")->nullable();
            $table->longText("content");
            $table->string("year_of_birth")->nullable();
            $table->string("year_of_death")->nullable();
            $table->string("month_of_birth")->nullable();
            $table->string("month_of_death")->nullable();
            $table->string("day_of_birth")->nullable();
            $table->string("day_of_death")->nullable();
            $table->string("place_of_birth")->nullable();
            $table->enum("status", ["0", "1"]);
            $table->timestamps();

            $table->foreign("cemetery_id")->references("id")->on("cemeteries")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deceased');
    }
}
