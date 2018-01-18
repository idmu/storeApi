<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 下午4:44
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule =[
        'count' => 'isPositiveInteger|between:1,15|require'

    ];
}