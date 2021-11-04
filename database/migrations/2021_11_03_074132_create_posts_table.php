<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('タイトル');
            $table->text('message')->comment('投稿');
            $table->integer('evaluation1')->comment('評価1');
            $table->integer('evaluation2')->comment('評価2');
            $table->integer('evaluation3')->comment('評価3');
            $table->integer('evaluation4')->comment('評価4');
            $table->integer('evaluation5')->comment('評価5');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('store_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
}
