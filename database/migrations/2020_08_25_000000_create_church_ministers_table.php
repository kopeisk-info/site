<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChurchMinistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('church_ministers', function (Blueprint $table) {
            $table->unsignedBigInteger('church_id');
            $table->unsignedBigInteger('minister_id');
            $table->string('ordination');

            $table->unique(['church_id', 'minister_id'], 'id');
            $table->index('ordination');
            $table->index('church_id');
            $table->index('minister_id');

            $table->foreign('church_id')
                ->references('id')->on('churches')
                ->onDelete('cascade');
            $table->foreign('minister_id')
                ->references('id')->on('ministers')
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
        Schema::dropIfExists('church_ministers');
    }
}
