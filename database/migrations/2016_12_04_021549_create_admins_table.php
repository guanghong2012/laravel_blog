<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('adm_name')->comment("用户名");
            $table->string('adm_password')->comment("密码");
            $table->integer('login_time')->comment("登陆时间：默认0")->default(0);
            $table->string('login_ip')->comment("登陆ip：默认0");
            $table->tinyInteger("is_effect")->comment("账户状态，默认1：正常;0:禁用")->default(1);
            $table->integer("role_id")->comment("角色id")->default(1);
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
        Schema::drop('admins');
    }
}
