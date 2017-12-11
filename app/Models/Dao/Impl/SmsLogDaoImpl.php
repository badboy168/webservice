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
    protected $table = "sms_log";


    function store($input):bool
    {
        $this->assign($input);
        return $this->save();
    }

}