<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->enum("site_management", [0, 1])->default(1);
            $table->enum("user_management", [0, 1])->default(1);
            $table->enum("organisation_management", [0, 1])->default(1);
            $table->enum("page_management", [0, 1])->default(1);
            $table->enum("slider_management", [0, 1])->default(1);
            $table->enum("cemetery_management", [0, 1])->default(1);
            $table->enum("dead_management", [0, 1])->default(1);
            $table->enum("prayer_management", [0, 1])->default(1);
            $table->enum("notification_management", [0, 1])->default(1);
            $table->enum("funeral_management", [0, 1])->default(1);

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
