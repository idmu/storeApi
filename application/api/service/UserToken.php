<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/18
 * Time: 上午10:48
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use  app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;
    //构造函数
   function __construct($code){
       $this->code = $code;
       $this->wxAppID = config('wx.app_id');
       $this->wxAppSecret = config('wx.app_secret');
       $this->wxLoginUrl = sprintf(config('wx.login_url'),
           $this->wxAppID,$this->wxAppSecret,$this->code);

}
    public function get($code){
       $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);
        //判空是经验写法
        if (empty($wxResult)){
            //之所以不自定义异常是因为自定义异常为返回到
           // 客户端去,这属于服务器异常,记录日志即可.
            throw new Exception('获取session_key及openID异常,
            微信内部错误');
        }
        else {
            //下面判断是根据经验,逻辑奇怪,是因为如果正常的微信不返回错误码,
//            如果有错误码,表示结果不正确,根据微信的返回规则来选择的判断方法
            $loginFial = array_key_exists('errcode',$wxResult);
            if ($loginFial){

            }
            //成功返回
            else{
                   $this->grantToken();
            }
        }
    }
    private function grantToken($wxResult){
    //拿到openid
        //查看数据库,这个openid是否存在
        //如果存在,则不处理,如果不存在那么新增一条记录
        //生成令牌,准备缓存数据,写入缓存,写缓存是为了加快访问速度
        //把令牌返回到客户端去
        //key:令牌
        //value:wxResult,uid ,scope(权限决定是否访问)
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenID($openid);
        if ($user){
            $uid = $user->id;
        }
        else{
            $uid = $this->newUser($openid);
        }
        $cachedValue = $this->prepareCachedValue($wxResult,$uid);
        $token = $this->saveToCache($cachedValue);
        return $token;

    }

    //写入缓存,返回令牌$key
    private function saveToCache($cachedValue){
           $key = self::generateToken();
           $value = json_encode($cachedValue);
           $expire_in = config('setting.token_expire_in');

           $request = cache($key,$value,$expire_in);
           if (!$request){
               throw new TokenException([
                   'msg ' => '服务器缓存异常',
                   'errorCode' => '1005'
               ]);

           }
           return $key;


    }
    private function prepareCachedValue($wxResult,$uid){
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = 16;
        return $cachedValue;
    }

     //新增一条记录,讲openid写入数据库
    private function newUser($openid){
       //在模型中用creat写入数据
       $user = UserModel::create([
           'openid' => $openid
       ]);
       return $user->id;

    }
    //异常处理函数
    private function processLoginError($wxResult){
        throw new WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode']
        ]);

    }

}