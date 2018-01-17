<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 上午10:51
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $cede = 400;
    public $Msg = '参数错误';
    public $errorCode = 10000;
}