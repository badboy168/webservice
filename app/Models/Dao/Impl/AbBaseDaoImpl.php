<?php
namespace App\Models\Dao\Impl;
use App\Exceptions\DBNotColumnException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

/**
 * Created by PhpStorm.
 * User: mark
 * Date: 17/12/4
 * Time: 下午1:57
 */
abstract class AbBaseDaoImpl extends Model
{



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = "";


    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
//    public $timestamps = false;


    /**
     * 模型的日期字段保存格式。
     *
     * @var string
     */
//    protected $dateFormat = 'U';


    /**
     * 数据签名
     */
    function sgin($input)
    {
        return md5(json_encode(ksort($input)));
    }


    /**
     * 数组 转 对象
     *
     * @param array $arr 数组
     * @return object
     */
    function array_to_object($arr)
    {
        if (gettype($arr) != 'array') {
            return;
        }
        foreach ($arr as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                $arr[$k] = (object)array_to_object($v);
            }
        }

        return (object)$arr;
    }


    /**
     * 对象 转 数组
     *
     * @param object $obj 对象
     * @return array
     */
    function object_to_array($obj)
    {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)object_to_array($v);
            }
        }

        return $obj;
    }



    /**
     * 对数据库字段进行批量赋值
     * @param $input object
     * @param $checked bool 是否进行检测
     * @throws DBNotColumnException
     */
    protected function assign($input, $checked = true)
    {

        //得到数据库中的所有字段
        $colunms =$checked? array_flip(Schema::getColumnListing($this->table)): $input;
        //循环进行赋值
        foreach ($input as $key=>$val)
        {
            //如果字段不存在数据库中
            if(! array_key_exists($key, $colunms))
            {
                throw new DBNotColumnException("数据库字段:{$key} 不存在");
            }

            $this->$key = $val;
        }

    }


    /**
     * 保存数据
     * @param $input
     * @return bool
     */
//    protected function store($input):bool
//    {
//
//        $this->assign($input);
//        return $this->save();
//    }

}