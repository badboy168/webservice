<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/4
 * Time: 下午3:43
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;


abstract class ApiBaseController extends Controller
{


    //表名
    protected $table;

    //要查询的内容
    protected $select;

    //查询条件
    protected $where;

    //分页
    protected $page;


    function __construct()
    {
        $this->init();
//        Log::info($_REQUEST);
    }


    private function init()
    {
        //获取表名
        $this->table = isset($_REQUEST['table']) ? $_REQUEST['table'] : "";

        //要展示的字段
        $this->select = isset($_REQUEST['select']) ? $_REQUEST['select'] : "";

        //要展示的字段
        $this->where = isset($_REQUEST['where']) ? $_REQUEST['where'] : "";

        $this->page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";


    }


    public function index()
    {

        return [$this->controller => $this->action];
    }


    function handle($input)
    {
        foreach ($input as $key => $val) {

            if($input[$key] == '')
            {
                unset($input[$key]);
            }

            if (is_array($val)) {
                if (is_array($val) && $val[0] == 'callFunction') {
                    $input[$key] = call_user_func([$this, $val[1]]);
                }
            }
        }

        return $input;
    }


    /**
     * 获取订单号
     * @return string
     */
    function getOrderSn()
    {
        //获取当天的订单数
        $count = DB::table($this->table)->whereDay('created_at', date("d"))->count();
//        $count = 1;//$this->whereDay('created_at', date("d"))->count();
        $count++;

        //前缀
        $prefix = 10000 + $count;

        //编号的前缀
        $today = date("ymd", time());

        $number = "{$today}{$prefix}";

        return $number;
    }


    function getPhone()
    {

        try{
            $arr = decrypt($_REQUEST['token']);
            return $arr['phone'];

        }catch (DecryptException $e)
        {
            return "";
        }
    }

}