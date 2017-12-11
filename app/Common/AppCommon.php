<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/9
 * Time: 下午6:17
 */

namespace App\Common;


trait AppCommon
{

    //请求的控制器
    protected $controller;
    //请求的方法
    protected $action;


    function getController()
    {
        $route = request()->route()->getAction();
//        list($controller, $action) = explode('@', $route['controller']);
        return explode('@', $route['controller'])[0];
    }


    function getAction()
    {
        $route = request()->route()->getAction();
        return explode('@', $route['controller'])[1];
    }

}