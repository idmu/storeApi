<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/18
 * Time: 上午10:43
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
        protected $rule =[
            'code' => 'require|isNotEmpty'
        ];
        protected  $message =[
            'code' => '没有code,滚吧'
        ];

}