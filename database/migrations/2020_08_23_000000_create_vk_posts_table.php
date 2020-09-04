<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVkPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vk_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->bigInteger('from_id');
            $table->bigInteger('owner_id');
            $table->dateTime('date');
            $table->boolean('marked_as_ads')->default(0);
            $table->string('post_type');
            $table->longText('text')->nullable();
            $table->json('attachments')->nullable();
            $table->jsonb('copy_history')->nullable();
            $table->json('post_source')->nullable();
            $table->json('comments')->nullable();
            $table->json('likes')->nullable();
            $table->json('reposts')->nullable();
            $table->json('views')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['id', 'owner_id'], 'uuid');
            $table->index('from_id');
            $table->index('owner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vk_posts');
    }
}
