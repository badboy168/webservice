<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_sn', 32)->comment("订单号");
            $table->string("phone", 11)->comment('手机号码'); // 0086 +86
            $table->string('category', 8)->default('')->comment('类型');
            $table->string('express_no', 50)->default('')->comment('物流单号');
            $table->string('goods_model', 20)->default('')->comment('商品型号');
            $table->text('remark')->comment('描述');
            $table->mediumText('img1')->default(null)->comment('商品图片1');
            $table->mediumText('img2')->default(null)->comment('商品图片1');
            $table->integer('market_price')->default(0)->comment('市场价');
            $table->integer('discount_price')->default(0)->comment('折扣');
            $table->integer('price')->default(0)->comment('支付价格');
            $table->integer('status')->default(0)->comment('状态:0已提交,1待支付,2完成');
            $table->string('message', 200)->default("")->comment('消息');
            $table->string('handler', 20)->default('')->comment('操作者');
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
        Schema::dropIfExists('order_info');
    }
}
