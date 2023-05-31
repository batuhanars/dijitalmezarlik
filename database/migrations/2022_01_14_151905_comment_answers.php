<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CommentAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("comment_id");
            $table->string("answer_full_name");
            $table->string("answer_email");
            $table->string("answer_title");
            $table->text("answer_message");
            $table->enum("status", ["0", "1"])->default("0");
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
        Schema::dropIfExists('comment_answers');
    }
}
