<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 下午5:04
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $cede = 404;
    public $Msg = '指定的商品不存在';
    public $errorCode = 20000;

}