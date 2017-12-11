<?php
/**
 * 验证异常类
 * User: mark
 * Date: 17/12/4
 * Time: 下午5:13
 */

namespace App\Exceptions;


class ApiExecption extends \Exception
{

    private $errorMessage;

//    function __construct($message)
//    {
//        parent::__construct($message);
//
//        $this->errorMessage = $message;
//    }


    function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->errorMessage = $message;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}