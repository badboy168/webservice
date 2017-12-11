<?php
namespace App\Models\Service\Impl;


use App\Exceptions\ApiExecption;
use App\Exceptions\DBNotColumnException;
use App\Models\Dao\Impl\AccountDaoImpl;
use App\Models\Dao\Impl\MyCrpty;
use App\Models\Dao\Impl\UsersDaoImpl;
use Illuminate\Support\Facades\Request;
use Zhuzhichao\IpLocationZh\Ip;


/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/4
 * Time: 下午2:00
 */
class UserServiceImpl extends AbBaseServiceImpl
{



    function save($input)
    {

        //获取客户端的真实IP
        $ip = Request::getClientIp();
        //通过IP获取真实的地理位置
        $input['location'] = implode(' ', Ip::find($ip));

        $user = new UsersDaoImpl();

        //得到会员号
        $input['member'] = $user->createMember();

        //操作系统类别
        $input['os_type'] = $this->getOsType();

        //如果该数据已经存在
//         if($user->checkSignExist($input))
//         {
//             throw new ApiExecption("该数据已经存在", 300);
//         }

        //指纹
        $input['signature'] = md5(json_encode(ksort($input)));

        if(! $user->store($input))
        {
            throw new ApiExecption('失败失败', 500);
        }


        $uid = $user->id;

        $account = new AccountDaoImpl();

        if($account->existWithUid($uid))
        {
            $account->removeWithUid($uid);
        }

        //如果初始化成功则返回会员号
        if($account->init($uid))
        {
            return $input['member'];
        }

        throw new ApiExecption("初始化账户表失败", 500);
    }



    private function createUser()
    {

    }


    private function createAccount()
    {

    }






}