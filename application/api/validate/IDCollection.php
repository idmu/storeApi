<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 下午3:16
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule =[
        'ids' => 'require|checkIDs'
    ];

    protected $message =[
        'ids' => 'ids参数必须是以都好分割的多位正整数'
    ];
    protected function checkIDs($value){
        $value = explode(',',$value);
        if (empty($value)){
            return false;
        }
        //遍历传入的id,保证传入的id为正整数
        foreach ($value as $id){
            if (!$this->isPositiveInteger($id)){
                return false;
            }

        }
        return true;
    }

}