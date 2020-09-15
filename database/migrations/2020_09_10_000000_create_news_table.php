<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->string('title')->comment('Название');
            $table->dateTime('date_at')->comment('Дата и время');
            $table->string('image')->nullable()->comment('Изображение');
            $table->text('description')->comment('Описание');
            $table->longText('text')->nullable()->comment('Текст');
            $table->string('source_link')->nullable()->comment('Ссылка на источник');
            $table->bigInteger('church_id')->nullable()->comment('Церковь');
            $table->bigInteger('minister_id')->nullable()->comment('Духовное лицо');

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
        Schema::dropIfExists('news');
    }
}
