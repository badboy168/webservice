<?php
namespace App\Models\Dao\Impl;

use App\Exceptions\DBNotColumnException;
use App\Models\Dao\Interfaces\IUserInterface;


/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/4
 * Time: 下午1:57
 */
class UsersDaoImpl extends AbBaseDaoImpl implements IUserInterface
{


    protected $table = 'users';



    /**
     * 检测签名是否已经存在
     * @param $input
     * @return bool
     */
    function checkSignExist($input):bool
    {
        //对数据进行签名
        $sgin = $this->sgin($input);
        //判断签名是否在数据库中
        return null == $this->where(['signature' => $sgin])->first() ? false : true;
    }


    /**
     * 保存数据
     * @param array $input
     * @return bool
     * @throws DBNotColumnException
     */
    function store(array $input):bool
    {

        //赋值
        $this->assign($input);

        //保存并返回结果
        return $this->save();
    }


    /**
     * 创建会员号
     * @return string
     */
    function createMember():string
    {
        //获取当天的注册数
        $count = $this->whereDay('created_at', date("d"))->count();
        //编号的前缀
        $today = date("ymd", time());

        $count ++ ;
        //前缀
        $prefix = intval('880100') + $count;
        $number = $prefix.$today;

        return $number;
    }
}