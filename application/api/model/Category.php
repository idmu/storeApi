<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 下午11:15
 */

namespace app\api\model;


class Category extends BaseModel
{
//    protected $hidden =[''];
    public function img(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
}