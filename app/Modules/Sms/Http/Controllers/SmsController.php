<?php

namespace App\Modules\Sms\Http\Controllers;

use App\Exceptions\ApiExecption;
use App\Models\Service\Impl\SmsServiceImpl;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return [];
    }


    public function getCode()
    {
        $img = captcha_img();
        return $img;
    }


    /**
     * 检测验证码是否正确
     * @param $code
     * @return array
     */
    function check($code)
    {
        if($this->checkCode($code))
        {
            return $this->jsonApiSuccess('验证码正确');
        }

        return $this->jsonApiError('验证码错误');
    }


    /**
     * 检测验证码是否正确
     * @param $code
     * @return bool
     */
    private function checkCode($code)
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make(['captcha'=>$code], $rules);
        if ($validator->fails())
        {
            return false;
        }
        else
        {
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
        //是否开启验证码
        if(getenv('IS_SMS_CODE'))
        {
            if(! $this->checkCode($request->get('captcha')))
            {
                return $this->jsonApiError("验证码不正确");
            }
        }

        //判断是否有传入手机号码
        if ($request->get('mobile')) {

            try{
                $smsService = new SmsServiceImpl();
                //发送短信
                $smsService->send($request->get('mobile'));
                //返回结果
                return $this->jsonApiSuccess("发送成功");
            }catch (ApiExecption $e)
            {
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
