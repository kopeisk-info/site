<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('church');

            $table->string('name');
            $table->text('description');

            $table->string('district')->nullable()->comment('Район города');
            $table->string('address')->comment('Адрес(улица, номер дома)');
            $table->string('additional')->comment('Дополнительная информация');

            $table->unsignedTinyInteger('week_day');
            $table->time('time');

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
        Schema::dropIfExists('meetings');
    }
}
