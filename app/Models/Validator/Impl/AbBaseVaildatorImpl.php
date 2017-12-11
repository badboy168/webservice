<?php
/**
 * 验证抽象类用于定义公共方法
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/4
 * Time: 下午4:09
 */

namespace App\Models\Validator\Impl;


abstract class AbBaseVaildatorImpl
{


    //当前的实例
    protected static $instalce;

    //错误消息
    protected $errorMessage;

    //格式化错误信息
    protected $formatErrorMessage;

    //验证规则
    protected $rules;

    //规则关系名称
    protected $roulesMapName;

    //要验证的内容
    protected  $input;



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
     * 是否开启验证
     *
     * @return bool
     */
    abstract function authorize();


    /**
     * 验证输入
     *
     * @param $input
     */
    abstract function make($input);



    /**
     * 获取错误消息
     * @return string
     */
    abstract function getErrorMessage();


    /**
     * 获取验证规则
     * @return mixed
     */
    abstract function getRules();

    /**
     * 格式化错误消息
     * @return mixed
     */
    abstract function getFormatErrorMessage();

    /**
     * 格式规则名称
     * @return mixed
     */
    abstract function getRoulesMapName();


}