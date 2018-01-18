<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/18
 * Time: 下午12:00
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken(){
        //32个字符组成一个随机的字符串
        $randChars = getRandChar(32);
        //用三组字符串,进行MD5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //salt 盐
        $salt = config('secure.token_salt');
        return md5($randChars.$timestamp.$salt);

    }
    //获取token
    public static function getCurrentTokenVar($key){
        //客户端的token提交应放在
        //请求的header中,不能是body
        $token = Request::instance()
            ->header('token');
        $vars = Cache::get($token);
        if (!$vars){
            throw new TokenException();
        }
        else{
            if (!is_array($vars)){
                $vars = json_decode($vars,true);
            }
            if (array_key_exists($key,$vars)){
                return $vars[$key];
            } else{
                throw new Exception('尝试获取的token变量不存在');
            }
        }
    }
    public static function getCurrentUid(){
        $uid = self::getCurrentTokenVar('uid');
            return $uid;
    }
}