<?php
namespace App\Models\Utils;
/**
 * RSA非对称加密
 * User: mark
 * Date: 17/12/5
 * Time: 下午3:19
 */
class RSAUtils
{

    private static $instance;

    private function __construct()
    {

    }


    /**
     * @return mixed
     */
    private static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }






    /**
     * 对数据进行加密处理
     * @param $text
     * @return string
     */
    public static function encrypt($text)
    {

        $publicKey = file_get_contents(storage_path('app/public/rsa_public_key.pem'));

        openssl_public_encrypt($text, $encrypted, openssl_pkey_get_public($publicKey));

        return base64_encode($encrypted);
    }


    /**
     * 对数据进行解密处理
     * @param $ciphertext
     * @return string
     */
    public static function decrypt($ciphertext)
    {
        $privateKey = file_get_contents(storage_path('app/public/rsa_private_key.pem'));
        $encrypted = base64_decode($ciphertext);

        openssl_private_decrypt($encrypted, $decrypted, openssl_pkey_get_private($privateKey));

        return $decrypted;
    }
}