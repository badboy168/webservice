<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Routing\RouteCollection;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {


        // 如果config配置debug为true ==>debug模式的话让laravel自行处理
        if(config('app.debug')){
            return parent::render($request, $exception);
        }
//
        return $this->handle($request, $exception);

//        return parent::render($request, $exception);
    }


    // 新添加的handle函数
    public function handle($request, Exception $exception){
        // 只处理自定义的APIException异常
        $message = "未知错误";
        $status = 500;
        $data = [];

        if($exception instanceof ApiExecption) {
            $message = $exception->getErrorMessage();
            $status = $exception->getCode();
        }else if($exception instanceof NotFoundHttpException)
        {
            $message = "您请求的方法未代码";
            $status = 400;
        }else if($exception instanceof MethodNotAllowedHttpException)
        {
            $status = 400;
            $message = "您请法的方法未允许";
        }else
        {
            $status = 500;
            $message = $exception->getMessage();

        }

        return response()->json(['status'=>$status, 'message'=>$message, 'data'=>$data]);
    }


    //response()->json();
}
