<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinisterVkUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minister_vk_users', function (Blueprint $table) {
            $table->unsignedBigInteger('minister_id');
            $table->unsignedBigInteger('user_id');

            $table->unique(['minister_id', 'user_id'], 'id');
            $table->index('minister_id');
            $table->index('user_id');

            $table->foreign('minister_id')
                ->references('id')->on('ministers')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('vk_users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minister_vk_users');
    }
}
