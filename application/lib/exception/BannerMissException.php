<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 上午10:57
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的banner不存在';
    public $errorCode = 40000;

}