<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVkGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vk_groups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('group_id')->unique();
            $table->string('name');
            $table->string('screen_name')->nullable();
            $table->boolean('is_closed')->default(0);
            $table->boolean('can_see_all_posts')->default(1);
            $table->string('type');
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
        Schema::dropIfExists('vk_groups');
    }
}
