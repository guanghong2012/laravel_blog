<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("导航名称");
            $table->string('model')->comment("模块名称");
            $table->string('url')->comment("链接地址");
            $table->tinyInteger('is_blank')->comment("是否新建窗口打开:0=否1=是")->default(0);
            $table->tinyInteger('sort')->comment("排序")->default(0);
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
