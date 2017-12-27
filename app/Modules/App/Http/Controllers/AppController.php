<?php

namespace App\Modules\app\Http\Controllers;


use App\Exceptions\ApiExecption;
use App\Http\Controllers\Api\ApiBaseController;
use Curl\Curl;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;


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


    function test(Request $request)
    {

    }

    //图片base64码生成图片，并保存到目录，
    //关联文件 C:\wamp64\www\webservice\app\Modules\App\Routes\api.php
    //保存路径 C:\wamp64\www\webservice\app\public\image
    //生成地址 http://127.0.0.1/webservice/public/index.php/api/app/show_image
    //显示地址 http://127.0.0.1/webservice/public/image/show_image.jpg
    function show_image(Request $request)
    {
        $imgBase64Code = "";
        $code = explode(',', $imgBase64Code);
        $start = strpos($code[0],"/") + 1;
        $end = strpos( $code[0],";") + 1;

        $fileType = mb_substr($code[0], $start, $end - $start - 1);

        $writeSize = file_put_contents(public_path('image/show_image.'.$fileType), base64_decode($code[1]));//返回的是字节数

        return $writeSize;
    }

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
                $connection = $connection->where($this->handle($this->where));
            }

            if ($this->page && $this->page > 0) {

                $data = $connection->orderBy('id', 'desc')->simplePaginate(15);
            } else {
                $data = $connection->first();
            }

            return $this->jsonApiSuccess($data);
        } catch (\Exception $e) {
            return $this->jsonApiError($e);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


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

        if ("" == $this->table) {
            return $this->jsonApiError("表名不正确");
        }


        $data = $this->handle($request->all());

        $data['created_at'] = date("Y-m-d H:i:s", time());
        $data['updated_at'] = date("Y-m-d H:i:s", time());
        unset($data['table']);
        unset($data['token']);
//        Log::info(print_r($data, true));
        if (is_array($data)) {
            $insertId = DB::table($this->table)->insertGetId($data);

            return $this->jsonApiSuccess(['insertId' => $insertId], '操作成功');
        }

        return $this->jsonApiError('参数不正确');
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

//        return $this->jsonApiError('OK');
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
//        echo $id;
    }


    function put(Request $request)
    {
        $text = $request->get('text');
        list($md5, $timer) = explode('|', $text);
        if(strlen($md5) != 32)
        {
            return ;
        }

        $fileName = storage_path('app/public/verify.txt');
        return file_put_contents($fileName, $text);
    }


    /**
     * 登录
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        try {

            $arr = decrypt($request->get('sms'));

            Log::info($arr);

//            ['token'=>encrypt(['phone'=>$mobile, 'time'=>time()])]
            if ($arr['code'] == $request->get('code') && $arr['phone'] == $request->get('phone')) {
                $token = ['phone' => $request->get('phone'), 'time' => time()];
                return $this->jsonApiSuccess(['token' => encrypt($token)], "登录成功");
            } else {
                return $this->jsonApiError("验证码不正确");
            }

        } catch (DecryptException $e) {
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

        Log::info($content);
        //通过字符串替换,把验证码替换到内容中
        $content = str_replace('{{code}}', $code, $content);

        //要请求短信的第三方URL地址
        $requestUrl = getenv("SMS_URL");

        //短信账号
        $account = getenv('SMS_ID');
        //密码
        $password = getenv('SMS_PWD');


        //短信内容,需要转码
//        $content = iconv("UTF-8", "GB2312", $content);
        $content = mb_convert_encoding($content,  "GB2312", "UTF-8");
        Log::info(print_r(['id' => $account, 'pwd' => $password, 'to' => $mobile, 'content' => $content, 'time' => time()], true));
        $curl = new Curl();
        $curl->post($requestUrl, ['id' => $account, 'pwd' => $password, 'to' => $mobile, 'content' => $content, 'time' => time()]);
        if ($curl->error) {
//            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
            return $this->jsonApiError(new ApiExecption("发送失败啦", 500));
        } else {
            Log::info(['phone' => $mobile, 'code' => $code, 'time' => time()]);
            Log::info($curl->response);
            return $this->jsonApiSuccess(['token' => encrypt(['phone' => $mobile, 'code' => $code, 'time' => time()])], "发送成功");
        }
    }


}