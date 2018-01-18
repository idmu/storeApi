<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/18
 * Time: 下午12:44
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = ['img_id','product_id'];
    public function imgUrl(){
        return $this->belongsTo('Image','img_id','id');
    }
}