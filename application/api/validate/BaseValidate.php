<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 上午9:59
 */

namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{


    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();
        $result = $this->batch()->check($params);
        if (!$result){
            $e = new  ParameterException([
                //创建对象的时候就对其赋值,比起下面的
//                通过访问成员变量来赋值更加面向对象
                'msg'=> $this->error,
//                'code' => '400',
//                'errorCode' => 10002
            ]);
//            $e->msg = $this->error;
//            $e->errorCode = 10002;
            throw $e;

        }
        else{
            return true;
        }

    }

    protected function isPositiveInteger($value, $rule='', $data='', $field='')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else{
//            return $field .'必须是正整数';
            return false;
        }


    }
//    不能为空
    protected function isNotEmpty($value, $rule='', $data='', $field='')
    {
        if (empty($value)){
            return $field.'不允许为空';
        }
        else{
            return true;
        }

    }

//限制客户端上传的参数
    public function getDataByRule($arrays){
        if (array_key_exists('user_id',$arrays)|
        array_key_exists('uid',$arrays)){
            throw new ParameterException([
                'msg'=> '参数中包含有非法的参数名user_id或者id'
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value){
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }

}