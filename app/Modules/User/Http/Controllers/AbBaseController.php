<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/4
 * Time: 下午3:43
 */

namespace App\Modules\User\Http\Controllers;


use App\Http\Controllers\Controller;

abstract class AbBaseController extends Controller
{




    function __construct()
    {
        $route = request()->route()->getAction();

        list($controller, $action) = explode('@', $route['controller']);
        $this->controller = $controller;
        $this->$action = $action;
//        echo $controller, $action;
//        dd($this->get_client_browser());
//        dd($_SERVER);
    }


    public function index()
    {

        return [$this->controller=>$this->action];
    }


    /**
     * 获取客户端浏览器类型
     * @param  string $glue 浏览器类型和版本号之间的连接符
     * @return string|array 传递连接符则连接浏览器类型和版本号返回字符串否则直接返回数组 false为未知浏览器类型
     */
    function get_client_browser($glue = null)
    {
        $browser = array();
        $agent = $_SERVER['HTTP_USER_AGENT']; //获取客户端信息
        /* 定义浏览器特性正则表达式 */
        $regex = array(
            'ie' => '/(MSIE) (\d+\.\d)/',
            'chrome' => '/(Chrome)\/(\d+\.\d+)/',
            'firefox' => '/(Firefox)\/(\d+\.\d+)/',
            'opera' => '/(Opera)\/(\d+\.\d+)/',
            'safari' => '/Version\/(\d+\.\d+\.\d) (Safari)/',
        );
        foreach ($regex as $type => $reg) {
            preg_match($reg, $agent, $data);
            if (!empty($data) && is_array($data)) {
                $browser = $type === 'safari' ? array($data[2], $data[1]) : array($data[1], $data[2]);
                break;
            }
        }
        return empty($browser) ? false : (is_null($glue) ? $browser : implode($glue, $browser));
    }



}