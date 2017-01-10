<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlecommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articlecomments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->comment("用户id");
            $table->string('username')->comment("用户名称");
            $table->string('articleid')->comment("文章id");
            $table->string('ip')->comment("IP地址");
            $table->text('content')->comment("评论内容");
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
        //
    }
}
