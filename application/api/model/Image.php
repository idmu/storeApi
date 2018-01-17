<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 上午9:34
 */

namespace app\api\model;


class Image extends BaseModel
{
    protected $hidden = ['delete_time','update_time','id','from'];
    public function getUrlAttr($value,$data){
        return $this->prefixImgUrl($value,$data);
    }

}