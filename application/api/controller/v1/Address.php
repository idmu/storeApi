<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/18
 * Time: 下午3:18
 */

namespace app\api\controller\v1;


use app\api\service\Token;
use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
class Address
{
    public function createOrUpdateAddress()
    {
        (new AddressNew())->goCheck();
        //根据token来获取uid
        //根据uid来查找用户数据,判断用户是否存在,如果不存在则抛出异常
        //获取用户从客户端提交的地址信息
        //根据用户地址信息是否存在,从而判断是添加地址还是更新地址
        $uid = TokenService::getCurrentUid();


    }
}