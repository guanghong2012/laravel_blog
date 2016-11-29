<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->comment("分类id")->default(0);
            $table->string('name')->comment("文章名称");
            $table->string('title')->comment("文章标题");
            $table->string('keywords')->comment("文章关键字");
            $table->string('description')->comment("文章描述");
            $table->string('images')->comment("文章图片路径");
            $table->text('content')->comment("文章内容");
            $table->integer('click')->comment("浏览次数")->default(0);
            $table->integer('sort')->comment("排序")->default(0);
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
        Schema::drop('articles');
    }
}
