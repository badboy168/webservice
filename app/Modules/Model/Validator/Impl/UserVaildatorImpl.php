<?php
namespace App\Modules\Model\Validator\Impl;
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/4
 * Time: 下午4:00
 */
class UserVaildatorImpl extends AbBaseVaildatorImpl
{




    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    function authorize()
    {

        return true;
    }




    /**
     * 获取错误消息
     * @return mixed
     */
    function getErrorMessage():string
    {

        $this->message = "error";
        return $this->message;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @param $input
     * @return bool
     */
    function make(array $input):bool
    {
        // TODO: Implement make() method.
    }
}