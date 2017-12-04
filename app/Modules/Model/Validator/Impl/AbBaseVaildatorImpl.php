<?php
/**
 * 验证抽象类用于定义公共方法
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/4
 * Time: 下午4:09
 */

namespace App\Modules\Model\Validator\Impl;


use PhpParser\Node\Scalar\String_;

abstract class AbBaseVaildatorImpl
{

    //当前的实例
    protected static $instalce;

    protected $message;

    /**
     * 单例方法
     * AbBaseVaildatorImpl constructor.
     */
//    protected function __construct()
//    {
//
//    }


    /**
     * 获取自动的实例
     * @return static
     */
    public static function getInstance()
    {
        if(self::$instalce == null)
        {
            self::$instalce = new static();
        }

        return self::$instalce;
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract function authorize();


    /**
     * Get the validation rules that apply to the request.
     *
     * @param $input
     * @return bool
     */
    abstract function make(array $input):bool;



    /**
     * 获取错误消息
     * @return string
     */
    abstract function getErrorMessage():string ;


}