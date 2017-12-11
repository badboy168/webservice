<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/6
 * Time: 下午8:58
 */

namespace App\Exceptions;


class DBNotColumnException extends \Exception
{

    function __construct($message)
    {
        parent::__construct($message);
    }
}