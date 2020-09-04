<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinisterVkGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minister_vk_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('minister_id');
            $table->unsignedBigInteger('group_id');

            $table->unique(['minister_id', 'group_id'], 'id');
            $table->index('minister_id');
            $table->index('group_id');

            $table->foreign('minister_id')
                ->references('id')->on('ministers')
                ->onDelete('cascade');
            $table->foreign('group_id')
                ->references('id')->on('vk_groups')
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
        Schema::dropIfExists('minister_vk_groups');
    }
}
