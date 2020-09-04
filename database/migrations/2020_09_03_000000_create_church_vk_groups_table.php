<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChurchVkGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('church_vk_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('church_id');
            $table->unsignedBigInteger('group_id');

            $table->unique(['church_id', 'group_id'], 'id');
            $table->index('church_id');
            $table->index('group_id');

            $table->foreign('church_id')
                ->references('id')->on('churches')
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
        Schema::dropIfExists('church_vk_groups');
    }
}
