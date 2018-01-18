<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/18
 * Time: 下午4:25
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $cede = 404;
    public $Msg = '用户不存在';
    public $errorCode = 60000;

}