<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Routing\RouteCollection;
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
        return $this->handle($request, $exception);

//        return parent::render($request, $exception);
    }


    // 新添加的handle函数
    public function handle($request, Exception $exception){
        // 只处理自定义的APIException异常
        if($exception instanceof ApiExecption) {

//            dd($exception->message);
            $result = [
                "msg"    => "",
                "data"   => $exception->getErrorMessage(),
                "status" => $exception->getCode()
            ];

            return response()->json($result);
        }

        if($exception instanceof NotFoundHttpException)
        {
            $result = [
                "msg"    => "你请求的访法未找到",
                "data"   => $exception->getMessage(),
                "status" => 500
            ];
            return response()->json($result);
        }


        return parent::render($request, $exception);
    }

}
