<?php
/**
 * 文件加密
 * User: mark
 * Date: 17/12/27
 * Time: 下午1:53
 */

namespace App\Common;


class PHPFileEncode
{


    private static $instance;

    //要加密的路径
    private $path = [];

    //要加密的文件
    private $encodeFiles = [];

    //key1
    private $secretKey1;

    //key2
    private $secretKey2;

    private $tplName = "tmp_";


    function addPath($path)
    {

        array_push($this->path, $path);
    }

//    private function __construct()
//    {
//
//    }
//
//
//    public static function getInstance()
//    {
//
//        if(self::$instance == null)
//        {
//            self::$instance == new static();
//        }
//        return self::$instance;
//    }


    /**
     * 生成随机数
     * @param string $length
     * @return string
     */
    private function randStr($length = "")
    { // 返回随机字符串
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        return str_shuffle($str);
    }


    /**
     * 对文件进行加密
     * @param $filename
     * @return  integer 文件大小
     */
    private function encode($filename)
    {

        $T_k1 = $this->randStr(); //随机密匙1
        $T_k2 = $this->randStr(); //随机密匙2
        //读取文件的内容
        $fileContent = file_get_contents($filename);
        //进行base64编码
        $v1 = base64_encode($fileContent);
        $c = strtr($v1, $T_k1, $T_k2); //根据密匙替换对应字符。
        $c = $T_k1 . $T_k2 . $c;
        $q1 = "O00O0O";
        $q2 = "O0O000";
        $q3 = "O0OO00";
        $q4 = "OO0O00";
        $q5 = "OO0000";
        $q6 = "O00OO0";
        $s = '$' . $q6 . '=urldecode("%6E1%7A%62%2F%6D%615%5C%76%740%6928%2D%70%78%75%71%79%2A6%6C%72%6B%64%679%5F%65%68%63%73%77%6F4%2B%6637%6A");$' . $q1 . '=$' . $q6 . '{3}.$' . $q6 . '{6}.$' . $q6 . '{33}.$' . $q6 . '{30};$' . $q3 . '=$' . $q6 . '{33}.$' . $q6 . '{10}.$' . $q6 . '{24}.$' . $q6 . '{10}.$' . $q6 . '{24};$' . $q4 . '=$' . $q3 . '{0}.$' . $q6 . '{18}.$' . $q6 . '{3}.$' . $q3 . '{0}.$' . $q3 . '{1}.$' . $q6 . '{24};$' . $q5 . '=$' . $q6 . '{7}.$' . $q6 . '{13};$' . $q1 . '.=$' . $q6 . '{22}.$' . $q6 . '{36}.$' . $q6 . '{29}.$' . $q6 . '{26}.$' . $q6 . '{30}.$' . $q6 . '{32}.$' . $q6 . '{35}.$' . $q6 . '{26}.$' . $q6 . '{30};eval($' . $q1 . '("' . base64_encode('$' . $q2 . '="' . $c . '";eval(\'?>\'.$' . $q1 . '($' . $q3 . '($' . $q4 . '($' . $q2 . ',$' . $q5 . '*2),$' . $q4 . '($' . $q2 . ',$' . $q5 . ',$' . $q5 . '),$' . $q4 . '($' . $q2 . ',0,$' . $q5 . '))));') . '"));';
        $s = '<?php ' . "\n" . $s . "\n" . ' ?>';


        $fileDir = dirname($filename);
        $newFileName = pathinfo($filename)['filename'];
        $fileExtension = pathinfo($filename)['extension'];
        $name = $fileDir.DIRECTORY_SEPARATOR.$this->tplName.$newFileName.'.'.$fileExtension;

//        echo $name.PHP_EOL;

        return file_put_contents($name, $s);
    }


    /**
     * 遍历文件
     * @param $dir
     */
    private function handlerDir($dir)
    {
        if (is_dir($dir)) {
            //打开一个目录
            $currentDir = opendir($dir);
            //
            while (false !== ($file = readdir($currentDir))) {
                if ($file == '.' || $file == '..') {
                    continue;
                }

                $subDir = $dir . DIRECTORY_SEPARATOR . $file;

                if (is_dir($subDir)) {
                    $this->handlerDir($subDir);
                }

                if (is_file($subDir)) {
                    //获取文件扩展名
                    $fileExtension = pathinfo($subDir)['extension'];
                    //只处理PHP文件
                    if ($fileExtension == 'php') {
                        array_push($this->encodeFiles, $subDir);
                    }
                }
            }

            closedir($currentDir);

        }else{

            if (is_file($dir)) {
                //获取文件扩展名
                $fileExtension = pathinfo($dir)['extension'];
                //只处理PHP文件
                if ($fileExtension == 'php') {
                    array_push($this->encodeFiles, $dir);
                }
            }
        }

    }


    function run()
    {

        $uniqueFilePath = array_unique($this->path);

        foreach ($uniqueFilePath as $item) {
//            echo $item.PHP_EOL;
            $this->handlerDir($item);
        }

        foreach ($this->encodeFiles as $item)
        {
            echo "encode file: {$item}".PHP_EOL;
            $size = $this->encode($item);
            echo "finish encoe file:{$item} size:{$size}".PHP_EOL;

        }
    }
}