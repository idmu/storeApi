<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 下午11:33
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $cede = 404;
    public $Msg = '指定的类目不存在,请检查参数';
    public $errorCode = 50000;

}