<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/7
 * Time: 上午12:52
 */

namespace App\Models\Dao\Impl;


class AccountDaoImpl extends AbBaseDaoImpl
{


    protected $table = 'account';


    /**
     * 初始化账户表
     * @param $uid
     * @return bool
     */
    function init($uid)
    {
        $this->uid = $uid;

        return $this->save();
    }


    /**
     * 通过UID判断用户是否存在
     * @param $uid
     * @return bool
     */
    function existWithUid($uid):bool
    {
        return null == $this->where(['uid' => $uid])->first() ? false : true;
    }


    /**
     * 通过UID删除某一个用户的账户记录
     * @param $uid
     * @return mixed
     */
    function removeWithUid($uid)
    {
        return $this->where(['uid'=>$uid])->delete();
    }

}