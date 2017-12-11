<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('uid');
            $table->string('username', 20)->default("")->comment("用户名");
            $table->string('password', 32)->default("")->comment("密码");
            $table->string('phone', 11)->default("")->comment("手机号码");
            $table->string('member', 20)->unique()->comment("会员号");
            $table->string('network_status', 10)->default('未知')->comment("网络状态");
            $table->tinyInteger('os_type')->default(1)->comment("系统类别:1,android 2,ios 3,PC");
            $table->string('app_version', 10)->comment("软件版本号");
            $table->string('phone_version', 10)->comment("手机系统版本号");
            $table->string('brand', 10)->default("")->comment("手机品牌");
            $table->string('model', 10)->default("")->comment("手机厂商");
            $table->string('channel', 10)->comment("渠道");
            $table->tinyInteger('login_status')->default(0)->comment("状态:0 游客 1 微信 2 QQ");
            $table->tinyInteger('category')->default(0)->comment("分类");
            $table->string('remember_token', 32)->default("")->comment("token");
            $table->integer('join_uid')->default(0)->comment("关联UID");
            $table->tinyInteger('status')->default(0)->comment("状态:0 正常 1 锁定");
            $table->string('location', 100)->default('')->comment("位置");
            $table->tinyInteger('push')->default(1)->comment("推送消息");
            $table->string('signature', 32)->default("")->comment("指纹");
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
        Schema::dropIfExists('users');
    }
}
