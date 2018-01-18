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
use app\api\model\User as UserModel;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class Address
{
    public function createOrUpdateAddress()
    {
        //创建一个validate变量保存起来,方便后续调用
        $validate = new AddressNew();
        $validate->goCheck();
        //根据token来获取uid
        //根据uid来查找用户数据,判断用户是否存在,如果不存在则抛出异常
        //获取用户从客户端提交的地址信息
        //根据用户地址信息是否存在,从而判断是添加地址还是更新地址
        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$user){
            throw new UserException();
        }
        //获取所有的post变量的参数 传递到验证器进行校验
        $dataArray = $validate->getDataByRule(input('post.'));
        $userAddress = $user->address;
        if (!$userAddress){
                //通过模型的关联属性来新增数据
            $user->address()->save($dataArray);
        }
        else {
            //如果不存在就更新数据
            $user->address->save($dataArray);
        }
//        return $user;
//        return 'success';
        //成功后返回ok
        return new  SuccessMessage();
    }
}