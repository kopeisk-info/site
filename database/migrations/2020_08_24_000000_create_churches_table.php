<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChurchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            /*
             * Как вариант:
             * group - религиозная группа
             * organization - религиозная органиазция
             * // unity(unification, commonwealth) - единение, содружество
             * // union - союз
             */
            $table->string('type')->default('group');
            /*
             * Как вариант:
             * local - местная
             * centralized - централизованная
             */
            $table->string('scope')->default('local');

            $table->string('name')->nullable();
            $table->string('full_name')->nullable();
            $table->text('description')->nullable();

            $table->string('city')->comment('Название города');
            $table->string('district')->nullable()->comment('Район города');

            $table->date('foundation_date')->nullable()->comment('Дата основания');
            $table->date('registration_date')->nullable()->comment('Дата регистрации');

            $table->string('main_site')->nullable()->comment('Основной сайт');
            $table->string('contact_phone')->nullable()->comment('Контактный номер телефона');

            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')->on('churches')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('churches');
    }
}
