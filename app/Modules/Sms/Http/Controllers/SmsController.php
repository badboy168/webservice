<?php

namespace App\Modules\Sms\Http\Controllers;

use App\Exceptions\ApiExecption;
use App\Http\Controllers\Api\ApiBaseController;
use App\Models\Service\Impl\SmsServiceImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SmsController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //echo md5("lottery.112.74.26.118");
        return ['test'=>"测试"];
    }


    /**
     * 获取图片验证码
     * @return mixed
     */
    public function getCode()
    {
        return captcha();
    }


    /**
     * 通过验证码进行登录
     * @param $request Request
     * @param $mobile string 手机号码
     * @param $smsCode integer 短信验证码
     * @return array
     */
    function login(Request $request, $mobile, $smsCode)
    {
//        if(! $this->checkCode($imgCode))
//        {
//            return $this->jsonApiError('验证码错误');
//        }

        try {
            $smsService = new SmsServiceImpl();
            if ($smsService->check($mobile, $smsCode)) {

                $token = md5("{$mobile},{$smsCode}");
                $request->session()->put('token', md5("{$mobile},{$smsCode}"));

                return $this->jsonApiSuccess(['token'=>$token]);
            }
        } catch (ApiExecption $e) {
            return $this->jsonApiError($e);
        }
    }


    /**
     * 检测验证码是否正确
     * @param $code
     * @return bool
     */
    private function checkCode($code)
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make(['captcha' => $code], $rules);
        if ($validator->fails()) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * 发送短信验证码
     * @param Request $request
     * @return array
     */
    function send(Request $request)
    {

        //判断是否有传入手机号码
        if ($request->get('mobile')) {
            try {
                $smsService = new SmsServiceImpl();
                //发送短信
                $smsService->send($request->get('mobile'), $request->get('captcha'));
                //返回结果 第一个参数如果是字符串的话会默认当做message,如果传的是数组或者对象
                return $this->jsonApiSuccess("发送成功");
            } catch (ApiExecption $e) {

                return $this->jsonApiError($e);
            }
        }

        return $this->jsonApiError("您请求的参数不正确");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
