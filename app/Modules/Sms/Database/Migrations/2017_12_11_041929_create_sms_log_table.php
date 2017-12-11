<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile', 11)->comment('手机号码');
            $table->string('content', 500)->comment('短信内容');
            $table->integer('send_time')->comment('发送短信的时间');
            $table->string('status', 8)->default(0)->comment('状态');
            $table->string('message', 200)->default("")->comment('返回的内容');
            $table->string('code', 10)->default("")->comment('发送的验证码');
            $table->unsignedInteger('use')->default(0)->comment('是否使用');
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
        Schema::dropIfExists('sms_log');
    }
}
