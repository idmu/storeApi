<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/18
 * Time: 上午11:28
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code = 404;
    public $msg = '微信服务器接口调用错误';
    public $errorCode = 999;


}