<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministers', function (Blueprint $table) {
            $table->id();

            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();

            $table->text('description');

            $table->string('city')->nullable()->comment('Город');
            $table->string('district')->nullable()->comment('Район города');

            $table->string('phone')->nullable();
            $table->string('email')->nullable();

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
        Schema::dropIfExists('ministers');
    }
}
