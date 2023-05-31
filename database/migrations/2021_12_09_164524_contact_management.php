<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContactManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_management', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->string("address")->nullable();
            $table->text("address_map")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_management');
    }
}
