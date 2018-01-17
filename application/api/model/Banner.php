<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 上午7:06
 */

namespace app\api\model;

use think\Db;

class Banner extends BaseModel
{

    public function items(){
        return $this->hasMany('banner_item','banner_id','id');
    }

    public  static function getBannerById($id){

       $result = self::with(['items','items.img'])->find($id);
       return $result;
    }
}