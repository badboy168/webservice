<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/11
 * Time: 下午12:34
 */

namespace App\Models\Service\Impl;


use App\Exceptions\ApiExecption;
use App\Models\Dao\Impl\SmsLogDaoImpl;
use App\Models\Dao\Impl\UsersDaoImpl;
use Curl\Curl;

class SmsServiceImpl extends AbBaseServiceImpl
{


    private function isMobile($mobile)
    {
        if (preg_match('/^1[34578]\d{9}$/', $mobile)) {
            return true;
        }

        return false;
    }


    function send($mobile)
    {

        $user = new UsersDaoImpl();

        //验证码
        $code = rand(100000, 999999);

        //短信模板
        $content = getenv('SMS_CONTENT_TPL');
        //通过字符串替换,把验证码替换到内容中
        $content = str_replace('{{code}}', $code, $content);

        //验证手机号码
        if (!$this->isMobile($mobile)) {
            throw new ApiExecption("手机号码不正确认", 400);
        }


        //判断是否存在用户表中
        if ($data = $user->where(['phone' => $mobile])->first() === NULL) {
            //注册一个新用户
            $user->store(['phone' => $mobile, 'member' => $user->createMember(), 'os_type' => $this->getOsType(), 'app_version' => '1.0.0', 'phone_version' => '1.0.0', 'channel' => 'h5']);
        }

        //判断是发送的时间
        $sms = new SmsLogDaoImpl();

        $data = $sms->select(['send_time', 'mobile'])->where(['mobile' => $mobile])->orderBy('id', 'desc')->first();

        //当前时间 - 已经送的时间 是否小于60s
        if ($data != null && (time() - $data['send_time']) < getenv('SMS_DELAY')) {
            throw new ApiExecption("您的短信发送的太频繁了", 400);
        }

        $message = $this->sendSms($mobile, $content);
        $result = explode('/', $message)[0];

        if ($result == '0808191630319344' || $result == '000') {
            $status = 0;
        } else {
            $status = 1;
        }

        $sms->store(['mobile' => $mobile, 'content' => $content, 'send_time' => time(), 'code' => $code, 'message' => $message, 'status' => $status]);
        return $sms->id;
    }


    private function sendSms($mobile, $content)
    {

        //要请求短信的第三方URL地址
        $requestUrl = getenv("SMS_URL");

        //短信账号
        $account = getenv('SMS_ID');
        //密码
        $password = getenv('SMS_PWD');

        //短信内容,需要转码
        $content = iconv("UTF-8", "GB2312", $content);

        $curl = new Curl();
        $curl->post($requestUrl, ['id' => $account, 'pwd' => $password, 'to' => $mobile, 'content' => $content, 'time' => time()]);
        if ($curl->error) {
//            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
            throw new ApiExecption($curl->errorMessage, 500);
        } else {
            return $curl->response;
        }
    }


}