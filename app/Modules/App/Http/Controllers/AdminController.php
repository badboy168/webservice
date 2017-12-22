<?php
namespace App\Modules\app\Http\Controllers;


use App\Exceptions\ApiExecption;
use App\Http\Controllers\Api\ApiBaseController;
use App\Models\Service\Impl\appServiceImpl;
use Curl\Curl;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;


/**
 * 用户接口
 * 请求方式    URI路径                控制器方法    路由名称
 * GET        /app                index        app.index
 * GET        /app/create        create        app.create
 * POST         /app               store        app.store
 * GET        /app/{post}        show        app.show
 * GET        /app/{post}/edit    edit        app.edit
 * PUT/PATCH    /app/{post}    update        app.update
 * DELETE    /app/{post}        destroy        app.destroy
 */
class AdminController extends ApiBaseController
{


    /**
     * 登录
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        try{

            $arr = decrypt($request->get('sms'));

            $arrPhone = explode(',', getenv('ADMIN_PHONES'));
            if(! in_array($arr['phone'], $arrPhone))
            {
                return $this->jsonApiError('账号不正确');
            }

//            ['token'=>encrypt(['phone'=>$mobile, 'time'=>time()])]
            if($arr['code'] == $request->get('code') && $arr['phone'] == $request->get('phone'))
            {
                $token = ['phone'=>$request->get('phone'), 'time'=>time()];
                return $this->jsonApiSuccess(['token'=>encrypt($token)], "登录成功");
            }else
            {
                return $this->jsonApiError("验证码不正确");
            }

        }catch (DecryptException $e)
        {
            return $this->jsonApiError("验证码不正确");
        }
    }


}