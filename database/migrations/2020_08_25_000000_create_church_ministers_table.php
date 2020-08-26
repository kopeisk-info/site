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
            $table->id();

            $table->foreignId('church_id')->references('id')->on('churches')->onDelete('cascade');
            $table->foreignId('minister_id')->references('id')->on('ministers')->onDelete('cascade');

            $table->string('ordination');

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
        Schema::dropIfExists('church_ministers');
    }
}
