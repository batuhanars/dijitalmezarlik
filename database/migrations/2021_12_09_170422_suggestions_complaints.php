<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SuggestionsComplaints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions_complaints', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            $table->enum("title", ["suggestion", "complaint"]);
            $table->text("topic");
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
        Schema::dropIfExists('suggestions_complaints');
    }
}
