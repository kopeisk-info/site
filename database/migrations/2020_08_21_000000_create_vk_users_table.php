<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVkUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vk_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('is_closed')->default(0);
            $table->boolean('can_access_closed')->default(0);
            $table->boolean('can_see_all_posts')->default(1);
            $table->boolean('from_copy')->default(0);
            $table->smallInteger('sex');
            $table->string('screen_name')->nullable();
            $table->string('photo_50');
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
        Schema::dropIfExists('vk_users');
    }
}
