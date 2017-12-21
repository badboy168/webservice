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
class AppController extends ApiBaseController
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        try {


            if ("" == $this->table) {
                return $this->jsonApiError("表名不正确");
            }

            $connection = DB::table($this->table);

            if ($this->select) {
                $connection = $connection->select($this->select);
            }

            if ($this->where) {
                $connection = $connection->where($this->where);
            }

            if($this->page && $this->page > 0)
            {

                $data = $connection->simplePaginate(15);
            }else
            {
                $data = $connection->first();
            }

            return $this->jsonApiSuccess($data->toArray());
        } catch (\Exception $e) {
            return $this->jsonApiError($e);
        }


//        return parent::index();
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
     * @throws ApiExecption
     */
    public function store(Request $request)
    {
        
        return $this->jsonApiSuccess("测试");
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


    /**
     * 登录
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        try{

            $arr = decrypt($request->get('sms'));

            Log::info($arr);

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


    /**
     * 发送验证码
     * @param Request $request
     * @return array
     */
    public function sms(Request $request)
    {
        $mobile = $request->get('phone');
        //验证码
        $code = rand(100000, 999999);

        //短信模板
        $content = getenv('SMS_CONTENT_TPL');
        //通过字符串替换,把验证码替换到内容中
        $content = str_replace('{{code}}', $code, $content);

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
            return $this->jsonApiError(new ApiExecption("发送失败啦", 500));
        } else {
            Log::info(['phone'=>$mobile, 'code'=>$code, 'time'=>time()]);
            return $this->jsonApiSuccess(['token'=>encrypt(['phone'=>$mobile, 'code'=>$code, 'time'=>time()])],"发送成功");
        }
    }
}