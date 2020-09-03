<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('minister_id');
            $table->foreignId('minister_id')->references('id')->on('ministers')->onDelete('cascade');
            $table->text('prayer');
            $table->timestamps();

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
        Schema::dropIfExists('repents');
    }
}
