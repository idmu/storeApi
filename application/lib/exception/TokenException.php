<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/18
 * Time: 下午12:12
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $cede = 404;
    public $Msg = 'Token已过期或者无效Token';
    public $errorCode = 10001;
}