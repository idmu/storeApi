<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/18
 * Time: 上午10:52
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class getToken
{
    public function getToken($code = ''){
        (new TokenGet())->goCheck();
        $ut= new UserToken($code);
        $token = $ut->get();
        return [
            'token ' =>$token
        ];
    }

}