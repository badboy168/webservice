<?php

namespace App\Modules\User\Http\Controllers;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    //
    protected function options(){ //选项设置
        return [
            // 前面的appid什么的也得保留哦
            'app_id' => 'xxxxxxxxx', //你的APPID
            'secret'  => 'xxxxxxxxx',     // AppSecret
            // 'token'   => 'your-token',          // Token
            // 'aes_key' => '',                    // EncodingAESKey，安全模式下请一定要填写！！！
            // ...
            // payment
            'payment' => [
                'merchant_id'        => '你的商户ID，MCH_ID',
                'key'                => '你的KEY',
                // 'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
                // 'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
                'notify_url'         => '你的回调地址',       // 你也可以在下单时单独设置来想覆盖它
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
        ];
    }

    function server()
    {
        
       dd(new Application($this->options()));
    }
}
