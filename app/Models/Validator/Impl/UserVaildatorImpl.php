<?php
namespace App\Models\Validator\Impl;

use App\Exceptions\ApiExecption;
use Illuminate\Support\Facades\Validator;


/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/4
 * Time: 下午4:00
 */
class UserVaildatorImpl extends AbBaseVaildatorImpl
{

    /**
     * 是否开启验证
     *
     * @return bool
     */
    function authorize()
    {
        return true;
    }


    /**
     * 默认的验证规则
     * @param array $input
     * @throws ApiExecption
     */
    function make($input)
    {

        if(! $this->authorize())
        {
            return;
        }
        $validator = Validator::make($input, $this->getRules(), $this->getFormatErrorMessage(), $this->getRoulesMapName());
        if ($validator->fails()) {

            throw new ApiExecption($validator->errors(), 400);
        }
    }


    /**
     * 获取错误消息
     * @return string
     */
    function getErrorMessage()
    {

    }

    /**
     * 获取验证规则
     * @return mixed
     */
    function getRules()
    {
        return ['username' => 'required|between:10,100', 'password' => 'required'];
    }

    /**
     * 格式化错误消息
     * @return mixed
     */
    function getFormatErrorMessage()
    {
        $messages = [
            'same'    => 'The :attribute and :other must match.',
            'size'    => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.',
            'in'      => 'The :attribute must be one of the following types: :values',
        ];
        return ['required' => ' :attribute 不能为空.', 'between' => 'The :attribute value :input is not between :min - :max.'];
    }

    /**
     * 格式规则名称
     * @return mixed
     */
    function getRoulesMapName()
    {
        return ['username'=>"用户名", "password"=>'密码'];
    }
}