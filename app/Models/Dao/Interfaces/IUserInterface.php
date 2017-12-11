<?php
namespace App\Models\Dao\Interfaces;
use App\Exceptions\DBNotColumnException;

/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/6
 * Time: 下午7:55
 */
interface IUserInterface
{


    /**
     * 检测签名是否已经存在
     * @param $input
     * @return bool
     */
    function checkSignExist($input):bool ;


    /**
     * 保存数据
     * @param $input
     * @return bool
     * @throws DBNotColumnException
     */
    function store(array $input): bool ;


    /**
     * 创建会员号
     * @return string
     */
    function createMember():string ;

}