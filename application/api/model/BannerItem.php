<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 上午9:26
 */

namespace app\api\model;


class BannerItem extends BaseModel
{
    protected $hidden = ['update_time','delete_time','img_id','banner_id'];
    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }
}