<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/11
 * Time: 下午1:04
 */

namespace App\Models\Dao\Impl;


class SmsLogDaoImpl extends AbBaseDaoImpl
{
    //该类所对应的表名
    protected $table = "sms_log";


    function store($input):bool
    {

        $this->assign($input);
        return $this->save();
    }

}