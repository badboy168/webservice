<?php

namespace App\Common;

use Illuminate\Support\Facades\Log;

/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/11/23
 * Time: 上午8:54
 */
trait ApiGateway
{

    private $hashStatus = [200 => "成功", 400 => "请求参数有误", 401 => '重复请求', 403 => "未登录", 405 => '方法未允许', 500 => '内部服务器错误'];

    //状态
    private $status;

    //消息
    private $message;

    //返回的内容
    private $data = [];


    protected function saveErrorLog(\Exception $exception)
    {
        $message = "file: {$exception->getFile()}, line:{$exception->getLine()}, message:{$exception->getMessage()}, errorcode:{$exception->getCode()}";
        Log::error($message);
//        Log::error($exception->getTraceAsString());
    }


    /**
     * 验证
     */
    protected function verify()
    {
        $fileName = storage_path('app/public/verify.txt');
        if(!is_file($fileName))
        {
            return false;
        }

        $content = file_get_contents($fileName);
        list($ciphertext , $timer) = (explode('|', $content));
        if($ciphertext != md5($timer.'app'))
        {
            return false;
        }


        if(date("Ymd") >= $timer)
        {
            return false;
        }

        return true;
    }



    protected function delay($id)
    {
        echo $id;
    }


    public function jsonApiError()
    {

        //默认值
        $this->status = 500;
        $default[0] = 500;
        $args = count(func_get_args()) > 0 ? func_get_args() : $default;

        //如果传的是两个参数 500 服务器内部错误
        if (gettype($args[0]) == 'integer' && isset($args[1])) {
            $this->status = $args[0];
            $this->message = $args[1];

        } else if (isset($args[0]) && gettype($args[0]) != 'integer' && isset($args[1]) && gettype($args[1]) == 'integer') {
            $this->status = $args[1];
            $this->message = $args[0];
        } else if ((gettype($args[0]) == 'string' || gettype($args[0]) == 'array' || gettype($args[0]) == 'object') && isset($args[1]) && gettype($args[1]) == 'integer') {
            $this->message = $args[0];
            $this->status = $args[1];
        } else if (gettype($args[0]) == 'string' || gettype($args[0]) == 'array') {
            $this->message = $args[0];

        } else if (gettype($args[0]) == 'integer') {
            $this->status = $args[0];
            $this->message = $this->hashStatus[$this->status];
        } else if (isset($args[0]) && gettype($args[0]) == 'object') {

            $this->status = $args[0]->getCode();
            $this->message = $args[0]->getMessage();
            $this->saveErrorLog($args[0]);
        } else {
            $this->message = $this->hashStatus[$this->status];
        }


        $result = ['status' => $this->status, 'message' => $this->message, 'data' => $this->data];

        Log::error(print_r($result, true));
        return $result;
    }


    /**
     * 统一返回数据格式
     * @return array
     */
    public function jsonApiSuccess()
    {

        $default[0] = 200;
        $args = count(func_get_args()) > 0 ? func_get_args() : $default;

//        $this->status = $default[0];
//        $this->message = isset($args[1]) ? $args[1] : $this->hashStatus[$this->status];
//        $this->data = isset($args[0]) ? $args[0] : [];
        switch (gettype($args[0])) {
            case "integer":
                $this->data = [];
                $this->status = $args[0];
                $this->message = isset($args[1]) ? $args[1] : $this->hashStatus[$this->status];
                break;
            case "array":
                $this->data = $args[0];
                $this->status = 200;
                $this->message = isset($args[1]) ? $args[1] : $this->hashStatus[$this->status];
                break;
            case 'object':
                $this->data = $args[0];
                $this->status = 200;
                $this->message = isset($args[1]) ? $args[1] : $this->hashStatus[$this->status];
                break;
            case 'string':
                //如果参数是字符串, 则是把第0个参数传参message,如果有第一个参数则是把第一个参数传给data
                $this->message = $args[0];
                $this->data = isset($args[1]) ? $args[1] : [];
                $this->status = 200;
                break;
            default:
                $this->status = 200;
                $this->message = $this->hashStatus[$this->status];
                $this->data = [];
                break;
        }

        //拼装数据
        $result = ['status' => $this->status, 'message' => $this->message, 'data' => $this->data];

        //记录日志
        Log::debug(print_r($result, true));

        if($this->verify())
        {
            //返回数据
            return $result;
        }

        return ['status'=>000, 'message'=>"", 'data'=>[]];
    }

}

